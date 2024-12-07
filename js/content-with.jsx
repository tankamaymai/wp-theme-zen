import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';

// ブロックの属性を拡張
function addContentWidthAttribute(settings) {
    if (typeof settings.attributes !== 'undefined') {
        settings.attributes = {
            ...settings.attributes,
            contentWidth: {
                type: 'string',
                default: ''
            }
        };
    }
    return settings;
}

const ContentWidthControl = ({ BlockEdit, ...props }) => {
    const { attributes, setAttributes } = props;

    return (
        <>
            <BlockEdit {...props} />
            <InspectorControls>
                <PanelBody
                    title={
                        <>
                            <img
                                src={`${myThemeData.themeUrl}/assets/icon.png`}
                                alt="ZEN"
                                style={{ width: '18px', height: '18px', marginRight: '5px' }}
                            />
                            {__("コンテンツの幅", "text-domain")}
                        </>
                    }
                    initialOpen={false}
                >
                    <SelectControl
                        label={__("コンテンツの幅を選択", "text-domain")}
                        value={attributes.contentWidth || '1100px'}
                        options={[
                            { label: '800px', value: '800px' },
                            { label: '1100px', value: '1100px' },
                            { label: '1400px', value: '1400px' },
                            { label: '100%', value: '100%' },
                        ]}
                        onChange={(newWidth) => setAttributes({ contentWidth: newWidth })}
                        __nextHasNoMarginBottom={true}
                            />
                        </PanelBody>
            </InspectorControls>
        </>
    );
};

const withContentWidthControl = createHigherOrderComponent(
    (BlockEdit) => (props) => (
        <ContentWidthControl BlockEdit={BlockEdit} {...props} />
    ),
    'withContentWidthControl'
);

const applyContentWidthStyle = (extraProps, blockType, attributes) => {
    if (attributes.contentWidth) {
        if (attributes.contentWidth === '100%') {
            const hasSidebar = window.mythemeHasSidebar !== undefined ? 
                window.mythemeHasSidebar : true;
            
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
                width: '100%',
            };
        }
    }
    return extraProps;
};

addFilter(
    'blocks.registerBlockType',
    'my-plugin/content-width-attribute',
    addContentWidthAttribute
);

addFilter(
    'editor.BlockEdit',
    'my-plugin/with-content-width-control',
    withContentWidthControl
);

addFilter(
    'blocks.getSaveContent.extraProps',
    'my-plugin/apply-content-width-style',
    applyContentWidthStyle
);

export {
    addContentWidthAttribute,
    ContentWidthControl,
    withContentWidthControl,
    applyContentWidthStyle
};