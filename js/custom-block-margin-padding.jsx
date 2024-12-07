import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody,TextControl,__experimentalBoxControl as BoxControl  } from '@wordpress/components';
import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';
import { useState } from '@wordpress/element';

// スタイルを適用するための関数
const getSpacingStyle = (spacing) => {
    if (!spacing) return {};
    const style = {};
    const unit = spacing.unit || 'px';

    if (spacing.margin) {
        style.marginTop = `${spacing.margin.top || 0}${unit}`;
        style.marginBottom = `${spacing.margin.bottom || 0}${unit}`;
        style.marginLeft = `${spacing.margin.left || 0}${unit}`;
        style.marginRight = `${spacing.margin.right || 0}${unit}`;
    }

    if (spacing.padding) {
        style.paddingTop = `${spacing.padding.top || 0}${unit}`;
        style.paddingBottom = `${spacing.padding.bottom || 0}${unit}`;
        style.paddingLeft = `${spacing.padding.left || 0}${unit}`;
        style.paddingRight = `${spacing.padding.right || 0}${unit}`;
    }

    return style;
};

const SpacingControl = ({ BlockEdit, ...props }) => {
    const { attributes, setAttributes } = props;
    const { style } = attributes;
    const onChangeSpacing = (newSpacing, type) => {
        const updatedObj = {
            top: /^\d+$/.test(newSpacing.top) ? newSpacing.top + 'px' : newSpacing.top,
            bottom: /^\d+$/.test(newSpacing.bottom) ? newSpacing.bottom + 'px' : newSpacing.bottom,
            left: /^\d+$/.test(newSpacing.left) ? newSpacing.left + 'px' : newSpacing.left,
            right: /^\d+$/.test(newSpacing.right) ? newSpacing.right + 'px' : newSpacing.right,
        };
        setAttributes({
            style: {
                ...style,
                spacing: {
                    ...style?.spacing,
                    [type]: {
                        ...style?.spacing?.[type],
                        ...updatedObj,
                    },
                    unit: newSpacing.unit || style?.spacing?.unit || 'px',
                },
            },
        });
    };

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
                            {__('余白設定', 'your-textdomain')}
                        </>
                    }
                    initialOpen={false}
                >
                    <BoxControl
                        label={__('マージン', 'your-textdomain')}
                        values={style?.spacing?.margin || { top: 0, bottom: 0, left: 0, right: 0, unit: 'px' }}
                        onChange={(newMargin) => onChangeSpacing(newMargin, 'margin')}
                        units={[
                            { value: 'px', label: 'px' },
                            { value: 'em', label: 'em' },
                            { value: 'rem', label: 'rem' },
                            { value: '%', label: '%' },
                        ]}
                    />


                    <BoxControl
                        label={__('パディング', 'your-textdomain')}
                        values={style?.spacing?.padding || { top: 0, bottom: 0, left: 0, right: 0, unit: 'px' }}
                        onChange={(newPadding) => {
                            onChangeSpacing(newPadding, 'padding')
                        }}
                        
                        __nextHasNoMarginBottom
                        units={[
                            { value: 'px', label: 'px' },
                            { value: 'em', label: 'em' },
                            { value: 'rem', label: 'rem' },
                            { value: '%', label: '%' }
                        ]}
                    />
                </PanelBody>
            </InspectorControls>
        </>
    );
};

const withSpacingControl = createHigherOrderComponent(
    (BlockEdit) => (props) => (
        <SpacingControl BlockEdit={BlockEdit} {...props} />
    ),
    'withSpacingControl'
);

const addSpacingStyles = createHigherOrderComponent(
    (BlockListBlock) => (props) => {
        const { attributes } = props;
        const spacingStyle = getSpacingStyle(attributes?.style?.spacing);
        return <BlockListBlock {...props} style={{ ...props.style, ...spacingStyle }} />;
    },
    'addSpacingStyles'
);
// myThemeDataの存在チェックを追加
const themeUrl = typeof myThemeData !== 'undefined' ? myThemeData.themeUrl : '';
// フィルターの名前空間を変更
addFilter(
    'editor.BlockEdit',
    'zen-theme/with-spacing-control',  // 変更
    withSpacingControl
);

addFilter(
    'editor.BlockListBlock',
    'zen-theme/add-spacing-styles',  // 変更
    addSpacingStyles
);

export { getSpacingStyle, SpacingControl, withSpacingControl, addSpacingStyles };