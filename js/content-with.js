const { __ } = wp.i18n;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, SelectControl } = wp.components;
const { createHigherOrderComponent } = wp.compose;

// ブロックの属性を拡張
function addContentWidthAttribute(settings, name) {
    if (typeof settings.attributes !== 'undefined') {
        settings.attributes = Object.assign(settings.attributes, {
            contentWidth: {
                type: 'string',
                default: '1100px'
            }
        });
    }
    return settings;
}

wp.hooks.addFilter(
    'blocks.registerBlockType',
    'my-plugin/content-width-attribute',
    addContentWidthAttribute
);

const withContentWidthControl = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        const { attributes, setAttributes } = props;

        return wp.element.createElement(
            wp.element.Fragment,
            null,
            wp.element.createElement(BlockEdit, props),
            wp.element.createElement(
                InspectorControls,
                null,
                wp.element.createElement(
                    PanelBody,
                    { title: __("コンテンツの幅", "text-domain"), initialOpen: false },
                    wp.element.createElement(SelectControl, {
                        label: __("コンテンツの幅を選択", "text-domain"),
                        value: attributes.contentWidth || '1100px',
                        options: [
                            { label: '800px', value: '800px' },
                            { label: '1100px', value: '1100px' },
                            { label: '1400px', value: '1400px' },
                            { label: '100%', value: '100%' },
                        ],
                        onChange: (newWidth) => setAttributes({ contentWidth: newWidth })
                    })
                )
            )
        );
    };
}, 'withContentWidthControl');

wp.hooks.addFilter(
    'editor.BlockEdit',
    'my-plugin/with-content-width-control',
    withContentWidthControl
);

// フロントエンド用のスタイル適用
const applyContentWidthStyle = (extraProps, blockType, attributes) => {
    if (attributes.contentWidth) {
        if (attributes.contentWidth === '100%') {
            // サイドバーの有無を確認
            const hasSidebar = window.mythemeHasSidebar !== undefined ? window.mythemeHasSidebar : true;
            
            if (hasSidebar) {
                extraProps.style = { 
                    ...extraProps.style,
                    width: '100%',
                    boxSizing: 'border-box'
                };
            } else {
                extraProps.style = { 
                    ...extraProps.style,
                    width: '100vw',
                    marginLeft: 'calc(50% - 50vw)',
                    marginRight: 'calc(50% - 50vw)',
                    paddingLeft: 'calc(50vw - 50%)',
                    paddingRight: 'calc(50vw - 50%)',
                    boxSizing: 'border-box'
                };
            }
        } else {
            extraProps.style = { 
                ...extraProps.style, 
                maxWidth: attributes.contentWidth, 
                margin: '0 auto' 
            };
        }
    }
    return extraProps;
};

wp.hooks.addFilter(
    'blocks.getSaveContent.extraProps',
    'my-plugin/apply-content-width-style',
    applyContentWidthStyle
);