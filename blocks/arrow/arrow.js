(function (blocks, element, blockEditor, components, data) {
  var el = element.createElement;
  var Fragment = element.Fragment;
  var InspectorControls = blockEditor.InspectorControls;
  var BlockControls = blockEditor.BlockControls;
  var AlignmentToolbar = blockEditor.AlignmentToolbar;
  var PanelBody = components.PanelBody;
  var SelectControl = components.SelectControl;
  var ColorPalette = components.ColorPalette;
  var RangeControl = components.RangeControl;
  var useBlockProps = blockEditor.useBlockProps;
  var useSelect = data.useSelect;

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
      textAlign: {
        type: "string",
        default: "center",
      },
    },
    edit: function (props) {
      var blockProps = useBlockProps();
      var { attributes, setAttributes } = props;
      var { direction, type, color, width, height, strokeWidth, textAlign } = attributes;

      // コンテンツ幅の設定値を取得
      var contentWidth = useSelect(function(select) {
        return select('core/editor').getEditorSettings().maxWidth;
      }, []);

      function onChangeDirection(newDirection) {
        setAttributes({ direction: newDirection });
      }

      function onChangeType(newType) {
        setAttributes({ type: newType });
      }

      function onChangeColor(newColor) {
        setAttributes({ color: newColor });
      }

      function onChangeWidth(newWidth) {
        setAttributes({ width: Number(newWidth) });
      }

      function onChangeHeight(newHeight) {
        setAttributes({ height: Number(newHeight) });
      }

      function onChangeStrokeWidth(newStrokeWidth) {
        setAttributes({ strokeWidth: Number(newStrokeWidth) });
      }

      function onChangeTextAlign(newTextAlign) {
        setAttributes({ textAlign: newTextAlign });
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
        }

        var pathData;
        switch (type) {
          case "triangle":
            pathData = "M12 0L24 24L0 24Z";
            break;
          case "line":
            pathData = "M2 12L22 12M22 12L18 8M22 12L18 16";
            break;
          case "double":
            pathData = "M2 12L22 12M22 12L18 8M22 12L18 16M2 12L6 8M2 12L6 16";
            break;
          default:
            pathData = "M12 2L10.59 3.41 18.17 11H2V13H18.17L10.59 20.59L12 22L22 12Z";
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
          },
          el("path", { d: pathData })
        );
      };

      return el(
        Fragment,
        null,
        el(
          BlockControls,
          null,
          el(AlignmentToolbar, {
            value: textAlign,
            onChange: onChangeTextAlign,
          })
        ),
        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: "矢印の設定" },
            el(SelectControl, {
              label: "方向",
              value: direction,
              options: [
                { label: "上", value: "up" },
                { label: "下", value: "down" },
                { label: "左", value: "left" },
                { label: "右", value: "right" },
              ],
              onChange: onChangeDirection,
            }),
            el(SelectControl, {
              label: "タイプ",
              value: type,
              options: [
                { label: "三角形", value: "triangle" },
                { label: "線", value: "line" },
                { label: "二重線", value: "double" },
                { label: "標準", value: "default" },
              ],
              onChange: onChangeType,
            }),
            el(ColorPalette, {
              label: "色",
              value: color,
              onChange: onChangeColor,
            }),
            el(RangeControl, {
              label: "幅",
              value: width,
              onChange: onChangeWidth,
              min: 20,
              max: 500,
            }),
            el(RangeControl, {
              label: "高さ",
              value: height,
              onChange: onChangeHeight,
              min: 20,
              max: 500,
            }),
            el(RangeControl, {
              label: "線の太さ",
              value: strokeWidth,
              onChange: onChangeStrokeWidth,
              min: 1,
              max: 20,
            })
          )
        ),
        el(
          "div",
          {
            ...blockProps,
            className: `arrow-block has-text-align-${textAlign}`,
            style: { 
              maxWidth: contentWidth ? contentWidth : '100%',
              width: '100%'
            },
          },
          arrowSVG()
        )
      );
    },
    save: function (props) {
      var blockProps = useBlockProps.save();
      var { attributes } = props;
      var { direction, type, color, width, height, strokeWidth, textAlign } = attributes;

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
      }

      var pathData;
      switch (type) {
        case "triangle":
          pathData = "M12 0L24 24L0 24Z";
          break;
        case "line":
          pathData = "M2 12L22 12M22 12L18 8M22 12L18 16";
          break;
        case "double":
          pathData = "M2 12L22 12M22 12L18 8M22 12L18 16M2 12L6 8M2 12L6 16";
          break;
        default:
          pathData = "M12 2L10.59 3.41 18.17 11H2V13H18.17L10.59 20.59L12 22L22 12Z";
      }

      return el(
        "div",
        {
          ...blockProps,
          className: `arrow-block has-text-align-${textAlign}`,
          style: { width: '100%' },
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
})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.components, window.wp.data);