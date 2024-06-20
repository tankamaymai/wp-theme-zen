document.addEventListener("DOMContentLoaded", function () {
  console.log("DOMContentLoaded event fired");
  var faqQuestions = document.querySelectorAll(".faq-question");
  console.log("FAQ questions found:", faqQuestions);

  faqQuestions.forEach(function (question) {
    question.addEventListener("click", function () {
      console.log("FAQ question clicked:", question);
      var faqItem = this.parentElement;
      faqItem.classList.toggle("active");
    });
  });
});
