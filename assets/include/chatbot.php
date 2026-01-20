<?php
  // Reuse footer/header asset prefix if available so paths work from / and /blog/.
  $chatbotAssetPrefix = '';
  if (isset($footerAssetPrefix)) {
    $chatbotAssetPrefix = $footerAssetPrefix;
  } elseif (isset($assetPrefix)) {
    $chatbotAssetPrefix = $assetPrefix;
  }
?>

<!-- 5Trainers Chatbot Widget -->
<div class="vt-chatbot" aria-live="polite">
  <!-- Chat bubble toggle -->
  <button class="vt-chatbot-toggle" aria-label="Chat with 5Trainers">
    <i class="fa-solid fa-comments"></i>
  </button>

  <!-- Chat window -->
  <div class="vt-chatbot-window">
    <div class="vt-chatbot-header">
      <div class="vt-chatbot-title">5Trainers Assistant</div>
      <button class="vt-chatbot-close" aria-label="Close Chat">&times;</button>
    </div>

    <div class="vt-chatbot-body">
      <div class="vt-chatbot-message vt-chatbot-message-bot">
        Hi! I’m your 5Trainers course advisor.<br />
        Choose a topic below or type your question.
      </div>

      <div class="vt-chatbot-quick">
        <button class="vt-chatbot-quick-btn" data-intent="digital marketing">
          Digital Marketing Course
        </button>
        <button class="vt-chatbot-quick-btn" data-intent="data science">
          Data Science / Analytics
        </button>
        <button class="vt-chatbot-quick-btn" data-intent="full stack">
          Full Stack Development
        </button>
        <button class="vt-chatbot-quick-btn" data-intent="cyber security">
          Cyber Security / Ethical Hacking
        </button>
        <button class="vt-chatbot-quick-btn" data-intent="counseling">
          Talk to a Counselor
        </button>
      </div>
    </div>

    <div class="vt-chatbot-footer">
      <input
        type="text"
        class="vt-chatbot-input"
        placeholder="Type your question about courses..."
      />
      <button class="vt-chatbot-send" aria-label="Send message">Send</button>
    </div>

    <div class="vt-chatbot-note">
      For quick help, you can also call or WhatsApp using the floating icons.
    </div>
  </div>
</div>

