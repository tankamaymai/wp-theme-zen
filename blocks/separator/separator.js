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
        el("hr", {
          style: {
            borderTop: thickness + "px " + style + " " + color,
            width: width + "%",
          },
          className: [
            props.attributes.displayOnDesktop === "hide"
              ? "hide-on-desktop"
              : "",
            props.attributes.displayOnTablet === "hide" ? "hide-on-tablet" : "",
            props.attributes.displayOnMobile === "hide" ? "hide-on-mobile" : "",
          ]
            .filter(Boolean)
            .join(" "),
        })
      );
    },
    save: function (props) {
      var color = props.attributes.color;
      var thickness = props.attributes.thickness;
      var width = props.attributes.width;
      var style = props.attributes.style;

      const classes = [
        props.attributes.displayOnDesktop === "hide" ? "hide-on-desktop" : "",
        props.attributes.displayOnTablet === "hide" ? "hide-on-tablet" : "",
        props.attributes.displayOnMobile === "hide" ? "hide-on-mobile" : "",
      ]
        .filter(Boolean)
        .join(" ");

      return el("hr", {
        style: {
          borderTop: thickness + "px " + style + " " + color,
          width: width + "%",
        },
        className: classes,
      });
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor,
  window.wp.components
);
