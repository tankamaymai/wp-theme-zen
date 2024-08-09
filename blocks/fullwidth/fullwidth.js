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
    },
    edit: function (props) {
      var fullWidth = props.attributes.fullWidth;

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
            ]
              .filter(Boolean)
              .join(" "),
          },
          el(InnerBlocks)
        )
      );
    },
    save: function (props) {
      var fullWidth = props.attributes.fullWidth;

      const classes = [
        "fullwidth-block",
        fullWidth ? "full-width" : "",
        props.attributes.displayOnDesktop === "hide" ? "hide-on-desktop" : "",
        props.attributes.displayOnTablet === "hide" ? "hide-on-tablet" : "",
        props.attributes.displayOnMobile === "hide" ? "hide-on-mobile" : "",
      ]
        .filter(Boolean)
        .join(" ");

      return el(
        "div",
        {
          className: classes,
        },
        el(InnerBlocks.Content)
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor,
  window.wp.components
);
