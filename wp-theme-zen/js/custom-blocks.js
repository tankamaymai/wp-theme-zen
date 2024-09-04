(function (wp) {
  const { registerBlockType } = wp.blocks;
  const { InspectorControls } = wp.blockEditor;
  const { TextControl, PanelBody } = wp.components;
  const { addFilter } = wp.hooks;
  const { createElement } = wp.element;

  // カスタム属性を追加するフィルター
  addFilter(
    "blocks.registerBlockType",
    "mytheme/custom-attributes",
    function (settings, name) {
      if (name !== "core/paragraph") {
        return settings;
      }
      return _.assign({}, settings, {
        attributes: _.assign({}, settings.attributes, {
          customAttribute: {
            type: "string",
            default: "Hello, World!",
          },
        }),
      });
    }
  );

  // エディターにカスタム属性のコントロールを追加するフィルター
  addFilter(
    "editor.BlockEdit",
    "mytheme/add-custom-attribute-controls",
    wp.compose.createHigherOrderComponent(function (BlockEdit) {
      return function (props) {
        if (props.name !== "core/paragraph") {
          return createElement(BlockEdit, props);
        }
        const { attributes, setAttributes } = props;
        const { customAttribute } = attributes;

        return createElement(
          wp.element.Fragment,
          {},
          createElement(BlockEdit, props),
          createElement(
            InspectorControls,
            null,
            createElement(
              PanelBody,
              { title: "カスタム属性", initialOpen: true },
              createElement(TextControl, {
                label: "Custom Attribute:",
                value: customAttribute,
                onChange: (value) => setAttributes({ customAttribute: value }),
              })
            )
          )
        );
      };
    }, "withCustomAttributeControl")
  );
})(window.wp);
