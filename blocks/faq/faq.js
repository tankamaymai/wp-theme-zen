(function (blocks, element, blockEditor, components, data) {
    var el = element.createElement;
    var RichText = blockEditor.RichText;
    var Fragment = element.Fragment;
    var Button = components.Button;
    var InspectorControls = blockEditor.InspectorControls;
    var PanelBody = components.PanelBody;
    var SelectControl = components.SelectControl;
    var RangeControl = components.RangeControl;
    var ColorPalette = components.ColorPalette;
    var useBlockProps = blockEditor.useBlockProps;
    var InnerBlocks = blockEditor.InnerBlocks;
    var useEffect = element.useEffect;
    // 一意のIDを保存するための配列
    const uniqueIds = [];

    blocks.registerBlockType("zen/faq", {
        title: "FAQ",
        icon: "format-chat",
        category: "zen",
        attributes: {
            faqItems: {
                type: "array",
                default: [{ id: Date.now().toString(), question: '', content: '' }],
                source: "query",
                selector: ".faq-item",
                query: {
                    question: {
                        type: "string",
                        source: "html",
                        selector: ".faq-question",
                    },
                    answer: {
                        type: "array",
                        source: "query",
                        selector: ".faq-answer",
                        query: {
                            content: {
                                type: "string",
                                source: "html",
                            },
                        },
                    },
                },
            },
            style: {
                type: "string",
                default: "simple",
            },
            dividerStyle: {
                type: "string",
                default: "solid",
            },
            dividerColor: {
                type: "string",
                default: "#cccccc",
            },
            dividerWidth: {
                type: "number",
                default: 1,
            },
            boxColor: {
                type: "string",
                default: "#ffffff",
            },
            boxBorderWidth: {
                type: "number",
                default: 1,
            },
            boxBorderRadius: {
                type: "number",
                default: 5,
            },
            iconStyle: {
                type: "string",
                default: "square",
            },
            iconSize: {
                type: "number",
                default: 25,
            },
            iconBorderWidth: {
                type: "number",
                default: 1,
            },
            iconFontSize: {
                type: "number",
                default: 16,
            },
            iconColor: {
                type: "string",
                default: "#ffffff",
            },
            iconBackgroundColor: {
                type: "string",
                default: "#333333",
            },
            iconBorderColor: {
                type: "string",
                default: "#333333",
            },
            questionBackgroundColor: {
                type: "string",
                default: "#ffffff",
            },
            questionTextColor: {
                type: "string",
                default: "#333333",
            },
            answerBackgroundColor: {
                type: "string",
                default: "#ffffff",
            },
            answerTextColor: {
                type: "string",
                default: "#333333",
            },
            uniqueId: {
                type: "string",
                default: "",
            },
        },
        edit: function (props) {
            var blockProps = useBlockProps();
            var { attributes, setAttributes, clientId } = props;
            var { faqItems, style, dividerStyle, dividerColor, dividerWidth, boxColor, boxBorderWidth, boxBorderRadius, iconStyle, iconSize, iconBorderWidth, iconFontSize, iconColor, iconBackgroundColor, iconBorderColor, questionBackgroundColor, questionTextColor, answerBackgroundColor, answerTextColor, uniqueId } = attributes;

            useEffect(() => {
                if (!uniqueId || uniqueIds.includes(uniqueId)) {
                    const newUniqueId = 'faq-' + clientId.substr(2, 9);
                    setAttributes({ uniqueId: newUniqueId });
                    uniqueIds.push(newUniqueId);
                } else {
                    uniqueIds.push(uniqueId);
                }
            }, []);

            var updateQuestion = function (value, index) {
                var newItems = faqItems.slice();
                newItems[index].question = value;
                setAttributes({ faqItems: newItems });
            };
            var updateInnerBlocks = function (innerBlocks, index) {
                var newItems = faqItems.slice();
                newItems[index].innerBlocks = innerBlocks;
                setAttributes({ faqItems: newItems });
            };

            var addItem = function () {
                var newItems = faqItems.slice();
                newItems.push({ 
                    id: Date.now().toString(), 
                    question: '', 
                    innerBlocks: [] // 空のinnerBlocksを追加
                });
                setAttributes({ faqItems: newItems });
            };

            var removeItem = function (index) {
                var newItems = faqItems.slice();
                newItems.splice(index, 1);
                setAttributes({ faqItems: newItems });
            };

            return el(
                Fragment,
                null,
                el(
                    InspectorControls,
                    null,
                    el(
                        PanelBody,
                        { title: "スタイル設定" },
                        el(SelectControl, {
                            label: "スタイル",
                            value: style,
                            options: [
                                { label: "シンプル", value: "simple" },
                                { label: "区切り線", value: "divider" },
                                { label: "ボックス", value: "box" },
                            ],
                            onChange: function (value) {
                                setAttributes({ style: value });
                            },
                        }),
                        style === "divider" && el(
                            Fragment,
                            null,
                            el(SelectControl, {
                                label: "区切り線のスタイル",
                                value: dividerStyle,
                                options: [
                                    { label: "実線", value: "solid" },
                                    { label: "点線", value: "dotted" },
                                    { label: "破線", value: "dashed" },
                                ],
                                onChange: function (value) {
                                    setAttributes({ dividerStyle: value });
                                },
                            }),
                            el("span", null, "区切り線の色"),
                            el(ColorPalette, {
                                value: dividerColor,
                                onChange: function (value) {
                                    setAttributes({ dividerColor: value });
                                },
                            }),
                            el(RangeControl, {
                                label: "区切り線の太さ",
                                value: dividerWidth,
                                onChange: function (value) {
                                    setAttributes({ dividerWidth: value });
                                },
                                min: 1,
                                max: 10,
                            })
                        ),
                        style === "box" && el(
                            Fragment,
                            null,
                            el("span", null, "ボックスの色"),
                            el(ColorPalette, {
                                value: boxColor,
                                onChange: function (value) {
                                    setAttributes({ boxColor: value });
                                },
                            }),
                            el(RangeControl, {
                                label: "ボックスの枠線の太さ",
                                value: boxBorderWidth,
                                onChange: function (value) {
                                    setAttributes({ boxBorderWidth: value });
                                },
                                min: 0,
                                max: 10,
                            }),
                            el(RangeControl, {
                                label: "ボックスの角の丸み",
                                value: boxBorderRadius,
                                onChange: function (value) {
                                    setAttributes({ boxBorderRadius: value });
                                },
                                min: 0,
                                max: 50,
                            })
                        )
                    ),
                    el(
                        PanelBody,
                        { title: "アイコン設定" },
                        el(SelectControl, {
                            label: "アイコンのスタイル",
                            value: iconStyle,
                            options: [
                                { label: "四角", value: "square" },
                                { label: "丸", value: "circle" },
                            ],
                            onChange: function (value) {
                                setAttributes({ iconStyle: value });
                            },
                        }),
                        el(RangeControl, {
                            label: "アイコンのサイズ",
                            value: iconSize,
                            onChange: function (value) {
                                setAttributes({ iconSize: value });
                            },
                            min: 20,
                            max: 60,
                        }),
                        el(RangeControl, {
                            label: "アイコンの枠線の太さ",
                            value: iconBorderWidth,
                            onChange: function (value) {
                                setAttributes({ iconBorderWidth: value });
                            },
                            min: 0,
                            max: 10,
                        }),
                        el(RangeControl, {
                            label: "アイコンの文字サイズ",
                            value: iconFontSize,
                            onChange: function (value) {
                                setAttributes({ iconFontSize: value });
                            },
                            min: 10,
                            max: 30,
                        }),
                        el("span", null, "アイコンの文字色"),
                        el(ColorPalette, {
                            value: iconColor,
                            onChange: function (value) {
                                setAttributes({ iconColor: value });
                            },
                        }),
                        el("span", null, "アイコンの背景色"),
                        el(ColorPalette, {
                            value: iconBackgroundColor,
                            onChange: function (value) {
                                setAttributes({ iconBackgroundColor: value });
                            },
                        }),
                        el("span", null, "アイコンの枠線の色"),
                        el(ColorPalette, {
                            value: iconBorderColor,
                            onChange: function (value) {
                                setAttributes({ iconBorderColor: value });
                            },
                        })
                    ),
                    el(
                        PanelBody,
                        { title: "質問設定" },
                        el("span", null, "質問の背景色"),
                        el(ColorPalette, {
                            value: questionBackgroundColor,
                            onChange: function (value) {
                                setAttributes({ questionBackgroundColor: value });
                            },
                        }),
                        el("span", null, "質問の文字色"),
                        el(ColorPalette, {
                            value: questionTextColor,
                            onChange: function (value) {
                                setAttributes({ questionTextColor: value });
                            },
                        })
                    ),
                    el(
                        PanelBody,
                        { title: "回答設定" },
                        el("span", null, "回答の背景色"),
                        el(ColorPalette, {
                            value: answerBackgroundColor,
                            onChange: function (value) {
                                setAttributes({ answerBackgroundColor: value });
                            },
                        }),
                        el("span", null, "回答の文字色"),
                        el(ColorPalette, {
                            value: answerTextColor,
                            onChange: function (value) {
                                setAttributes({ answerTextColor: value });
                            },
                        })
                    )
                ),
                el(
                    "div",
                    blockProps,
                    el("ul", { className: "faq-list" },
                        faqItems.map(function (item, index) {
                            return el(
                                "li",
                                {
                                    className: `faq-item faq-icon-${iconStyle}`,
                                    key: item.id,
                                    style: style === "divider" ? {
                                        borderBottom: `${dividerWidth}px ${dividerStyle} ${dividerColor}`,
                                    } : style === "box" ? {
                                        backgroundColor: boxColor,
                                        border: `${boxBorderWidth}px solid ${boxColor}`,
                                        borderRadius: `${boxBorderRadius}px`,
                                        marginBottom: "10px",
                                    } : {},
                                },
                                el(
                                    "div",
                                    {
                                        className: "faq-question-wrapper",
                                        style: {
                                            backgroundColor: questionBackgroundColor,
                                            color: questionTextColor,
                                        },
                                    },
                                    el(
                                        "span",
                                        {
                                            className: "faq-icon faq-question-icon",
                                            style: {
                                                width: iconSize + "px",
                                                height: iconSize + "px",
                                                borderWidth: iconBorderWidth + "px",
                                                fontSize: iconFontSize + "px",
                                                color: iconColor,
                                                backgroundColor: iconBackgroundColor,
                                                borderColor: iconBorderColor,
                                            },
                                        },
                                        "Q"
                                    ),
                                    el(RichText, {
                                        tagName: "h3",
                                        className: "faq-question",
                                        value: item.question,
                                        onChange: function (value) {
                                            return updateQuestion(value, index);
                                        },
                                        placeholder: "質問を入力",
                                    })
                                ),
                                el(
                                    "div",
                                    {
                                        className: "faq-answer-wrapper",
                                        style: {
                                            backgroundColor: answerBackgroundColor,
                                            color: answerTextColor,
                                        },
                                    },
                                    el(
                                        "span",
                                        {
                                            className: "faq-icon faq-answer-icon",
                                            style: {
                                                width: iconSize + "px",
                                                height: iconSize + "px",
                                                borderWidth: iconBorderWidth + "px",
                                                fontSize: iconFontSize + "px",
                                                color: iconColor,
                                                backgroundColor: iconBackgroundColor,
                                                borderColor: iconBorderColor,
                                            },
                                        },
                                        "A"
                                    ),
                                    el("div", { 
                                        className: "faq-answer",
                                        "data-faq-answer-id": `${uniqueId}-answer-${index}`
                                    },
                                    el(InnerBlocks, {
                                        allowedBlocks: null,
                                        templateLock: false,
                                        template: [
                                            ['mytheme/faq-child'],

                                        ],
                                        renderAppender: () => el(InnerBlocks.ButtonBlockAppender),
                                        value: item.innerBlocks, // 既存のinnerBlocksを渡す
                                        onChange: (newInnerBlocks) => updateInnerBlocks(newInnerBlocks, index),
                                        __experimentalProps: {
                                            'data-faq-answer-id': `${uniqueId}-answer-${index}`
                                        }
                                    })
                                    )
                                ),
                                el(Button, {
                                    icon: "trash",
                                    label: "削除",
                                    onClick: function () {
                                        return removeItem(index);
                                    },
                                })
                            );
                        })
                    ),
                    el(
                        Button,
                        {
                            isPrimary: true,
                            onClick: addItem,
                        },
                        "FAQ項目を追加"
                    )
                )
            );
        },
        save: function (props) {
            var blockProps = useBlockProps.save();
            var { attributes } = props;
            var { faqItems, style, dividerStyle, dividerColor, dividerWidth, boxColor, boxBorderWidth, boxBorderRadius, iconStyle, iconSize, iconBorderWidth, iconFontSize, iconColor, iconBackgroundColor, iconBorderColor, questionBackgroundColor, questionTextColor, answerBackgroundColor, answerTextColor, uniqueId } = attributes;
            return el(
                "div",
                {
                    ...blockProps,
                    className: `faq-block faq-style-${style}`,
                },
                el("ul", { className: "faq-list" },
                    faqItems.map(function (item, index) {
                        return el(
                            "li",
                            {
                                className: `faq-item faq-icon-${iconStyle}`,
                                key: item.id,
                                style: style === "divider" ? {
                                    borderBottom: `${dividerWidth}px ${dividerStyle} ${dividerColor}`,
                                } : style === "box" ? {
                                    backgroundColor: boxColor,
                                    border: `${boxBorderWidth}px solid ${boxColor}`,
                                    borderRadius: `${boxBorderRadius}px`,
                                    marginBottom: "10px",
                                } : {},
                            },
                            el(
                                "div",
                                {
                                    className: "faq-question-wrapper",
                                    style: {
                                        backgroundColor: questionBackgroundColor,
                                        color: questionTextColor,
                                    },
                                },
                                el(
                                    "span",
                                    {
                                        className: "faq-icon faq-question-icon",
                                        style: {
                                            width: iconSize + "px",
                                            height: iconSize + "px",
                                            borderWidth: iconBorderWidth + "px",
                                            fontSize: iconFontSize + "px",
                                            color: iconColor,
                                            backgroundColor: iconBackgroundColor,
                                            borderColor: iconBorderColor,
                                        },
                                    },
                                    "Q"
                                ),
                                el(RichText.Content, {
                                    tagName: "h3",
                                    className: "faq-question",
                                    value: item.question,
                                })
                            ),
                            el(
                                "div",
                                {
                                    className: "faq-answer-wrapper",
                                    style: {
                                        backgroundColor: answerBackgroundColor,
                                        color: answerTextColor,
                                    },
                                },
                                el(
                                    "span",
                                    {
                                        className: "faq-icon faq-answer-icon",
                                        style: {
                                            width: iconSize + "px",
                                            height: iconSize + "px",
                                            borderWidth: iconBorderWidth + "px",
                                            fontSize: iconFontSize + "px",
                                            color: iconColor,
                                            backgroundColor: iconBackgroundColor,
                                            borderColor: iconBorderColor,
                                        },
                                    },
                                    "A"
                                ),
                                el("div", { 
                                    className: "faq-answer",
                                    "data-faq-answer-id": `${uniqueId}-answer-${index}`
                                },
                                el(InnerBlocks.Content, {
                                    value: item.innerBlocks,
                                    'data-faq-answer-inner-blocks-id': `${uniqueId}-answer-inner-blocks-${index}`
                                })
                                    
                                )
                            )
                        );
                    })
                )
            );
        },
    });
})(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor,
    window.wp.components,
    window.wp.data
);

