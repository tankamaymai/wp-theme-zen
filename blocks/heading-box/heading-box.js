(function (blocks, element, blockEditor, components) {
  var el = element.createElement;
  var RichText = blockEditor.RichText;
  var InspectorControls = blockEditor.InspectorControls;
  var PanelBody = components.PanelBody;
  var SelectControl = components.SelectControl;
  var ColorPalette = components.ColorPalette;

  const colors = [
    { name: "ZEN Black", color: "#333333" },
    { name: "ZEN Black Light", color: "#666666" },
    { name: "ZEN Gray", color: "#efefef" },
    { name: "True White", color: "#ffffff" },
    // 他のカラープリセットを追加
  ];

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
      boxStyle: {
        type: "string",
        default: "style1", // デフォルトのスタイル
      },
      backgroundColor: {
        type: "string",
        default: "#ffffff", // デフォルトの背景色
      },
      titleColor: {
        type: "string",
        default: "#000000", // デフォルトのタイトル文字色
      },
      descriptionColor: {
        type: "string",
        default: "#000000", // デフォルトの説明文文字色
      },
      borderColor: {
        type: "string",
        default: "#333333", // デフォルトのボーダー色（スタイル1とスタイル2で使用）
      },
      displayOnDesktop: {
        type: "string",
        default: "show",
      },
      displayOnTablet: {
        type: "string",
        default: "show",
      },
      displayOnMobile: {
        type: "string",
        default: "show",
      },
      contentWidth: {
        type: "string",
        default: "100%",
      },
    },

    edit: function (props) {
      var boxStyle = props.attributes.boxStyle;
      var backgroundColor = props.attributes.backgroundColor;
      var titleColor = props.attributes.titleColor;
      var descriptionColor = props.attributes.descriptionColor;
      var borderColor = props.attributes.borderColor;

      function onChangeBoxStyle(newStyle) {
        props.setAttributes({ boxStyle: newStyle });
      }

      function onChangeBackgroundColor(newColor) {
        props.setAttributes({ backgroundColor: newColor });
      }

      function onChangeTitleColor(newColor) {
        props.setAttributes({ titleColor: newColor });
      }

      function onChangeDescriptionColor(newColor) {
        props.setAttributes({ descriptionColor: newColor });
      }

      function onChangeBorderColor(newColor) {
        props.setAttributes({ borderColor: newColor });
      }

      const boxStyleClasses = [
        `heading-box`,
        boxStyle,
        props.attributes.displayOnDesktop === "hide" ? "hide-on-desktop" : "",
        props.attributes.displayOnTablet === "hide" ? "hide-on-tablet" : "",
        props.attributes.displayOnMobile === "hide" ? "hide-on-mobile" : "",
      ]
        .filter(Boolean)
        .join(" ");

      const boxStyleInline = {
        "--background-color": backgroundColor,
        "--title-color": titleColor,
        "--description-color": descriptionColor,
        "--border-color": borderColor,
      };

      return el(
        "div",
        { className: boxStyleClasses, style: boxStyleInline },
        el(
          InspectorControls,
          {},
          el(
            PanelBody,
            { title: "スタイル設定", initialOpen: true },
            el(SelectControl, {
              label: "スタイルを選択",
              value: boxStyle,
              options: [
                { label: "スタイル1", value: "style1" },
                { label: "スタイル2", value: "style2" },
                { label: "スタイル3", value: "style3" },
              ],
              onChange: onChangeBoxStyle,
            }),
            el("p", {}, "背景色"),
            el(ColorPalette, {
              colors: colors,
              value: backgroundColor,
              onChange: onChangeBackgroundColor,
            }),
            el("p", {}, "タイトル文字色"),
            el(ColorPalette, {
              colors: colors,
              value: titleColor,
              onChange: onChangeTitleColor,
            }),
            el("p", {}, "テキスト文字色"),
            el(ColorPalette, {
              colors: colors,
              value: descriptionColor,
              onChange: onChangeDescriptionColor,
            }),
            el("p", {}, "ボーダー色"),
            el(ColorPalette, {
              colors: colors,
              value: borderColor,
              onChange: onChangeBorderColor,
            })
          ),
          el(
            PanelBody,
            { title: "レスポンシブ設定", initialOpen: false },
            el(SelectControl, {
              label: "デスクトップで表示",
              value: props.attributes.displayOnDesktop,
              options: [
                { label: "表示", value: "show" },
                { label: "非表示", value: "hide" },
              ],
              onChange: (value) => {
                props.setAttributes({ displayOnDesktop: value });
              },
            }),
            el(SelectControl, {
              label: "タブレットで表示",
              value: props.attributes.displayOnTablet,
              options: [
                { label: "表示", value: "show" },
                { label: "非表示", value: "hide" },
              ],
              onChange: (value) => {
                props.setAttributes({ displayOnTablet: value });
              },
            }),
            el(SelectControl, {
              label: "モバイルで表示",
              value: props.attributes.displayOnMobile,
              options: [
                { label: "表示", value: "show" },
                { label: "非表示", value: "hide" },
              ],
              onChange: (value) => {
                props.setAttributes({ displayOnMobile: value });
              },
            })
          ),
          el(
            PanelBody,
            { title: "コンテンツ設定", initialOpen: false },
            el(SelectControl, {
              label: "コンテンツ幅",
              value: props.attributes.contentWidth,
              options: [
                { label: "デフォルト (1100px)", value: "1100px" },
                { label: "幅広 (1400px)", value: "1400px" },
                { label: "全幅 (100%)", value: "100%" },
              ],
              onChange: (value) => props.setAttributes({ contentWidth: value }),
            })
          ),
        ),
        el(RichText, {
          tagName: "h2",
          className: "heading-box-title",
          value: props.attributes.title,
          onChange: function (newTitle) {
            props.setAttributes({ title: newTitle });
          },
          placeholder: "タイトルを入力",
          style: {
            color: titleColor,
            backgroundColor:
              boxStyle === "style2" || boxStyle === "style3"
                ? borderColor
                : "transparent",
            maxWidth: props.attributes.contentWidth,
            margin: "0 auto",
          },
        }),
        el(RichText, {
          tagName: "p",
          className: "heading-box-description",
          value: props.attributes.description,
          onChange: function (newDescription) {
            props.setAttributes({ description: newDescription });
          },
          placeholder: "説明を入力",
          style: {
            color: descriptionColor,
            maxWidth: props.attributes.contentWidth,
            margin: "0 auto",
          },
        })
      );
    },

    save: function (props) {
      var boxStyle = props.attributes.boxStyle;
      var backgroundColor = props.attributes.backgroundColor;
      var titleColor = props.attributes.titleColor;
      var descriptionColor = props.attributes.descriptionColor;
      var borderColor = props.attributes.borderColor;

      const boxStyleClasses = [
        `heading-box`,
        boxStyle,
        props.attributes.displayOnDesktop === "hide" ? "hide-on-desktop" : "",
        props.attributes.displayOnTablet === "hide" ? "hide-on-tablet" : "",
        props.attributes.displayOnMobile === "hide" ? "hide-on-mobile" : "",
      ]
        .filter(Boolean)
        .join(" ");

      const boxStyleInline = {
        "--background-color": backgroundColor,
        "--title-color": titleColor,
        "--description-color": descriptionColor,
        "--border-color": borderColor,
      };

      return el(
        "div",
        { className: boxStyleClasses, style: boxStyleInline },
        el(RichText.Content, {
          tagName: "h2",
          className: "heading-box-title",
          value: props.attributes.title,
          style: {
            color: titleColor,
            backgroundColor:
              boxStyle === "style2" || boxStyle === "style3"
                ? borderColor
                : "transparent",
            maxWidth: props.attributes.contentWidth,
            margin: "0 auto",
          },
        }),
        el(RichText.Content, {
          tagName: "p",
          className: "heading-box-description",
          value: props.attributes.description,
          style: {
            color: descriptionColor,
            maxWidth: props.attributes.contentWidth,
            margin: "0 auto",
          },
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
