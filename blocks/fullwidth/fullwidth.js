(function (blocks, element, blockEditor, components) {
  var el = element.createElement;
  var InnerBlocks = blockEditor.InnerBlocks;
  var Fragment = element.Fragment;
  var InspectorControls = blockEditor.InspectorControls;
  var PanelBody = components.PanelBody;
  var PanelRow = components.PanelRow;
  var ToggleControl = components.ToggleControl;
  var SelectControl = components.SelectControl;

  blocks.registerBlockType("zen/fullwidth", {
    title: "フルワイド",
    icon: "align-wide",
    category: "zen",
    attributes: {
      fullWidth: {
        type: "boolean",
        default: false,
      },
      separatorType: {
        type: "string",
        default: "none",
      },
      backgroundColor: {
        type: "string",
        default: "#E6E6E6",
      },
      separatorColor: {
        type: "string",
        default: "#E6E6E6",
      },
    },
    edit: function (props) {
      var fullWidth = props.attributes.fullWidth;
      var separatorType = props.attributes.separatorType;

      var toggleFullWidth = function () {
        props.setAttributes({ fullWidth: !fullWidth });
      };

      return el(
        Fragment,
        {},
        el(
          InspectorControls,
          {},
          el(
            PanelBody,
            { title: "設定", initialOpen: true },
            el(
              PanelRow,
              {},
              el(ToggleControl, {
                label: "フルワイド幅",
                checked: fullWidth,
                onChange: toggleFullWidth,
              })
            )
          ),
          el(
            PanelBody,
            { title: "区切りタイプ", initialOpen: false },
            el(SelectControl, {
              label: "区切りタイプを選択",
              value: separatorType,
              options: [
                { label: "なし", value: "none" },
                { label: "斜線", value: "slant" },
                { label: "円", value: "circle" },
                { label: "波", value: "wave" },
                { label: "ジグザグ", value: "zigzag" },
              ],
              onChange: (value) => {

                props.setAttributes({ separatorType: value });
              },
            }),
          ),
          el(
            PanelBody,
            { title: "背景色", initialOpen: false },
            el(components.ColorPalette, {
              value: props.attributes.backgroundColor,
              onChange: (color) => props.setAttributes({ backgroundColor: color, separatorColor: color }),
            })
          )
        ),
        el(
          Fragment,
          {},
          separatorType !== "none" && el("div", {
            className: "separator-container separator-top",
            dangerouslySetInnerHTML: { __html: getSeparatorSVG(separatorType, true, props.attributes.separatorColor) }
          }),
          el(
            "div",
            {
              className: [
                "fullwidth-block",
                fullWidth ? "full-width" : "",
              ]
                .filter(Boolean)
                .join(" "),
              style: props.attributes.backgroundColor ? { backgroundColor: props.attributes.backgroundColor } : undefined,
            },
            el("div", { className: "block-content" }, el(InnerBlocks))
          ),
          separatorType !== "none" && el("div", {
            className: "separator-container separator-bottom",
            dangerouslySetInnerHTML: { __html: getSeparatorSVG(separatorType, false, props.attributes.separatorColor) }
          })
        )
      );
    },
    save: function (props) {
      var fullWidth = props.attributes.fullWidth;
      var separatorType = props.attributes.separatorType;

      const classes = [
        "fullwidth-block",
        fullWidth ? "full-width" : "",
      ]
        .filter(Boolean)
        .join(" ");

      return el(
        Fragment,
        {},
        separatorType !== "none" && el("div", {
          className: "separator-container separator-top",
          dangerouslySetInnerHTML: { __html: getSeparatorSVG(separatorType, true) }
        }),
        el(
          "div",
          {
            className: classes,
            style: props.attributes.backgroundColor ? { backgroundColor: props.attributes.backgroundColor } : undefined,
          },
          el("div", { className: "block-content" }, el(InnerBlocks.Content))
        ),
        separatorType !== "none" && el("div", {
          className: "separator-container separator-bottom",
          dangerouslySetInnerHTML: { __html: getSeparatorSVG(separatorType, false) }
        })
      );
    },
  });

  function getSeparatorSVG(type, isTop, color) {
    const path = getSeparatorPath(type);
    return `<svg class="separator-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" ${isTop ? 'style="transform: rotate(180deg);"' : ''}>
              <path fill="${color}" d="${path}"></path>
            </svg>`;
  }

  function getSeparatorPath(type) {
    switch (type) {
      case "slant":
        return '<path d="M0,0 L1000,100 L1000,0 Z"></path>';
      case "circle":
        return '<path d="M0,100 C200,0 800,0 1000,100 Z"></path>';
      case "wave":
        return '<path d="M0,40 C250,0 750,0 1000,40 L1000,100 L0,100 Z"></path>';
      case "zigzag":
        return '<polygon points="0,100 0,0 250,100 500,0 750,100 1000,0 1000,100"></polygon>';
      default:
        return '';
    }
  }
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor,
  window.wp.components
);