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
        default: true,
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
      separatorType: {
        type: "string",
        default: "none",
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
                { label: "波", value: "wave" },
                { label: "三角", value: "triangle" },
                { label: "斜め", value: "diagonal" },
              ],
              onChange: (value) => {
                props.setAttributes({ separatorType: value });
              },
            })
          )
        ),
        el(
          "div",
          {
            className: [
              "fullwidth-block",
              fullWidth ? "full-width" : "",
              props.attributes.displayOnDesktop === "hide"
                ? "hide-on-desktop"
                : "",
              props.attributes.displayOnTablet === "hide"
                ? "hide-on-tablet"
                : "",
              props.attributes.displayOnMobile === "hide"
                ? "hide-on-mobile"
                : "",
              "separator-" + separatorType,
            ]
              .filter(Boolean)
              .join(" "),
          },
          el(
            "div",
            { className: "separator-container separator-top" },
            el("div", { className: "separator " + separatorType })
          ),
          el("div", { className: "block-content" }, el(InnerBlocks)),
          el(
            "div",
            { className: "separator-container separator-bottom" },
            el("div", { className: "separator " + separatorType })
          )
        )
      );
    },
    save: function (props) {
      var fullWidth = props.attributes.fullWidth;
      var separatorType = props.attributes.separatorType;

      const classes = [
        "fullwidth-block",
        fullWidth ? "full-width" : "",
        props.attributes.displayOnDesktop === "hide" ? "hide-on-desktop" : "",
        props.attributes.displayOnTablet === "hide" ? "hide-on-tablet" : "",
        props.attributes.displayOnMobile === "hide" ? "hide-on-mobile" : "",
        "separator-" + separatorType,
      ]
        .filter(Boolean)
        .join(" ");

      return el(
        "div",
        {
          className: classes,
        },
        el(
          "div",
          { className: "separator-container separator-top" },
          el("div", { className: "separator " + separatorType })
        ),
        el("div", { className: "block-content" }, el(InnerBlocks.Content)),
        el(
          "div",
          { className: "separator-container separator-bottom" },
          el("div", { className: "separator " + separatorType })
        )
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor,
  window.wp.components
);
