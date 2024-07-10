(function (blocks, element, blockEditor, components) {
  var el = element.createElement;
  var InnerBlocks = blockEditor.InnerBlocks;
  var Fragment = element.Fragment;
  var InspectorControls = blockEditor.InspectorControls;
  var PanelBody = components.PanelBody;
  var PanelRow = components.PanelRow;
  var ToggleControl = components.ToggleControl;

  blocks.registerBlockType("zen/fullwidth", {
    title: "フルワイド",
    icon: "align-wide",
    category: "zen",
    attributes: {
      fullWidth: {
        type: "boolean",
        default: true,
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
          )
        ),
        el(
          "div",
          {
            className: fullWidth
              ? "fullwidth-block full-width"
              : "fullwidth-block",
          },
          el(InnerBlocks)
        )
      );
    },
    save: function (props) {
      var fullWidth = props.attributes.fullWidth;

      return el(
        "div",
        {
          className: fullWidth
            ? "fullwidth-block full-width"
            : "fullwidth-block",
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
