(function (blocks, element, blockEditor) {
  var el = element.createElement;
  var RichText = blockEditor.RichText;
  var Fragment = element.Fragment;
  var Button = wp.components.Button;
  var IconButton = wp.components.IconButton;

  blocks.registerBlockType("mytheme/faq", {
    title: "FAQ",
    icon: "editor-help",
    category: "zen",
    attributes: {
      questions: {
        type: "array",
        default: [],
        source: "query",
        selector: ".faq-item",
        query: {
          question: {
            type: "string",
            source: "html",
            selector: ".faq-question",
          },
          answer: {
            type: "string",
            source: "html",
            selector: ".faq-answer",
          },
        },
      },
    },
    edit: function (props) {
      var questions = props.attributes.questions;

      var updateQuestion = function (value, index) {
        var newQuestions = questions.slice();
        newQuestions[index].question = value;
        props.setAttributes({ questions: newQuestions });
      };

      var updateAnswer = function (value, index) {
        var newQuestions = questions.slice();
        newQuestions[index].answer = value;
        props.setAttributes({ questions: newQuestions });
      };

      var addQuestion = function () {
        var newQuestions = questions.concat([{ question: "", answer: "" }]);
        props.setAttributes({ questions: newQuestions });
      };

      var removeQuestion = function (index) {
        var newQuestions = questions.slice();
        newQuestions.splice(index, 1);
        props.setAttributes({ questions: newQuestions });
      };

      return el(
        Fragment,
        {},
        el(
          "div",
          { className: "faq-block" },
          questions.map(function (item, index) {
            return el(
              "div",
              { className: "faq-item", key: index },
              el(RichText, {
                tagName: "div",
                className: "faq-question",
                placeholder: "質問を入力",
                value: item.question,
                onChange: function (value) {
                  return updateQuestion(value, index);
                },
              }),
              el(RichText, {
                tagName: "div",
                className: "faq-answer",
                placeholder: "回答を入力",
                value: item.answer,
                onChange: function (value) {
                  return updateAnswer(value, index);
                },
              }),
              el(IconButton, {
                icon: "trash",
                label: "削除",
                onClick: function () {
                  return removeQuestion(index);
                },
              })
            );
          }),
          el(
            Button,
            {
              isPrimary: true,
              onClick: addQuestion,
            },
            "質問を追加"
          )
        )
      );
    },
    save: function (props) {
      var questions = props.attributes.questions;

      return el(
        "div",
        { className: "faq-block" },
        questions.map(function (item, index) {
          return el(
            "div",
            { className: "faq-item", key: index },
            el("div", { className: "faq-question" }, item.question),
            el("div", { className: "faq-answer" }, item.answer)
          );
        })
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
