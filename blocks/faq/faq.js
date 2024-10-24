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
  var useDispatch = data.useDispatch;
  var createBlock = blocks.createBlock;
  var useSelect = data.useSelect;

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
      
      const { insertBlock } = useDispatch('core/block-editor');
      const { getBlocksByClientId } = useSelect((select) => select('core/block-editor'), []);

      useEffect(() => {
        if (!uniqueId || uniqueIds.includes(uniqueId)) {
          const newUniqueId = 'faq-' + clientId.substr(2, 9);
          setAttributes({ uniqueId: newUniqueId });
          uniqueIds.push(newUniqueId);
        }
      }, []);

      function addItem() {
        const newBlock = createBlock('zen/faq-item', {
          question: '',
          answer: ''
        });
        insertBlock(newBlock, undefined, clientId);
      }

      function removeItem(index) {
        var newItems = [...faqItems];
        newItems.splice(index, 1);
        setAttributes({ faqItems: newItems });
      }

      function updateQuestion(index, content) {
        var newItems = [...faqItems];
        newItems[index].question = content;
        setAttributes({ faqItems: newItems });
      }

      return el(
        Fragment,
        {},
        el(
          InspectorControls,
          {},
          el(
            PanelBody,
            { title: "スタイル設定", initialOpen: false },
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
            })
          ),
          el(
            PanelBody,
            { title: "区切り線設定", initialOpen: false },
            el(SelectControl, {
              label: "線のスタイル",
              value: dividerStyle,
              options: [
                { label: "実線", value: "solid" },
                { label: "破線", value: "dashed" },
                { label: "点線", value: "dotted" },
              ],
              onChange: function (value) {
                setAttributes({ dividerStyle: value });
              },
            }),
            el(RangeControl, {
              label: "線の太さ",
              value: dividerWidth,
              onChange: function (value) {
                setAttributes({ dividerWidth: value });
              },
              min: 1,
              max: 10,
            }),
            el(ColorPalette, {
              colors: [
                { name: 'Gray', color: '#cccccc' },
                { name: 'Black', color: '#000000' },
              ],
              value: dividerColor,
              onChange: function (color) {
                setAttributes({ dividerColor: color });
              },
            })
          ),
          el(
            PanelBody,
            { title: "ボックス設定", initialOpen: false },
            el(ColorPalette, {
              colors: [
                { name: 'White', color: '#ffffff' },
                { name: 'Light Gray', color: '#f0f0f0' },
                { name: 'Gray', color: '#cccccc' },
              ],
              value: boxColor,
              onChange: function (color) {
                setAttributes({ boxColor: color });
              },
            }),
            el(RangeControl, {
              label: "ボーダーの太さ",
              value: boxBorderWidth,
              onChange: function (value) {
                setAttributes({ boxBorderWidth: value });
              },
              min: 0,
              max: 10,
            }),
            el(RangeControl, {
              label: "角の丸み",
              value: boxBorderRadius,
              onChange: function (value) {
                setAttributes({ boxBorderRadius: value });
              },
              min: 0,
              max: 20,
            })
          ),
          el(
            PanelBody,
            { title: "アイコン設定", initialOpen: false },
            el(SelectControl, {
              label: "アイコンスタイル",
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
              label: "アイコンサイズ",
              value: iconSize,
              onChange: function (value) {
                setAttributes({ iconSize: value });
              },
              min: 20,
              max: 40,
            }),
            el(RangeControl, {
              label: "アイコンボーダーの太さ",
              value: iconBorderWidth,
              onChange: function (value) {
                setAttributes({ iconBorderWidth: value });
              },
              min: 0,
              max: 5,
            }),
            el(RangeControl, {
              label: "アイコンフォントサイズ",
              value: iconFontSize,
              onChange: function (value) {
                setAttributes({ iconFontSize: value });
              },
              min: 12,
              max: 24,
            }),
            el(ColorPalette, {
              colors: [
                { name: 'White', color: '#ffffff' },
                { name: 'Black', color: '#000000' },
              ],
              value: iconColor,
              onChange: function (color) {
                setAttributes({ iconColor: color });
              },
            }),
            el(ColorPalette, {
              colors: [
                { name: 'Light Gray', color: '#f0f0f0' },
                { name: 'Gray', color: '#cccccc' },
                { name: 'Dark Gray', color: '#333333' },
              ],
              value: iconBackgroundColor,
              onChange: function (color) {
                setAttributes({ iconBackgroundColor: color });
              },
            }),
            el(ColorPalette, {
              colors: [
                { name: 'Light Gray', color: '#f0f0f0' },
                { name: 'Gray', color: '#cccccc' },
                { name: 'Dark Gray', color: '#333333' },
              ],
              value: iconBorderColor,
              onChange: function (color) {
                setAttributes({ iconBorderColor: color });
              },
            })
          ),
          el(
            PanelBody,
            { title: "質問設定", initialOpen: false },
            el(ColorPalette, {
              colors: [
                { name: 'White', color: '#ffffff' },
                { name: 'Light Gray', color: '#f0f0f0' },
                { name: 'Gray', color: '#cccccc' },
              ],
              value: questionBackgroundColor,
              onChange: function (color) {
                setAttributes({ questionBackgroundColor: color });
              },
            }),
            el(ColorPalette, {
              colors: [
                { name: 'Black', color: '#000000' },
                { name: 'Dark Gray', color: '#333333' },
                { name: 'Gray', color: '#666666' },
              ],
              value: questionTextColor,
              onChange: function (color) {
                setAttributes({ questionTextColor: color });
              },
            })
          ),
          el(
            PanelBody,
            { title: "回答設定", initialOpen: false },
            el(ColorPalette, {
              colors: [
                { name: 'White', color: '#ffffff' },
                { name: 'Light Gray', color: '#f0f0f0' },
                { name: 'Gray', color: '#cccccc' },
              ],
              value: answerBackgroundColor,
              onChange: function (color) {
                setAttributes({ answerBackgroundColor: color });
              },
            }),
            el(ColorPalette, {
              colors: [
                { name: 'Black', color: '#000000' },
                { name: 'Dark Gray', color: '#333333' },
                { name: 'Gray', color: '#666666' },
              ],
              value: answerTextColor,
              onChange: function (color) {
                setAttributes({ answerTextColor: color });
              },
            })
          )
        ),
        el(
          "div",
          blockProps,
          el(InnerBlocks, {
            allowedBlocks: ['zen/faq-item'],
            renderAppender: () => el(Button, {
              isPrimary: true,
              onClick: addItem
            }, 'FAQ項目を追加')
          })
        )
      );
    },
    save: function (props) {
      var blockProps = useBlockProps.save();
      var { attributes } = props;
      var { style, dividerStyle, dividerColor, dividerWidth, boxColor, boxBorderWidth, boxBorderRadius, iconStyle, iconSize, iconBorderWidth, iconFontSize, iconColor, iconBackgroundColor, iconBorderColor, questionBackgroundColor, questionTextColor, answerBackgroundColor, answerTextColor, uniqueId } = attributes;
      return el(
        "div",
        {
          ...blockProps,
          className: `faq-block faq-style-${style}`,
        },
        el(InnerBlocks.Content)
      );
    },
  });

  // FAQ項目ブロックの登録
  blocks.registerBlockType('zen/faq-item', {
    title: 'FAQ項目',
    parent: ['zen/faq'],
    attributes: {
      question: {
        type: 'string',
        source: 'html',
        selector: '.faq-question'
      },
      answer: {
        type: 'array',
        source: 'children',
        selector: '.faq-answer'
      }
    },
    edit: function(props) {
      var attributes = props.attributes;
      var setAttributes = props.setAttributes;

      return el('div', { className: 'faq-item' },
        el(RichText, {
          tagName: 'h3',
          className: 'faq-question',
          value: attributes.question,
          onChange: (question) => setAttributes({ question }),
          placeholder: '質問を入力'
        }),
        el('div', { className: 'faq-answer' },
          el(InnerBlocks, {
            allowedBlocks: true,
            templateLock: false
          })
        )
      );
    },
    save: function(props) {
      var attributes = props.attributes;

      return el('div', { className: 'faq-item' },
        el(RichText.Content, {
          tagName: 'h3',
          className: 'faq-question',
          value: attributes.question
        }),
        el('div', { className: 'faq-answer' },
          el(InnerBlocks.Content)
        )
      );
    }
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.blockEditor,
  window.wp.components,
  window.wp.data
);