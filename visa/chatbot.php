<!-- Visa Consultancy Chatbot Widget -->
<div class="vt-chatbot">
  <!-- Chat bubble toggle -->
  <button class="vt-chatbot-toggle" aria-label="Visa Consultancy Chatbot">
    <i class="fa-solid fa-robot"></i>
  </button>

  <!-- Chat window -->
  <div class="vt-chatbot-window" aria-live="polite">
    <div class="vt-chatbot-header">
      <div class="vt-chatbot-title">Visa Assistant</div>
      <button class="vt-chatbot-close" aria-label="Close Chat">&times;</button>
    </div>

    <div class="vt-chatbot-body">
      <div class="vt-chatbot-message vt-chatbot-message-bot">
        Hi! I’m your Visa Consultancy assistant.<br />
        Choose an option below or type your question.
      </div>

      <div class="vt-chatbot-quick">
        <button class="vt-chatbot-quick-btn" data-intent="study visa">
          Study Visa
        </button>
        <button class="vt-chatbot-quick-btn" data-intent="work visa">
          Spouse Visa
        </button>
        <button class="vt-chatbot-quick-btn" data-intent="tourist visa">
          Tourist / Visitor Visa
        </button>
        <button class="vt-chatbot-quick-btn" data-intent="ielts preparation">
          IELTS / PTE / English
        </button>
        <button class="vt-chatbot-quick-btn" data-intent="consultation">
          Book a Consultation
        </button>
      </div>
    </div>

    <div class="vt-chatbot-footer">
      <input
        type="text"
        class="vt-chatbot-input"
        placeholder="Type your question..."
      />
      <button class="vt-chatbot-send" aria-label="Send message">Send</button>
    </div>

    <div class="vt-chatbot-note">
      For faster response, you can also WhatsApp us from the green icon.
    </div>
  </div>
</div>

<!-- Chatbot Script -->
<script>
  (function () {
    // Disable visa chatbot on very small screens (425px or below)
    if (window.innerWidth <= 425) {
      return;
    }

    const chatbot = document.querySelector(".vt-chatbot");
    if (!chatbot) return;

    const toggleBtn = chatbot.querySelector(".vt-chatbot-toggle");
    const windowEl = chatbot.querySelector(".vt-chatbot-window");
    const closeBtn = chatbot.querySelector(".vt-chatbot-close");
    const quickBtns = chatbot.querySelectorAll(".vt-chatbot-quick-btn");
    const inputEl = chatbot.querySelector(".vt-chatbot-input");
    const sendBtn = chatbot.querySelector(".vt-chatbot-send");
    const bodyEl = chatbot.querySelector(".vt-chatbot-body");

    function appendMessage(text, from = "user") {
      const msg = document.createElement("div");
      msg.className =
        "vt-chatbot-message " +
        (from === "bot" ? "vt-chatbot-message-bot" : "vt-chatbot-message-user");
      msg.innerHTML = text;
      bodyEl.appendChild(msg);
      bodyEl.scrollTop = bodyEl.scrollHeight;
    }

    function botReply(intentOrText) {
      let reply = "";
      const text = intentOrText.toLowerCase();

      if (text.includes("study")) {
        reply =
          "🎓 For study visa, we’ll guide you on eligibility, documents, and country options. Please share your highest qualification and preferred country.";
      } else if (text.includes("work")) {
        reply =
          "💼 For spouse visa, we help with documentation, and process steps. Please mention your target country.";
      } else if (text.includes("tourist") || text.includes("visitor")) {
        reply =
          "🧳 For tourist/visitor visa, we’ll help with basic documents, travel plans, and financial requirements. Please share your destination and tentative travel dates.";
      } else if (
        text.includes("ielts") ||
        text.includes("pte") ||
        text.includes("english")
      ) {
        reply =
          "📘 For IELTS / PTE / English coaching, we provide training for speaking, writing, listening, and reading along with mock tests and personalized improvement plans. Please share which test you want to prepare for.";
      } else if (text.includes("consultation")) {
        reply =
          "📅 We can book a consultation call for you. Please share your name, email, and phone or call/WhatsApp us at +91 8284828788.";
      } else {
        reply =
          "Thanks for your message! Our team will review your query and get back to you shortly. For urgent questions, you can also call or WhatsApp us at +91 8284828788.";
      }

      appendMessage(reply, "bot");
    }

    function handleSend() {
      const text = inputEl.value.trim();
      if (!text) return;
      appendMessage(text, "user");
      inputEl.value = "";
      setTimeout(() => botReply(text), 400);
    }

    toggleBtn.addEventListener("click", () => {
      windowEl.classList.toggle("vt-chatbot-open");
    });

    closeBtn.addEventListener("click", () => {
      windowEl.classList.remove("vt-chatbot-open");
    });

    sendBtn.addEventListener("click", handleSend);

    inputEl.addEventListener("keyup", (e) => {
      if (e.key === "Enter") handleSend();
    });

    quickBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        const intent = btn.getAttribute("data-intent");
        appendMessage(btn.innerText, "user");
        setTimeout(() => botReply(intent), 300);
      });
    });
  })();
</script>