<!-- Chatbot Script -->
<script>
  (function () {
    const chatbot = document.querySelector(".vt-chatbot");
    if (!chatbot) return;

    const toggleBtn = chatbot.querySelector(".vt-chatbot-toggle");
    const windowEl = chatbot.querySelector(".vt-chatbot-window");
    const closeBtn = chatbot.querySelector(".vt-chatbot-close");
    const quickBtns = chatbot.querySelectorAll(".vt-chatbot-quick-btn");
    const inputEl = chatbot.querySelector(".vt-chatbot-input");
    const sendBtn = chatbot.querySelector(".vt-chatbot-send");
    const bodyEl = chatbot.querySelector(".vt-chatbot-body");

    // Simple state for contact capture
    let hasAskedContact = false;
    let awaitingContactDetails = false;
    let firstIntentText = "";

    const sendmailUrl = "<?php echo $chatbotAssetPrefix; ?>sendmail.php";

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
      const text = (intentOrText || "").toLowerCase();

      if (text.includes("digital")) {
        reply =
          "Our Digital Marketing Course covers SEO, Google Ads, Social Media Marketing, Content Marketing and more with live projects and 100% placement assistance. Share your highest qualification and whether you prefer weekday or weekend batches.";
      } else if (text.includes("data")) {
        reply =
          "Our Data Science / Analytics programs focus on Python, statistics, machine learning, dashboards and real-time projects. Tell us if you are a beginner or already from a technical background.";
      } else if (text.includes("full stack") || text.includes("web")) {
        reply =
          "Our Full Stack Development training includes HTML, CSS, JavaScript, front-end frameworks and back-end with databases, plus deployment and portfolio projects. Let us know if you are looking for online or classroom training.";
      } else if (text.includes("cyber") || text.includes("ethical")) {
        reply =
          "Our Cyber Security / Ethical Hacking course focuses on network security, penetration testing, tools and practical labs. Please share your current education so we can suggest the best track.";
      } else if (
        text.includes("counsel") ||
        text.includes("counseling") ||
        text.includes("counselling") ||
        text.includes("talk") ||
        text.includes("call")
      ) {
        reply =
          "We can connect you with a counselor for personalized guidance. Please share your name, email and phone number, or call us directly at +91 8283840606.";
      } else {
        reply =
          "Thanks for your message! Our team will review your query and contact you shortly. For urgent questions, you can call or WhatsApp us at +91 8283840606.";
      }

      appendMessage(reply, "bot");
    }

    function isValidEmail(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function isValidPhone(phone) {
      const digits = phone.replace(/[^\d]/g, "");
      return digits.length >= 7;
    }

    function extractContactDetails(text) {
      const emailMatch = text.match(/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i);
      const phoneMatch = text.match(/(\+?\d[\d\s\-]{6,}\d)/);

      const email = emailMatch ? emailMatch[0].trim() : "";
      const phoneRaw = phoneMatch ? phoneMatch[0] : "";
      const phone = phoneRaw ? phoneRaw.trim() : "";

      let name = text;
      if (email) name = name.replace(email, "");
      if (phoneRaw) name = name.replace(phoneRaw, "");
      name = name.replace(/[,;|]+/g, " ").trim();

      return { name, email, phone };
    }

    function sendContactToServer(contact) {
      const formData = new FormData();
      formData.append("name", contact.name);
      formData.append("email", contact.email);
      formData.append("phone", contact.phone);
      formData.append("form_type", "Chatbot Lead");
      if (firstIntentText) {
        formData.append(
          "query",
          "Chatbot first question: " + firstIntentText
        );
      } else {
        formData.append("query", "Chatbot lead from 5Trainers website");
      }

      appendMessage(
        "Thank you! We are submitting your details to our counselor team.",
        "bot"
      );

      fetch(sendmailUrl, {
        method: "POST",
        body: formData,
      })
        .then((res) => {
          if (!res.ok) {
            throw new Error("Network response was not ok");
          }
          appendMessage(
            "Your details have been shared successfully. Our team will contact you shortly.",
            "bot"
          );
          // After successful submit, continue with the original question if we have it
          if (firstIntentText) {
            setTimeout(() => botReply(firstIntentText), 400);
            firstIntentText = "";
          }
        })
        .catch(() => {
          appendMessage(
            "We could not submit your details due to a technical issue. Please try again in a moment or call us at +91 8283840606.",
            "bot"
          );
        });
    }

    function handleContactStep(text) {
      const contact = extractContactDetails(text);

      const errors = [];
      const nameLettersOnly = contact.name
        ? contact.name.replace(/[^a-zA-Z]/g, "")
        : "";
      if (!nameLettersOnly || nameLettersOnly.length < 4) {
        errors.push("Name (minimum 4 letters)");
      }
      if (!contact.email || !isValidEmail(contact.email)) {
        errors.push("E-mail");
      }
      if (!contact.phone || !isValidPhone(contact.phone)) {
        errors.push("Phone Number");
      }

      if (errors.length > 0) {
        appendMessage(
          "It looks like I couldn't read your " +
            errors.join(", ") +
            ".<br />Please share them again in one line like:<br /><strong>John Doe, john@example.com, 9876543210</strong>.",
          "bot"
        );
        return;
      }

      awaitingContactDetails = false;
      sendContactToServer(contact);
    }

    function handleSend() {
      const text = (inputEl.value || "").trim();
      if (!text) return;

      appendMessage(text, "user");
      inputEl.value = "";

      // First user question: ask for contact details
      if (!hasAskedContact) {
        hasAskedContact = true;
        awaitingContactDetails = true;
        firstIntentText = text;
        appendMessage(
          "May I ask your:- Name, E-mail and Phone Number?<br /><small>Please share them in one line, e.g. <strong>John Doe, john@example.com, 9876543210</strong>.</small>",
          "bot"
        );
        return;
      }

      // If we are waiting for contact info, treat this message as contact details
      if (awaitingContactDetails) {
        handleContactStep(text);
        return;
      }

      // Normal conversation after contact is captured
      setTimeout(() => botReply(text), 400);
    }

    function openChat() {
      windowEl.classList.add("vt-chatbot-open");
    }

    function closeChat() {
      windowEl.classList.remove("vt-chatbot-open");
    }

    toggleBtn.addEventListener("click", () => {
      const isOpen = windowEl.classList.contains("vt-chatbot-open");
      if (isOpen) {
        closeChat();
      } else {
        openChat();
      }
    });

    closeBtn.addEventListener("click", () => {
      closeChat();
    });

    sendBtn.addEventListener("click", handleSend);

    inputEl.addEventListener("keyup", (e) => {
      if (e.key === "Enter") handleSend();
    });

    quickBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        const intent = btn.getAttribute("data-intent") || "";
        const label = btn.innerText;

        appendMessage(label, "user");

        // First interaction via quick button -> ask for contact
        if (!hasAskedContact) {
          hasAskedContact = true;
          awaitingContactDetails = true;
          firstIntentText = intent || label;
          appendMessage(
            "May I ask your:- Name, E-mail and Phone Number?<br /><small>Please share them in one line, e.g. <strong>John Doe, john@example.com, 9876543210</strong>.</small>",
            "bot"
          );
          return;
        }

        if (awaitingContactDetails) {
          // If user presses a quick button while we are waiting for contact,
          // treat it like a normal message but remind them what we need.
          appendMessage(
            "Please share your Name, E-mail and Phone Number so we can assist you better.",
            "bot"
          );
          return;
        }

        setTimeout(() => botReply(intent || label), 300);
      });
    });

    // Auto-open chat window shortly after page load
    window.addEventListener("load", () => {
      setTimeout(() => {
        openChat();
      }, 2000);
    });
  })();
</script>
