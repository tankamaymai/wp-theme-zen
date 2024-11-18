import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, __experimentalBoxControl as BoxControl } from '@wordpress/components';
import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';

// スタイルを適用するための関数
const getSpacingStyle = (spacing) => {
    if (!spacing) return {};
    const style = {};

    // マージンにユーザーが選択した単位を適用
    if (spacing.margin) {
        style.marginTop = `${spacing.margin.top}${spacing.margin.unit}`;
        style.marginBottom = `${spacing.margin.bottom}${spacing.margin.unit}`;
        style.marginLeft = `${spacing.margin.left}${spacing.margin.unit}`;
        style.marginRight = `${spacing.margin.right}${spacing.margin.unit}`;
    }

    // パディングにユーザーが選択した単位を適用
    if (spacing.padding) {
        style.paddingTop = `${spacing.padding.top}${spacing.padding.unit}`;
        style.paddingBottom = `${spacing.padding.bottom}${spacing.padding.unit}`;
        style.paddingLeft = `${spacing.padding.left}${spacing.padding.unit}`;
        style.paddingRight = `${spacing.padding.right}${spacing.padding.unit}`;
    }

    return style;
};

const SpacingControl = ({ BlockEdit, ...props }) => {
    const { attributes, setAttributes } = props;
    const { style } = attributes;

    const onChangeSpacing = (newSpacing, type) => {
        setAttributes({
            style: {
                ...style,
                spacing: {
                    ...style?.spacing,
                    [type]: newSpacing
                }
            }
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
                        values={style?.spacing?.margin || {}}
                        onChange={(newMargin) => onChangeSpacing(newMargin, 'margin')}
                        __nextHasNoMarginBottom
                        units={[
                            { value: 'px', label: 'px' },
                            { value: 'em', label: 'em' },
                            { value: 'rem', label: 'rem' },
                            { value: '%', label: '%' }
                        ]}
                    />
                    <BoxControl
                        label={__('パディング', 'your-textdomain')}
                        values={style?.spacing?.padding || {}}
                        onChange={(newPadding) => onChangeSpacing(newPadding, 'padding')}
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