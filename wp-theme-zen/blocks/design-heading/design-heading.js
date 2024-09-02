(function (blocks, element, blockEditor, components) {
  var el = element.createElement;
  var RichText = blockEditor.RichText;
  var InspectorControls = blockEditor.InspectorControls;
  var PanelBody = components.PanelBody;
  var SelectControl = components.SelectControl;
  var FontSizePicker = blockEditor.FontSizePicker;
  var withColors = blockEditor.withColors;
  var PanelColorSettings = blockEditor.PanelColorSettings;
  var AlignmentToolbar = blockEditor.AlignmentToolbar;
var BlockControls = blockEditor.BlockControls;

  

  blocks.registerBlockType("mytheme/design-heading", {
    title: "デザイン見出し",
    icon: "heading",
    category: "zen",
    attributes: {
      content: {
        type: "string",
        source: "html",
        selector: "h2",
      },
      fontSize: {
        type: "number",
      },
      textColor: {
        type: "string",
      },
      backgroundColor: {
        type: "string",
      },
      styleClass: {
        type: "string",
        default: "default-style",
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
        default: "1100px",
      },
      alignment: {
        type: "string",
        default: "left",
      },
    },

    edit: withColors(
      "textColor",
      "backgroundColor"
    )(function (props) {
      function onChangeContent(newContent) {
        props.setAttributes({ content: newContent });
      }
      function onStyleChange(newStyle) {
        props.setAttributes({ styleClass: newStyle });
      }
      function onChangeAlignment(newAlignment) {
        props.setAttributes({ alignment: newAlignment === undefined ? "none" : newAlignment });
      }
      // エディタ内では非表示クラスを適用しない
      const classes = [props.className, props.attributes.styleClass]
        .filter(Boolean)
        .join(" ");

      return [
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
            el(FontSizePicker, {
              value: props.attributes.fontSize,
              onChange: (value) => props.setAttributes({ fontSize: value }),
            }),
            el(PanelColorSettings, {
              title: "カラー設定",
              colorSettings: [
                {
                  value: props.attributes.textColor,
                  onChange: (value) =>
                    props.setAttributes({ textColor: value }),
                  label: "テキストカラー",
                },
                {
                  value: props.attributes.backgroundColor,
                  onChange: (value) =>
                    props.setAttributes({ backgroundColor: value }),
                  label: "背景カラー",
                },
              ],
            }),
            el(SelectControl, {
              label: "スタイル",
              value: props.attributes.styleClass,
              options: [
                { label: "デフォルト", value: "default-style" },
                { label: "ベタ塗り", value: "solid-style" },
                { label: "下線", value: "underline-style" },
                { label: "上下線", value: "lines-style" },
              ],
              onChange: onStyleChange,
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
        el(
          "h2",
          {
            className: classes,
            style: {
              fontSize: props.attributes.fontSize,
              color: props.attributes.textColor,
              backgroundColor: props.attributes.backgroundColor,
              maxWidth: props.attributes.contentWidth,
              margin: "0 auto", // 中央揃えにするため
              textAlign: props.attributes.alignment,
            },
          },
          el(RichText, {
            value: props.attributes.content,
            onChange: onChangeContent,
            placeholder: "見出しテキストを入力",
          })
        ),
        
      ];
    }),

    save: function (props) {
      const classes = [
        props.className,
        props.attributes.styleClass,
        props.attributes.displayOnDesktop === "hide" ? "hide-on-desktop" : "",
        props.attributes.displayOnTablet === "hide" ? "hide-on-tablet" : "",
        props.attributes.displayOnMobile === "hide" ? "hide-on-mobile" : "",
      ]
        .filter(Boolean)
        .join(" ");

      console.log("Saved attributes:", props.attributes); // デバッグ用ログ

      return el(
        "h2",
        {
          className: classes,
          style: {
            fontSize: props.attributes.fontSize,
            color: props.attributes.textColor,
            backgroundColor: props.attributes.backgroundColor,
            maxWidth: props.attributes.contentWidth,
            margin: "0 auto",
            textAlign: props.attributes.alignment,
          },
        },
        props.attributes.content
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor,
  window.wp.components
);
