document.addEventListener("DOMContentLoaded", function () {
  console.log("DOMContentLoaded event fired");
  var faqBlocks = document.querySelectorAll(".faq-block");
  faqBlocks.forEach(function (block) {
    var alwaysOpen = block.getAttribute("data-always-open") === "true";
    if (!alwaysOpen) {
      var faqQuestions = block.querySelectorAll(".faq-question");
      faqQuestions.forEach(function (question) {
        question.addEventListener("click", function () {
          console.log("FAQ question clicked:", question);
          var faqItem = this.parentElement;
          faqItem.classList.toggle("active");
          var answer = faqItem.querySelector(".faq-answer");
          if (faqItem.classList.contains("active")) {
            answer.style.maxHeight = answer.scrollHeight + "px";
          } else {
            answer.style.maxHeight = null;
          }
        });
      });
    } else {
      block.querySelectorAll(".faq-item").forEach(function (item) {
        item.classList.add("active");
        var answer = item.querySelector(".faq-answer");
        answer.style.maxHeight = answer.scrollHeight + "px";
      });
    }
  });
});
