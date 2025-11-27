document.getElementById("startAssessment").addEventListener("click", () => {
  const chatbot = document.getElementById("chatbot-container");
  chatbot.classList.add("show");
});

document.getElementById("sendMessage").addEventListener("click", async () => {
  const input = document.getElementById("userInput");
  const message = input.value.trim();
  if (!message) return;

  addMessage(message, "user");
  input.value = "";

  const res = await fetch("chatbot.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ message })
  });

  const data = await res.json();
  addMessage(data.reply, "bot");
});

function addMessage(text, type) {
  const box = document.getElementById("chatbot-messages");
  const msg = document.createElement("div");
  msg.className = type === "bot" ? "bot-message" : "user-message";
  msg.textContent = text;
  box.appendChild(msg);
  box.scrollTop = box.scrollHeight;
}
const chatbot = document.getElementById("chatbot-container");
const overlay = document.getElementById("chatbot-overlay");
const startBtn = document.getElementById("startAssessment");
const closeBtn = document.getElementById("closeChatbot");

startBtn.addEventListener("click", () => {
  chatbot.classList.add("show");
  overlay.classList.add("show");
  chatbot.classList.remove("hidden");
  overlay.classList.remove("hidden");
});

closeBtn.addEventListener("click", () => {
  chatbot.classList.remove("show");
  overlay.classList.remove("show");
  setTimeout(() => {
    chatbot.classList.add("hidden");
    overlay.classList.add("hidden");
  }, 300);
});
function showTyping() {
  const box = document.getElementById("chatbot-messages");
  const typing = document.createElement("div");
  typing.className = "bot-message typing";
  typing.textContent = "MindBot is thinking...";
  box.appendChild(typing);
  box.scrollTop = box.scrollHeight;
  return typing;
}

document.getElementById("sendMessage").addEventListener("click", async () => {
  const input = document.getElementById("userInput");
  const message = input.value.trim();
  if (!message) return;

  addMessage(message, "user");
  input.value = "";

  const typing = showTyping();

  const res = await fetch("chatbot.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ message })
  });

  const data = await res.json();
  typing.remove();
  addMessage(data.reply, "bot");
});
