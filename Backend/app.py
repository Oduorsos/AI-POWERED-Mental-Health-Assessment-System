import os
import uuid
import requests
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from dotenv import load_dotenv

load_dotenv()
API_KEY = os.getenv("OPENROUTER_API_KEY")
BASE = os.getenv("OPENROUTER_BASE_URL", "https://openrouter.ai/api/v1")

app = FastAPI()

class ChatRequest(BaseModel):
    session_id: str | None = None
    user_id: int | None = None
    message: str

class ChatResponse(BaseModel):
    session_id: str
    reply: str
    metadata: dict

OPENROUTER_CHAT = f"{BASE}/chat/completions"

SYSTEM_PROMPT = """You are MEDISOS, an empathetic mental-health assistant...
- Do NOT provide clinical diagnoses...
- If suicidal intent is detected, respond calmly and escalate with EMERGENCY flag.
Return short, supportive replies and a JSON metadata object with risk_score (0-100), emotion, confidence.
"""

def call_openrouter_chat(prompt_messages):
    headers = {"Authorization": f"Bearer {API_KEY}", "Content-Type": "application/json"}
    payload = {
        "model": "openrouter/auto",
        "messages": prompt_messages,
        "max_tokens": 400
    }
    r = requests.post(OPENROUTER_CHAT, headers=headers, json=payload, timeout=30)
    if r.status_code != 200:
        raise HTTPException(status_code=502, detail=f"OpenRouter error: {r.text}")
    return r.json()

@app.post("/chat", response_model=ChatResponse)
def chat(req: ChatRequest):
    session_id = req.session_id or str(uuid.uuid4())
    messages = [
        {"role": "system", "content": SYSTEM_PROMPT},
        {"role": "user", "content": req.message}
    ]
    resp = call_openrouter_chat(messages)
    assistant_text = ""
    try:
        assistant_text = resp["choices"][0]["message"]["content"]
    except Exception:
        assistant_text = resp.get("choices", [{}])[0].get("text", "")
    metadata = {"source_resp": resp}
    return ChatResponse(session_id=session_id, reply=assistant_text, metadata=metadata)
