const { __ } = wp.i18n;
const { useSelect, useDispatch } = wp.data;
const { useEffect } = wp.element;
const { InspectorControls, useBlockProps } = wp.blockEditor;
const { PanelBody, SelectControl } = wp.components;
const { addFilter } = wp.hooks;
const { createHigherOrderComponent } = wp.compose;

// ブロックの属性を拡張
function addResponsiveAttributes(settings) {
    if (typeof settings.attributes !== 'undefined') {
        settings.attributes = {
            ...settings.attributes,
            displayOnDesktop: {
                type: 'string',
                default: 'show'
            },
            displayOnTablet: {
                type: 'string',
                default: 'show'
            },
            displayOnMobile: {
                type: 'string',
                default: 'show'
            }
        };
    }
    return settings;
}

addFilter(
    'blocks.registerBlockType',
    'my-plugin/add-responsive-attributes',
    addResponsiveAttributes
);

const ResponsiveControls = ({ BlockEdit, ...props }) => {
    const { attributes, setAttributes } = props;

    // クラス名を更新する関数
    const updateClassName = (newAttributes) => {
        const blockProps = useBlockProps.save();
        let classes = blockProps.className ? blockProps.className.split(' ') : [];

        ['Desktop', 'Tablet', 'Mobile'].forEach(device => {
            const hideClass = `hide-on-${device.toLowerCase()}`;
            if (newAttributes[`displayOn${device}`] === 'hide') {
                if (!classes.includes(hideClass)) {
                    classes.push(hideClass);
                }
            } else {
                classes = classes.filter(c => c !== hideClass);
            }
        });

        setAttributes({ className: classes.join(' ') });
    };

    // デバイスタイプの取得
    const deviceType = useSelect(select => {
        const { __experimentalGetPreviewDeviceType } = select('core/edit-post');
        return __experimentalGetPreviewDeviceType ? 
            __experimentalGetPreviewDeviceType() : 'Desktop';
    }, []);

    const { __experimentalSetPreviewDeviceType: setPreviewDeviceType } = useDispatch('core/edit-post');

    // デバイスタイプの変更を監視
    useEffect(() => {
        const unsubscribe = wp.data.subscribe(() => {
            const newDeviceType = wp.data.select('core/edit-post').__experimentalGetPreviewDeviceType();
            if (newDeviceType && newDeviceType !== deviceType) {
                setPreviewDeviceType(newDeviceType);
            }
        });

        return () => unsubscribe();
    }, [deviceType, setPreviewDeviceType]);

    // 表示設定が変更されたときの処理
    const onChangeDisplay = (device, value) => {
        const newAttributes = { ...attributes, [`displayOn${device}`]: value };
        setAttributes(newAttributes);
        updateClassName(newAttributes);
    };

    // 現在のデバイスタイプに応じたスタイル
    const responsiveStyles = {
        opacity: (
            (deviceType === 'Desktop' && attributes.displayOnDesktop === 'hide') ||
            (deviceType === 'Tablet' && attributes.displayOnTablet === 'hide') ||
            (deviceType === 'Mobile' && attributes.displayOnMobile === 'hide')
        ) ? 0.3 : 1
    };

    return (
        <>
            <div style={responsiveStyles}>
                <BlockEdit {...props} />
            </div>
            
            <InspectorControls>
                <PanelBody
                    title={
                        <>
                            <img
                                src={`${myThemeData.themeUrl}/assets/icon.png`}
                                alt="ZEN"
                                style={{ width: '18px', height: '18px', marginRight: '5px' }}
                            />
                            {__('レスポンシブ設定', 'your-textdomain')}
                        </>
                    }
                    initialOpen={false}
                >
                    {['Desktop', 'Tablet', 'Mobile'].map(device => (
                        <SelectControl
                            key={device}
                            label={`${device}で表示`}
                            value={attributes[`displayOn${device}`] || 'show'}
                            options={[
                                { label: '表示', value: 'show' },
                                { label: '非表示', value: 'hide' }
                            ]}
                            onChange={(value) => onChangeDisplay(device, value)}
                            __nextHasNoMarginBottom={true}
                        />
                    ))}
                </PanelBody>
            </InspectorControls>
        </>
    );
};

const withResponsiveControls = createHigherOrderComponent(
    (BlockEdit) => (props) => (
        <ResponsiveControls BlockEdit={BlockEdit} {...props} />
    ),
    'withResponsiveControls'
);

addFilter(
    'editor.BlockEdit',
    'my-plugin/add-responsive-controls',
    withResponsiveControls
);

// フロントエンド用のクラス適用
const applyResponsiveClasses = (extraProps, blockType, attributes) => {
    const responsiveClasses = [
        attributes.displayOnDesktop === 'hide' ? 'hide-on-desktop' : '',
        attributes.displayOnTablet === 'hide' ? 'hide-on-tablet' : '',
        attributes.displayOnMobile === 'hide' ? 'hide-on-mobile' : '',
    ].filter(Boolean).join(' ');

    if (responsiveClasses) {
        extraProps.className = extraProps.className
            ? `${extraProps.className} ${responsiveClasses}`
            : responsiveClasses;
    }

    return extraProps;
};

addFilter(
    'blocks.getSaveContent.extraProps',
    'my-plugin/apply-responsive-classes',
    applyResponsiveClasses
);

// エクスポートを追加
export {
    addResponsiveAttributes,
    ResponsiveControls,
    withResponsiveControls,
    applyResponsiveClasses
  };