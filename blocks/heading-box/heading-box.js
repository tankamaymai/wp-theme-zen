(function (blocks, element, blockEditor) {
  var el = element.createElement;
  var RichText = blockEditor.RichText;

  blocks.registerBlockType("mytheme/heading-box", {
    title: "見出しボックス",
    icon: "welcome-write-blog",
    category: "zen",
    attributes: {
      title: {
        type: "string",
        source: "html",
        selector: ".heading-box-title",
      },
      description: {
        type: "string",
        source: "html",
        selector: ".heading-box-description",
      },
    },

    edit: function (props) {
      return el(
        "div",
        { className: "heading-box" },
        el(RichText, {
          tagName: "h2",
          className: "heading-box-title",
          value: props.attributes.title,
          onChange: function (newTitle) {
            props.setAttributes({ title: newTitle });
          },
          placeholder: "タイトルを入力",
        }),
        el(RichText, {
          tagName: "p",
          className: "heading-box-description",
          value: props.attributes.description,
          onChange: function (newDescription) {
            props.setAttributes({ description: newDescription });
          },
          placeholder: "説明を入力",
        })
      );
    },

    save: function (props) {
      return el(
        "div",
        { className: "heading-box" },
        el(RichText.Content, {
          tagName: "h2",
          className: "heading-box-title",
          value: props.attributes.title,
        }),
        el(RichText.Content, {
          tagName: "p",
          className: "heading-box-description",
          value: props.attributes.description,
        })
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
