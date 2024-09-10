const { __ } = wp.i18n;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, TextControl } = wp.components;
const { createHigherOrderComponent } = wp.compose;

const withMarginPaddingControl = createHigherOrderComponent((BlockEdit) => {
  return (props) => {
    const { attributes, setAttributes } = props;
    const {
      marginTop,
      marginBottom,
      marginLeft,
      marginRight,
      paddingTop,
      paddingBottom,
      paddingLeft,
      paddingRight,
    } = attributes;

    // インラインスタイルをラップする要素に適用
    const blockStyle = {
      marginTop: `${marginTop}px`,
      marginBottom: `${marginBottom}px`,
      marginLeft: `${marginLeft}px`,
      marginRight: `${marginRight}px`,
      paddingTop: `${paddingTop}px`,
      paddingBottom: `${paddingBottom}px`,
      paddingLeft: `${paddingLeft}px`,
      paddingRight: `${paddingRight}px`,
    };

    return (
      <div style={blockStyle}>
        <BlockEdit {...props} />
        <InspectorControls>
          <PanelBody
            title={
              <>
                <img
                  src={myThemeData.themeUrl + "/assets/icon.png"}
                  alt="ZEN"
                  style={{ width: "18px", height: "18px", marginRight: "5px" }}
                />
                {__("マージン設定 (px)", "text-domain")}
              </>
            }
          >
            <div style={{ display: "flex", gap: "10px" }}>
              <TextControl
                label={__("左", "text-domain")}
                value={marginLeft}
                onChange={(value) =>
                  setAttributes({ marginLeft: Number(value) })
                }
                type="number"
              />
              <TextControl
                label={__("上", "text-domain")}
                value={marginTop}
                onChange={(value) =>
                  setAttributes({ marginTop: Number(value) })
                }
                type="number"
              />
              <TextControl
                label={__("右", "text-domain")}
                value={marginRight}
                onChange={(value) =>
                  setAttributes({ marginRight: Number(value) })
                }
                type="number"
              />
              <TextControl
                label={__("下", "text-domain")}
                value={marginBottom}
                onChange={(value) =>
                  setAttributes({ marginBottom: Number(value) })
                }
                type="number"
              />
            </div>
          </PanelBody>
          <PanelBody
            title={
              <>
                <img
                  src={myThemeData.themeUrl + "/assets/icon.png"}
                  alt="ZEN"
                  style={{ width: "18px", height: "18px", marginRight: "5px" }}
                />
                {__("パディング設定 (px)", "text-domain")}
              </>
            }
          >
            <div style={{ display: "flex", gap: "10px" }}>
              <TextControl
                label={__("左", "text-domain")}
                value={paddingLeft}
                onChange={(value) =>
                  setAttributes({ paddingLeft: Number(value) })
                }
                type="number"
              />
              <TextControl
                label={__("上", "text-domain")}
                value={paddingTop}
                onChange={(value) =>
                  setAttributes({ paddingTop: Number(value) })
                }
                type="number"
              />
              <TextControl
                label={__("右", "text-domain")}
                value={paddingRight}
                onChange={(value) =>
                  setAttributes({ paddingRight: Number(value) })
                }
                type="number"
              />
              <TextControl
                label={__("下", "text-domain")}
                value={paddingBottom}
                onChange={(value) =>
                  setAttributes({ paddingBottom: Number(value) })
                }
                type="number"
              />
            </div>
          </PanelBody>
        </InspectorControls>
      </div>
    );
  };
}, "withMarginPaddingControl");

wp.hooks.addFilter(
  "editor.BlockEdit",
  "my-plugin/with-margin-padding-control",
  withMarginPaddingControl
);
const applyMarginPaddingStyles = (extraProps, blockType, attributes) => {
  const {
    marginTop,
    marginBottom,
    marginLeft,
    marginRight,
    paddingTop,
    paddingBottom,
    paddingLeft,
    paddingRight,
  } = attributes;

  const blockStyle = {
    marginTop: `${marginTop || 0}px`,
    marginBottom: `${marginBottom || 0}px`,
    marginLeft: `${marginLeft || 0}px`,
    marginRight: `${marginRight || 0}px`,
    paddingTop: `${paddingTop || 0}px`,
    paddingBottom: `${paddingBottom || 0}px`,
    paddingLeft: `${paddingLeft || 0}px`,
    paddingRight: `${paddingRight || 0}px`,
  };

  extraProps.style = Object.assign({}, extraProps.style, blockStyle);
  return extraProps;
};

wp.hooks.addFilter(
  "blocks.getSaveContent.extraProps",
  "my-plugin/apply-margin-padding-styles",
  applyMarginPaddingStyles
);
