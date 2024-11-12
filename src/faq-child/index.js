import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { useBlockProps, InnerBlocks, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl, RangeControl, ColorPalette } from '@wordpress/components';

if (!wp.blocks.getBlockType('mytheme/faq-child')) {
    registerBlockType('mytheme/faq-child', {
        title: __('FAQ子ブロック', 'mytheme'),
        description: __('FAQのアンサーブロックです', 'mytheme'),
        category: 'zen',
        icon: 'editor-help',
        supports: {
            html: false,
        },
        attributes: {
            question: {
                type: 'string',
                source: 'html',
                selector: '.faq-question'
            },
            style: {
                type: 'string',
                default: 'simple'
            },
            dividerStyle: {
                type: 'string',
                default: 'solid'
            },
            dividerColor: {
                type: 'string',
                default: '#cccccc'
            },
            dividerWidth: {
                type: 'number',
                default: 1
            },
            boxColor: {
                type: 'string',
                default: '#ffffff'
            },
            boxBorderWidth: {
                type: 'number',
                default: 1
            },
            boxBorderColor: {
                type: 'string',
                default: '#000000'
            },
            boxBorderRadius: {
                type: 'number',
                default: 5
            },
            iconStyle: {
                type: 'string',
                default: 'square'
            },
            iconSize: {
                type: 'number',
                default: 25
            },
            iconBorderWidth: {
                type: 'number',
                default: 1
            },
            iconFontSize: {
                type: 'number',
                default: 16
            },
            iconColor: {
                type: 'string',
                default: '#000000'
            },
            iconBackgroundColor: {
                type: 'string',
                default: '#ffffff'
            },
            iconBorderRadius: {
                type: 'number',
                default: 5
            },
            iconBorderColor: {
                type: 'string',
                default: '#000000'
            },
            questionBackgroundColor: {
                type: 'string',
                default: '#ffffff'
            },
            questionTextColor: {
                type: 'string',
                default: '#000000'
            },
            answerBackgroundColor: {
                type: 'string',
                default: '#ffffff'
            },
            answerTextColor: {
                type: 'string',
                default: '#000000'
            }
        },
        edit: ({ attributes, setAttributes }) => {
            const blockProps = useBlockProps();
            const { style } = attributes;
            return (
                <>
                    <InspectorControls>
                        <PanelBody title={__('スタイル設定', 'mytheme')}>
                            <SelectControl
                                label={__('スタイル', 'mytheme')}
                                value={style}
                                options={[
                                    { label: __('シンプル', 'mytheme'), value: 'simple' },
                                    { label: __('区切り線', 'mytheme'), value: 'divider' },
                                    { label: __('ボックス', 'mytheme'), value: 'box' },
                                ]}
                                onChange={(value) => setAttributes({ style: value })}
                            />
                            {style === 'divider' && (
                                <>
                                    <SelectControl
                                        label={__('区切り線のスタイル', 'mytheme')}
                                        value={attributes.dividerStyle}
                                        options={[
                                            { label: __('実線', 'mytheme'), value: 'solid' },
                                            { label: __('点線', 'mytheme'), value: 'dotted' },
                                            { label: __('破線', 'mytheme'), value: 'dashed' },
                                        ]}
                                        onChange={(value) => setAttributes({ dividerStyle: value })}
                                    />
                                    <div className="components-base-control">
                                        <span>{__('区切り線の色', 'mytheme')}</span>
                                        <ColorPalette
                                            value={attributes.dividerColor}
                                            onChange={(value) => setAttributes({ dividerColor: value })}
                                        />
                                    </div>
                                    <RangeControl
                                        label={__('区切り線の太さ', 'mytheme')}
                                        value={attributes.dividerWidth}
                                        onChange={(value) => setAttributes({ dividerWidth: value })}
                                        min={1}
                                        max={10}
                                    />
                                </>
                            )}
                            {style === 'box' && (
                                <>
                                    <div className="components-base-control">
                                        <span>{__('ボックスの色', 'mytheme')}</span>
                                        <ColorPalette
                                            value={attributes.boxColor}
                                            onChange={(value) => setAttributes({ boxColor: value })}
                                        />
                                    </div>
                                    <RangeControl
                                        label={__('ボックスの枠線の太さ', 'mytheme')}
                                        value={attributes.boxBorderWidth}
                                        onChange={(value) => setAttributes({ boxBorderWidth: value })}
                                        min={0}
                                        max={10}
                                    />
                                    <div className="components-base-control">
                                        <span>{__('ボックスの枠線の色', 'mytheme')}</span>
                                        <ColorPalette
                                            value={attributes.boxBorderColor}
                                            onChange={(value) => setAttributes({ boxBorderColor: value })}
                                        />
                                    </div>
                                    <RangeControl
                                        label={__('ボックスの角の丸み', 'mytheme')}
                                        value={attributes.boxBorderRadius}
                                        onChange={(value) => setAttributes({ boxBorderRadius: value })}
                                        min={0}
                                        max={50}
                                    />
                                </>
                            )}
                        </PanelBody>
                        <PanelBody title={__('アイコン設定', 'mytheme')}>
                            <SelectControl
                                label={__('アイコンスタイル', 'mytheme')}
                                value={attributes.iconStyle}
                                options={[
                                    { label: __('四角', 'mytheme'), value: 'square' },
                                    { label: __('丸', 'mytheme'), value: 'circle' },
                                    { label: __('角丸', 'mytheme'), value: 'rounded' }
                                ]}
                                onChange={(value) => setAttributes({ iconStyle: value })}
                            />
                            {attributes.iconStyle === 'rounded' && (
                                <RangeControl
                                    label={__('アイコンの角の丸み', 'mytheme')}
                                    value={attributes.iconBorderRadius}
                                    onChange={(value) => setAttributes({ iconBorderRadius: value })}
                                    min={0}
                                    max={20}
                                />
                            )}
                            <RangeControl
                                label={__('アイコンサイズ', 'mytheme')}
                                value={attributes.iconSize}
                                onChange={(value) => setAttributes({ iconSize: value })}
                                min={20}
                                max={50}
                            />
                            <RangeControl
                                label={__('アイコン枠線の太さ', 'mytheme')}
                                value={attributes.iconBorderWidth}
                                onChange={(value) => setAttributes({ iconBorderWidth: value })}
                                min={0}
                                max={5}
                            />
                            <RangeControl
                                label={__('アイコンの文字サイズ', 'mytheme')}
                                value={attributes.iconFontSize}
                                onChange={(value) => setAttributes({ iconFontSize: value })}
                                min={12}
                                max={30}
                            />
                            <div className="components-base-control">
                                <span>{__('アイコンの色', 'mytheme')}</span>
                                <ColorPalette
                                    value={attributes.iconColor}
                                    onChange={(value) => setAttributes({ iconColor: value })}
                                />
                            </div>
                            <div className="components-base-control">
                                <span>{__('アイコンの背景色', 'mytheme')}</span>
                                <ColorPalette
                                    value={attributes.iconBackgroundColor}
                                    onChange={(value) => setAttributes({ iconBackgroundColor: value })}
                                />
                            </div>
                            <div className="components-base-control">
                                <span>{__('アイコンの枠線の色', 'mytheme')}</span>
                                <ColorPalette
                                    value={attributes.iconBorderColor}
                                    onChange={(value) => setAttributes({ iconBorderColor: value })}
                                />
                            </div>
                        </PanelBody>
                        <PanelBody title={__('質問設定', 'mytheme')}>
                            <div className="components-base-control">
                                <span>{__('背景色', 'mytheme')}</span>
                                <ColorPalette
                                    value={attributes.questionBackgroundColor}
                                    onChange={(value) => setAttributes({ questionBackgroundColor: value })}
                                />
                            </div>
                            <div className="components-base-control">
                                <span>{__('文字色', 'mytheme')}</span>
                                <ColorPalette
                                    value={attributes.questionTextColor}
                                    onChange={(value) => setAttributes({ questionTextColor: value })}
                                />
                            </div>
                        </PanelBody>
                        <PanelBody title={__('回答設定', 'mytheme')}>
                            <div className="components-base-control">
                                <span>{__('背景色', 'mytheme')}</span>
                                <ColorPalette
                                    value={attributes.answerBackgroundColor}
                                    onChange={(value) => setAttributes({ answerBackgroundColor: value })}
                                />
                            </div>
                            <div className="components-base-control">
                                <span>{__('文字色', 'mytheme')}</span>
                                <ColorPalette
                                    value={attributes.answerTextColor}
                                    onChange={(value) => setAttributes({ answerTextColor: value })}
                                />
                            </div>
                        </PanelBody>
                    </InspectorControls>
                    <div
                        {...blockProps}
                        className={`faq-child-block style-${style}`}
                        style={
                            style === 'divider'
                                ? {
                                    borderBottom: `${attributes.dividerWidth}px ${attributes.dividerStyle} ${attributes.dividerColor}`
                                }
                                : style === 'box'
                                    ? {
                                        backgroundColor: attributes.boxColor,
                                        border: `${attributes.boxBorderWidth}px solid ${attributes.boxBorderColor}`,
                                        borderRadius: `${attributes.boxBorderRadius}px`,
                                        marginBottom: '10px'
                                    }
                                    : undefined
                        }
                    >
                        <div className="faq-question-wrapper"
                            style={{
                                backgroundColor: attributes.questionBackgroundColor,
                                color: attributes.questionTextColor
                            }}
                        >
                            <span
                                className={`faq-icon ${attributes.iconStyle === 'circle' ? 'faq-icon-circle' : attributes.iconStyle === 'rounded' ? 'faq-icon-rounded' : ''}`}
                                style={{
                                    width: attributes.iconSize + 'px',
                                    height: attributes.iconSize + 'px',
                                    borderWidth: attributes.iconBorderWidth + 'px',
                                    fontSize: attributes.iconFontSize + 'px',
                                    color: attributes.iconColor,
                                    backgroundColor: attributes.iconBackgroundColor,
                                    borderColor: attributes.iconBorderColor,
                                    borderRadius: attributes.iconStyle === 'rounded' ? `${attributes.iconBorderRadius}px` : undefined
                                }}
                            >
                                Q
                            </span>
                            <RichText
                                tagName="h4"
                                className="faq-question"
                                value={attributes.question}
                                onChange={(value) => setAttributes({ question: value })}
                                placeholder={__('質問を入力...', 'mytheme')}
                                style={{
                                    color: attributes.questionTextColor
                                }}
                            />
                        </div>
                        <div className="faq-answer-wrapper"
                            style={{
                                backgroundColor: attributes.answerBackgroundColor,
                                color: attributes.answerTextColor
                            }}
                        >
                            <span
                                className={`faq-icon ${attributes.iconStyle === 'circle' ? 'faq-icon-circle' : attributes.iconStyle === 'rounded' ? 'faq-icon-rounded' : ''}`}
                                style={{
                                    width: attributes.iconSize + 'px',
                                    height: attributes.iconSize + 'px',
                                    borderWidth: attributes.iconBorderWidth + 'px',
                                    fontSize: attributes.iconFontSize + 'px',
                                    color: attributes.iconColor,
                                    backgroundColor: attributes.iconBackgroundColor,
                                    borderColor: attributes.iconBorderColor,
                                    borderRadius: attributes.iconStyle === 'rounded' ? `${attributes.iconBorderRadius}px` : undefined
                                }}
                            >
                                A
                            </span>
                            <div className="faq-answer">
                                <InnerBlocks
                                    template={[
                                        ['core/paragraph', {
                                            placeholder: __('回答を入力...', 'mytheme')
                                        }]
                                    ]}
                                    templateLock={false}
                                />
                            </div>
                        </div>
                    </div>
                </>
            );
        },
        save: ({ attributes }) => {
            const blockProps = useBlockProps.save();
            const { style } = attributes;
            return (
                <div
                    {...blockProps}
                    className={`faq-block style-${style}`}
                    style={
                        style === 'divider'
                            ? {
                                borderBottom: `${attributes.dividerWidth}px ${attributes.dividerStyle} ${attributes.dividerColor}`
                            }
                            : style === 'box'
                                ? {
                                    backgroundColor: attributes.boxColor,
                                    border: `${attributes.boxBorderWidth}px solid ${attributes.boxBorderColor}`,
                                    borderRadius: `${attributes.boxBorderRadius}px`,
                                    marginBottom: '10px'
                                }
                                : undefined
                    }
                >
                    <div className="faq-question-wrapper"
                        style={{
                            backgroundColor: attributes.questionBackgroundColor,
                        }}
                    >
                        <span
                            className={`faq-icon ${attributes.iconStyle === 'circle' ? 'faq-icon-circle' : attributes.iconStyle === 'rounded' ? 'faq-icon-rounded' : ''}`}
                            style={{
                                width: attributes.iconSize + 'px',
                                height: attributes.iconSize + 'px',
                                borderWidth: attributes.iconBorderWidth + 'px',
                                fontSize: attributes.iconFontSize + 'px',
                                color: attributes.iconColor,
                                backgroundColor: attributes.iconBackgroundColor,
                                borderColor: attributes.iconBorderColor,
                                borderRadius: attributes.iconStyle === 'rounded' ? `${attributes.iconBorderRadius}px` : undefined
                            }}
                        >
                            Q
                        </span>
                        <RichText.Content
                            tagName="h4"
                            className="faq-question"
                            value={attributes.question}
                            style={{
                                color: attributes.questionTextColor
                            }}
                        />
                    </div>
                    <div className="faq-answer-wrapper"
    style={{
        backgroundColor: attributes.answerBackgroundColor,
        color: attributes.answerTextColor
    }}
>
                        <span
                            className={`faq-icon ${attributes.iconStyle === 'circle' ? 'faq-icon-circle' : attributes.iconStyle === 'rounded' ? 'faq-icon-rounded' : ''}`}
                            style={{
                                width: attributes.iconSize + 'px',
                                height: attributes.iconSize + 'px',
                                borderWidth: attributes.iconBorderWidth + 'px',
                                fontSize: attributes.iconFontSize + 'px',
                                color: attributes.iconColor,
                                backgroundColor: attributes.iconBackgroundColor,
                                borderColor: attributes.iconBorderColor,
                                borderRadius: attributes.iconStyle === 'rounded' ? `${attributes.iconBorderRadius}px` : undefined
                            }}
                        >
                            A
                        </span>
                        <div className="faq-answer">
                            <InnerBlocks.Content />
                        </div>
                    </div>
                </div>
            );
        },
    });
}