(function (blocks, element, blockEditor, components) {
  var el = element.createElement;
  var RichText = blockEditor.RichText;
  var Fragment = element.Fragment;
  var Button = components.Button;
  var IconButton = components.IconButton;
  var ToggleControl = components.ToggleControl;
  var InspectorControls = blockEditor.InspectorControls;
  var PanelBody = components.PanelBody;
  var AlignmentToolbar = blockEditor.AlignmentToolbar;
  var BlockControls = blockEditor.BlockControls;

  // FAQブロックの登録
  blocks.registerBlockType("mytheme/accordion", {
    title: "アコーディオン",
    icon: "editor-help",
    category: "zen",
    attributes: {
      questions: {
        type: "array",
        default: [],
        source: "query",
        selector: ".accordion-item",
        query: {
          question: {
            type: "string",
            source: "html",
            selector: ".accordion-question",
          },
          answer: {
            type: "string",
            source: "html",
            selector: ".accordion-answer",
          },
        },
      },
      alwaysOpen: {
        type: "boolean",
        default: false,
      },
      alignment: {
        type: "string",
        default: "left",
      },
    },

    edit: function (props) {
      var questions = props.attributes.questions;
      var alwaysOpen = props.attributes.alwaysOpen;

      function onChangeAlignment(newAlignment) {
        props.setAttributes({ alignment: newAlignment === undefined ? "center" : newAlignment });
      }

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

      var toggleAlwaysOpen = function () {
        props.setAttributes({ alwaysOpen: !alwaysOpen });
      };

      return el(
        Fragment,
        {},
        el(
          BlockControls,
          null,
          el(AlignmentToolbar, {
            value: props.attributes.alignment,
            onChange: onChangeAlignment,
          })
        ),
        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: "設定", initialOpen: true },
            el(ToggleControl, {
              label: "常に回答を表示",
              checked: alwaysOpen,
              onChange: toggleAlwaysOpen,
            })
          )
        ),
        el(
          "div",
          {
            className: "accordion-block",
            style: {
              textAlign: props.attributes.alignment
            }
          },
          questions.map(function (item, index) {
            return el(
              "div",
              { className: "accordion-item", key: index,
                style: {
                  textAlign: props.attributes.alignment
                }
              },
              el(RichText, {
                tagName: "div",
                className: "accordion-question",
                placeholder: "質問を入力",
                value: item.question,
                onChange: function (value) {
                  return updateQuestion(value, index);
                },
              }),
              el(RichText, {
                tagName: "div",
                className: "accordion-answer",
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
      var alwaysOpen = props.attributes.alwaysOpen;

      return el(
        "div",
        {
          className: "accordion-block",
          "data-always-open": alwaysOpen,
          style: {
            textAlign: props.attributes.alignment
          }
        },
        questions.map(function (item, index) {
          return el(
            "div",
            { className: "accordion-item", key: index,
              style: {
                textAlign: props.attributes.alignment
              }
             },
            el("div", { className: "accordion-question" }, item.question),
            el("div", { className: "accordion-answer" }, item.answer)
          );
        })
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor,
  window.wp.components
);