(function (blocks, element, blockEditor, components) {
  var el = element.createElement;
  var Fragment = element.Fragment;
  var InspectorControls = blockEditor.InspectorControls;
  var PanelBody = components.PanelBody;
  var SelectControl = components.SelectControl;
  var ColorPalette = components.ColorPalette;
  var RangeControl = components.RangeControl;

  blocks.registerBlockType("zen/arrow", {
    title: "矢印",
    icon: "arrow-down-alt2",
    category: "zen",
    attributes: {
      direction: {
        type: "string",
        default: "down",
      },
      type: {
        type: "string",
        default: "triangle",
      },
      color: {
        type: "string",
        default: "#000000",
      },
      width: {
        type: "number",
        default: 100,
      },
      height: {
        type: "number",
        default: 100,
      },
      strokeWidth: {
        type: "number",
        default: 2,
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
      var direction = props.attributes.direction;
      var type = props.attributes.type;
      var color = props.attributes.color;
      var width = props.attributes.width;
      var height = props.attributes.height;
      var strokeWidth = props.attributes.strokeWidth;

      function onChangeDirection(newDirection) {
        props.setAttributes({ direction: newDirection });
      }

      function onChangeType(newType) {
        props.setAttributes({ type: newType });
      }

      function onChangeColor(newColor) {
        props.setAttributes({ color: newColor });
      }

      function onChangeWidth(newWidth) {
        props.setAttributes({ width: Number(newWidth) });
      }

      function onChangeHeight(newHeight) {
        props.setAttributes({ height: Number(newHeight) });
      }

      function onChangeStrokeWidth(newStrokeWidth) {
        props.setAttributes({ strokeWidth: Number(newStrokeWidth) });
      }

      var arrowSVG = function () {
        var rotation = "rotate(0deg)";
        switch (direction) {
          case "up":
            rotation = "rotate(180deg)";
            break;
          case "left":
            rotation = "rotate(-90deg)";
            break;
          case "right":
            rotation = "rotate(90deg)";
            break;
          // 'down' is the default and does not need rotation
        }

        var pathData;
        switch (type) {
          case "triangle":
            pathData = "M12 0L24 24L0 24Z"; // 調整された三角形のパス
            break;
          case "line":
            pathData = "M2 12L22 12M22 12L18 8M22 12L18 16";
            break;
          case "double":
            pathData = "M2 12L22 12M22 12L18 8M22 12L18 16M2 12L6 8M2 12L6 16";
            break;
          default:
            pathData =
              "M12 2L10.59 3.41 18.17 11H2V13H18.17L10.59 20.59L12 22L22 12Z";
        }

        return el(
          "svg",
          {
            xmlns: "http://www.w3.org/2000/svg",
            viewBox: "0 0 24 24",
            width: width,
            height: height,
            style: {
              transform: rotation,
              fill: color,
              stroke: color,
              strokeWidth: strokeWidth,
            },
            className: [
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
          el("path", { d: pathData })
        );
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
            el(SelectControl, {
              label: "方向",
              value: direction,
              options: [
                { label: "下", value: "down" },
                { label: "左", value: "left" },
                { label: "上", value: "up" },
                { label: "右", value: "right" },
              ],
              onChange: onChangeDirection,
            }),
            el(SelectControl, {
              label: "種類",
              value: type,
              options: [
                { label: "標準", value: "standard" },
                { label: "三角形", value: "triangle" },
                { label: "線", value: "line" },
                { label: "ダブル", value: "double" },
              ],
              onChange: onChangeType,
            }),
            el("p", {}, "色"),
            el(ColorPalette, {
              value: color,
              onChange: onChangeColor,
            }),
            el("p", {}, "幅 (px)"),
            el(RangeControl, {
              value: width,
              onChange: onChangeWidth,
              min: 1,
              max: 100,
            }),
            el("p", {}, "高さ (px)"),
            el(RangeControl, {
              value: height,
              onChange: onChangeHeight,
              min: 1,
              max: 100,
            }),
            el("p", {}, "線幅 (px)"),
            el(RangeControl, {
              value: strokeWidth,
              onChange: onChangeStrokeWidth,
              min: 1,
              max: 10,
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
        el(
          "div",
          {
            className: "arrow-block",
          },
          arrowSVG()
        )
      );
    },
    save: function (props) {
      var direction = props.attributes.direction;
      var type = props.attributes.type;
      var color = props.attributes.color;
      var width = props.attributes.width;
      var height = props.attributes.height;
      var strokeWidth = props.attributes.strokeWidth;

      var rotation = "rotate(0deg)";
      switch (direction) {
        case "up":
          rotation = "rotate(180deg)";
          break;
        case "left":
          rotation = "rotate(-90deg)";
          break;
        case "right":
          rotation = "rotate(90deg)";
          break;
        // 'down' is the default and does not need rotation
      }

      var pathData;
      switch (type) {
        case "triangle":
          pathData = "M12 0L24 24L0 24Z"; // 調整された三角形のパス
          break;
        case "line":
          pathData = "M2 12L22 12M22 12L18 8M22 12L18 16";
          break;
        case "double":
          pathData = "M2 12L22 12M22 12L18 8M22 12L18 16M2 12L6 8M2 12L6 16";
          break;
        default:
          pathData =
            "M12 2L10.59 3.41 18.17 11H2V13H18.17L10.59 20.59L12 22L22 12Z";
      }

      const classes = [
        "arrow-block",
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
        el(
          "svg",
          {
            xmlns: "http://www.w3.org/2000/svg",
            viewBox: "0 0 24 24",
            width: width,
            height: height,
            style: {
              transform: rotation,
              fill: color,
              stroke: color,
              strokeWidth: strokeWidth,
            },
          },
          el("path", { d: pathData })
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
