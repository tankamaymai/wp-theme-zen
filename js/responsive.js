(function (wp) {
    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var PanelBody = wp.components.PanelBody;
    var SelectControl = wp.components.SelectControl;
    var useSelect = wp.data.useSelect;
    var useDispatch = wp.data.useDispatch;
    var subscribe = wp.data.subscribe;

    // ブロックの属性を拡張
function addResponsiveAttributes(settings, name) {
    if (typeof settings.attributes !== 'undefined') {
        settings.attributes = Object.assign(settings.attributes, {
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
        });
    }
    return settings;
}

wp.hooks.addFilter(
    'blocks.registerBlockType',
    'my-plugin/add-responsive-attributes',
    addResponsiveAttributes
);


    var responsiveControls = wp.compose.createHigherOrderComponent(function (BlockEdit) {
        return function (props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            // クラス名を更新する関数
        const updateClassName = (newAttributes) => {
            let newClassName = className ? className.split(' ') : [];
            
            ['Desktop', 'Tablet', 'Mobile'].forEach(device => {
                const hideClass = `hide-on-${device.toLowerCase()}`;
                if (newAttributes[`displayOn${device}`] === 'hide') {
                    if (!newClassName.includes(hideClass)) {
                        newClassName.push(hideClass);
                    }
                } else {
                    newClassName = newClassName.filter(c => c !== hideClass);
                }
            });

            props.setAttributes({ className: newClassName.join(' ') });
        };

        // 表示設定が変更されたときの処理
        const onChangeDisplay = (device, newValue) => {
            const newAttributes = { ...attributes, [`displayOn${device}`]: newValue };
            setAttributes(newAttributes);
            updateClassName(newAttributes);
        };

            var deviceType = useSelect(function (select) {
                const { __experimentalGetPreviewDeviceType } = select('core/edit-post');
                return __experimentalGetPreviewDeviceType ? __experimentalGetPreviewDeviceType() : 'Desktop';
            }, []);

            var { __experimentalSetPreviewDeviceType: setPreviewDeviceType } = useDispatch('core/edit-post');

            wp.element.useEffect(function () {
                var unsubscribe = subscribe(function () {
                    var newDeviceType = wp.data.select('core/edit-post').__experimentalGetPreviewDeviceType();
                    if (newDeviceType && newDeviceType !== deviceType) {
                        setPreviewDeviceType(newDeviceType);
                    }
                });

                return function () {
                    unsubscribe();
                };
            }, [deviceType]);

            var responsiveStyles = {
                opacity: 1,
            };

            if (
                (deviceType === 'Desktop' && attributes.displayOnDesktop === 'hide') ||
                (deviceType === 'Tablet' && attributes.displayOnTablet === 'hide') ||
                (deviceType === 'Mobile' && attributes.displayOnMobile === 'hide')
            ) {
                responsiveStyles.opacity = 0.3;
            }

            var responsiveSettings = el(
                PanelBody,
                { title: 'レスポンシブ設定', initialOpen: false },
                el(SelectControl, {
                    label: 'デスクトップで表示',
                    value: attributes.displayOnDesktop || 'show',
                    options: [
                        { label: '表示', value: 'show' },
                        { label: '非表示', value: 'hide' },
                    ],
                    onChange: function (newVisibility) {
                        setAttributes({ displayOnDesktop: newVisibility });
                    },
                }),
                el(SelectControl, {
                    label: 'タブレットで表示',
                    value: attributes.displayOnTablet || 'show',
                    options: [
                        { label: '表示', value: 'show' },
                        { label: '非表示', value: 'hide' },
                    ],
                    onChange: function (newVisibility) {
                        setAttributes({ displayOnTablet: newVisibility });
                    },
                }),
                el(SelectControl, {
                    label: 'モバイルで表示',
                    value: attributes.displayOnMobile || 'show',
                    options: [
                        { label: '表示', value: 'show' },
                        { label: '非表示', value: 'hide' },
                    ],
                    onChange: function (newVisibility) {
                        setAttributes({ displayOnMobile: newVisibility });
                    },
                })
            );

            return el(
                Fragment,
                {},
                el(
                    'div',
                    { style: responsiveStyles },
                    el(BlockEdit, props)
                ),
                el(
                    InspectorControls,
                    {},
                    responsiveSettings
                )
            );
        };
    }, 'responsiveControls');

    wp.hooks.addFilter('editor.BlockEdit', 'my-plugin/add-responsive-controls', responsiveControls);

    var applyResponsiveClasses = function (extraProps, blockType, attributes) {
        var responsiveClasses = [
            attributes.displayOnDesktop === 'hide' ? 'hide-on-desktop' : '',
            attributes.displayOnTablet === 'hide' ? 'hide-on-tablet' : '',
            attributes.displayOnMobile === 'hide' ? 'hide-on-mobile' : '',
        ].filter(Boolean).join(' ');

        if (responsiveClasses) {
            extraProps.className = extraProps.className
                ? extraProps.className + ' ' + responsiveClasses
                : responsiveClasses;
        }

        return extraProps;
    };

    wp.hooks.addFilter('blocks.getSaveContent.extraProps', 'my-plugin/apply-responsive-classes', applyResponsiveClasses);

})(window.wp);