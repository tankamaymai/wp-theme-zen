document.addEventListener("DOMContentLoaded", function () {
  var faqQuestions = document.querySelectorAll(".faq-question");

  faqQuestions.forEach(function (question) {
    question.addEventListener("click", function () {
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
});
