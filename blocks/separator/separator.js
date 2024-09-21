(function (blocks, element, blockEditor, components) {
  var el = element.createElement;
  var Fragment = element.Fragment;
  var InspectorControls = blockEditor.InspectorControls;
  var PanelBody = components.PanelBody;
  var ColorPalette = components.ColorPalette;
  var RangeControl = components.RangeControl;
  var SelectControl = components.SelectControl;

  blocks.registerBlockType("zen/separator", {
    title: "区切り線",
    icon: "minus",
    category: "zen",
    attributes: {
      color: {
        type: "string",
        default: "#000000",
      },
      thickness: {
        type: "number",
        default: 2,
      },
      width: {
        type: "number",
        default: 100,
      },
      style: {
        type: "string",
        default: "solid",
      },
    },
    edit: function (props) {
      var color = props.attributes.color;
      var thickness = props.attributes.thickness;
      var width = props.attributes.width;
      var style = props.attributes.style;

      function onChangeColor(newColor) {
        props.setAttributes({ color: newColor });
      }

      function onChangeThickness(newThickness) {
        props.setAttributes({ thickness: Number(newThickness) });
      }

      function onChangeWidth(newWidth) {
        props.setAttributes({ width: Number(newWidth) });
      }

      function onChangeStyle(newStyle) {
        props.setAttributes({ style: newStyle });
      }

      return el(
        Fragment,
        {},
        el(
          InspectorControls,
          {},
          el(
            PanelBody,
            { title: "設定", initialOpen: true },
            el("p", {}, "色"),
            el(ColorPalette, {
              value: color,
              onChange: onChangeColor,
            }),
            el("p", {}, "太さ (px)"),
            el(RangeControl, {
              value: thickness,
              onChange: onChangeThickness,
              min: 1,
              max: 10,
            }),
            el("p", {}, "幅 (%)"),
            el(RangeControl, {
              value: width,
              onChange: onChangeWidth,
              min: 1,
              max: 100,
            }),
            el(SelectControl, {
              label: "スタイル",
              value: style,
              options: [
                { label: "実線", value: "solid" },
                { label: "破線", value: "dashed" },
                { label: "点線", value: "dotted" },
              ],
              onChange: onChangeStyle,
            })
          )
        ),
        el("hr", {
          style: {
            borderTop: thickness + "px " + style + " " + color,
            width: width + "%",
          },
        })
      );
    },
    save: function (props) {
      var color = props.attributes.color;
      var thickness = props.attributes.thickness;
      var width = props.attributes.width;
      var style = props.attributes.style;

      return el("hr", {
        style: {
          borderTop: thickness + "px " + style + " " + color,
          width: width + "%",
        },
      });
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor,
  window.wp.components
);