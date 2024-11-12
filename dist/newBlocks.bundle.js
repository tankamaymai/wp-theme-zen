(()=>{"use strict";const e=window.wp.blocks,t=window.wp.i18n,o=window.wp.blockEditor,r=window.wp.components,n=JSON.parse('{"apiVersion":2,"name":"mytheme/faq","title":"FAQブロック","category":"zen","icon":"editor-help","description":"FAQブロック","textdomain":"mytheme","attributes":{"faqItems":{"type":"array","default":[]},"content":{"type":"string","source":"html","selector":"div"},"style":{"type":"string","default":"simple"}},"supports":{"html":false},"editorScript":"file:./index.js"}');function a(e){return a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},a(e)}function l(){return l=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var o=arguments[t];for(var r in o)Object.prototype.hasOwnProperty.call(o,r)&&(e[r]=o[r])}return e},l.apply(this,arguments)}function c(e,t){(null==t||t>e.length)&&(t=e.length);for(var o=0,r=new Array(t);o<t;o++)r[o]=e[o];return r}function i(e,t){var o=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),o.push.apply(o,r)}return o}function d(e){for(var t=1;t<arguments.length;t++){var o=null!=arguments[t]?arguments[t]:{};t%2?i(Object(o),!0).forEach((function(t){var r,n,l,c;r=e,n=t,l=o[t],c=function(e,t){if("object"!=a(e)||!e)return e;var o=e[Symbol.toPrimitive];if(void 0!==o){var r=o.call(e,"string");if("object"!=a(r))return r;throw new TypeError("@@toPrimitive must return a primitive value.")}return String(e)}(n),(n="symbol"==a(c)?c:c+"")in r?Object.defineProperty(r,n,{value:l,enumerable:!0,configurable:!0,writable:!0}):r[n]=l})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(o)):i(Object(o)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(o,t))}))}return e}function m(){return m=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var o=arguments[t];for(var r in o)Object.prototype.hasOwnProperty.call(o,r)&&(e[r]=o[r])}return e},m.apply(this,arguments)}wp.blocks.getBlockType(n.name)||(0,e.registerBlockType)(n.name,d(d({},n),{},{attributes:d(d({},n.attributes),{},{faqItems:{type:"array",default:[{id:Date.now().toString(),question:"",content:""}]},style:{type:"string",default:"simple"},dividerStyle:{type:"string",default:"solid"},dividerColor:{type:"string",default:"#cccccc"},dividerWidth:{type:"number",default:1},boxColor:{type:"string",default:"#ffffff"},boxBorderWidth:{type:"number",default:1},boxBorderColor:{type:"string",default:"#000000"},boxBorderRadius:{type:"number",default:5}}),edit:function(e){var n=e.attributes,a=e.setAttributes,i=e.clientId,d=(0,o.useBlockProps)(),m=n.style,u=(n.faqItems,function(){var e,t=wp.blocks.createBlock("mytheme/faq-child",{question:"",answer:""}),o=wp.data.select("core/block-editor").getBlock(i),r=[].concat(function(e){if(Array.isArray(e))return c(e)}(e=o.innerBlocks)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||function(e,t){if(e){if("string"==typeof e)return c(e,t);var o=Object.prototype.toString.call(e).slice(8,-1);return"Object"===o&&e.constructor&&(o=e.constructor.name),"Map"===o||"Set"===o?Array.from(e):"Arguments"===o||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(o)?c(e,t):void 0}}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}(),[t]);wp.data.dispatch("core/block-editor").replaceInnerBlocks(i,r,!1)});return React.createElement(React.Fragment,null,React.createElement(o.InspectorControls,null,React.createElement(r.PanelBody,{title:(0,t.__)("スタイル設定","mytheme")},React.createElement(r.SelectControl,{label:(0,t.__)("スタイル","mytheme"),value:m,options:[{label:(0,t.__)("シンプル","mytheme"),value:"simple"},{label:(0,t.__)("区切り線","mytheme"),value:"divider"},{label:(0,t.__)("ボックス","mytheme"),value:"box"}],onChange:function(e){return a({style:e})}}),"divider"===m&&React.createElement(React.Fragment,null,React.createElement(r.SelectControl,{label:(0,t.__)("区切り線のスタイル","mytheme"),value:n.dividerStyle,options:[{label:(0,t.__)("実線","mytheme"),value:"solid"},{label:(0,t.__)("点線","mytheme"),value:"dotted"},{label:(0,t.__)("破線","mytheme"),value:"dashed"}],onChange:function(e){return a({dividerStyle:e})}}),React.createElement("div",{className:"components-base-control"},React.createElement("span",null,(0,t.__)("区切り線の色","mytheme")),React.createElement(r.ColorPalette,{value:n.dividerColor,onChange:function(e){return a({dividerColor:e})}})),React.createElement(r.RangeControl,{label:(0,t.__)("区切り線の太さ","mytheme"),value:n.dividerWidth,onChange:function(e){return a({dividerWidth:e})},min:1,max:10})),"box"===m&&React.createElement(React.Fragment,null,React.createElement("div",{className:"components-base-control"},React.createElement("span",null,(0,t.__)("ボックスの色","mytheme")),React.createElement(r.ColorPalette,{value:n.boxColor,onChange:function(e){return a({boxColor:e})}})),React.createElement(r.RangeControl,{label:(0,t.__)("ボックスの枠線の太さ","mytheme"),value:n.boxBorderWidth,onChange:function(e){return a({boxBorderWidth:e})},min:0,max:10}),React.createElement("div",{className:"components-base-control"},React.createElement("span",null,(0,t.__)("ボックスの枠線の色","mytheme")),React.createElement(r.ColorPalette,{value:n.boxBorderColor,onChange:function(e){return a({boxBorderColor:e})}})),React.createElement(r.RangeControl,{label:(0,t.__)("ボックスの角の丸み","mytheme"),value:n.boxBorderRadius,onChange:function(e){return a({boxBorderRadius:e})},min:0,max:50})))),React.createElement("div",l({},d,{className:"faq-block style-".concat(m),style:"divider"===m?{borderBottom:"".concat(n.dividerWidth,"px ").concat(n.dividerStyle," ").concat(n.dividerColor)}:"box"===m?{backgroundColor:n.boxColor,border:"".concat(n.boxBorderWidth,"px solid ").concat(n.boxBorderColor),borderRadius:"".concat(n.boxBorderRadius,"px"),marginBottom:"10px"}:void 0}),React.createElement(o.InnerBlocks,{template:[["mytheme/faq-child",{question:(0,t.__)("質問を入力...","mytheme"),answer:(0,t.__)("回答を入力...","mytheme")}]],templateLock:!1,allowedBlocks:["mytheme/faq-child"],renderAppender:function(){return React.createElement(r.Button,{isPrimary:!0,onClick:u,className:"add-faq-button",icon:"plus"},(0,t.__)("FAQを追加","mytheme"))}})))},save:function(e){var t=e.attributes,r=o.useBlockProps.save(),n=t.style;return React.createElement("div",l({},r,{className:"faq-block style-".concat(n),style:"divider"===n?{borderBottom:"".concat(t.dividerWidth,"px ").concat(t.dividerStyle," ").concat(t.dividerColor)}:"box"===n?{backgroundColor:t.boxColor,border:"".concat(t.boxBorderWidth,"px solid ").concat(t.boxBorderColor),borderRadius:"".concat(t.boxBorderRadius,"px"),marginBottom:"10px"}:void 0}),React.createElement(o.InnerBlocks.Content,null))}})),wp.blocks.getBlockType("mytheme/faq-child")||(0,e.registerBlockType)("mytheme/faq-child",{title:(0,t.__)("FAQ子ブロック","mytheme"),description:(0,t.__)("FAQのアンサーブロックです","mytheme"),category:"zen",icon:"editor-help",supports:{html:!1},attributes:{question:{type:"string",source:"html",selector:".faq-question"},style:{type:"string",default:"simple"},dividerStyle:{type:"string",default:"solid"},dividerColor:{type:"string",default:"#cccccc"},dividerWidth:{type:"number",default:1},boxColor:{type:"string",default:"#ffffff"},boxBorderWidth:{type:"number",default:1},boxBorderColor:{type:"string",default:"#000000"},boxBorderRadius:{type:"number",default:5},iconStyle:{type:"string",default:"square"},iconSize:{type:"number",default:25},iconBorderWidth:{type:"number",default:1},iconFontSize:{type:"number",default:16},iconColor:{type:"string",default:"#000000"},iconBackgroundColor:{type:"string",default:"#ffffff"},iconBorderRadius:{type:"number",default:5},iconBorderColor:{type:"string",default:"#000000"},questionBackgroundColor:{type:"string",default:"#ffffff"},questionTextColor:{type:"string",default:"#000000"},answerBackgroundColor:{type:"string",default:"#ffffff"},answerTextColor:{type:"string",default:"#000000"}},edit:function(e){var n=e.attributes,a=e.setAttributes,l=(0,o.useBlockProps)(),c=n.style;return React.createElement(React.Fragment,null,React.createElement(o.InspectorControls,null,React.createElement(r.PanelBody,{title:(0,t.__)("スタイル設定","mytheme")},React.createElement(r.SelectControl,{label:(0,t.__)("スタイル","mytheme"),value:c,options:[{label:(0,t.__)("シンプル","mytheme"),value:"simple"},{label:(0,t.__)("区切り線","mytheme"),value:"divider"},{label:(0,t.__)("ボックス","mytheme"),value:"box"}],onChange:function(e){return a({style:e})}}),"divider"===c&&React.createElement(React.Fragment,null,React.createElement(r.SelectControl,{label:(0,t.__)("区切り線のスタイル","mytheme"),value:n.dividerStyle,options:[{label:(0,t.__)("実線","mytheme"),value:"solid"},{label:(0,t.__)("点線","mytheme"),value:"dotted"},{label:(0,t.__)("破線","mytheme"),value:"dashed"}],onChange:function(e){return a({dividerStyle:e})}}),React.createElement("div",{className:"components-base-control"},React.createElement("span",null,(0,t.__)("区切り線の色","mytheme")),React.createElement(r.ColorPalette,{value:n.dividerColor,onChange:function(e){return a({dividerColor:e})}})),React.createElement(r.RangeControl,{label:(0,t.__)("区切り線の太さ","mytheme"),value:n.dividerWidth,onChange:function(e){return a({dividerWidth:e})},min:1,max:10})),"box"===c&&React.createElement(React.Fragment,null,React.createElement("div",{className:"components-base-control"},React.createElement("span",null,(0,t.__)("ボックスの色","mytheme")),React.createElement(r.ColorPalette,{value:n.boxColor,onChange:function(e){return a({boxColor:e})}})),React.createElement(r.RangeControl,{label:(0,t.__)("ボックスの枠線の太さ","mytheme"),value:n.boxBorderWidth,onChange:function(e){return a({boxBorderWidth:e})},min:0,max:10}),React.createElement("div",{className:"components-base-control"},React.createElement("span",null,(0,t.__)("ボックスの枠線の色","mytheme")),React.createElement(r.ColorPalette,{value:n.boxBorderColor,onChange:function(e){return a({boxBorderColor:e})}})),React.createElement(r.RangeControl,{label:(0,t.__)("ボックスの角の丸み","mytheme"),value:n.boxBorderRadius,onChange:function(e){return a({boxBorderRadius:e})},min:0,max:50}))),React.createElement(r.PanelBody,{title:(0,t.__)("アイコン設定","mytheme")},React.createElement(r.SelectControl,{label:(0,t.__)("アイコンスタイル","mytheme"),value:n.iconStyle,options:[{label:(0,t.__)("四角","mytheme"),value:"square"},{label:(0,t.__)("丸","mytheme"),value:"circle"},{label:(0,t.__)("角丸","mytheme"),value:"rounded"}],onChange:function(e){return a({iconStyle:e})}}),"rounded"===n.iconStyle&&React.createElement(r.RangeControl,{label:(0,t.__)("アイコンの角の丸み","mytheme"),value:n.iconBorderRadius,onChange:function(e){return a({iconBorderRadius:e})},min:0,max:20}),React.createElement(r.RangeControl,{label:(0,t.__)("アイコンサイズ","mytheme"),value:n.iconSize,onChange:function(e){return a({iconSize:e})},min:20,max:50}),React.createElement(r.RangeControl,{label:(0,t.__)("アイコン枠線の太さ","mytheme"),value:n.iconBorderWidth,onChange:function(e){return a({iconBorderWidth:e})},min:0,max:5}),React.createElement(r.RangeControl,{label:(0,t.__)("アイコンの文字サイズ","mytheme"),value:n.iconFontSize,onChange:function(e){return a({iconFontSize:e})},min:12,max:30}),React.createElement("div",{className:"components-base-control"},React.createElement("span",null,(0,t.__)("アイコンの色","mytheme")),React.createElement(r.ColorPalette,{value:n.iconColor,onChange:function(e){return a({iconColor:e})}})),React.createElement("div",{className:"components-base-control"},React.createElement("span",null,(0,t.__)("アイコンの背景色","mytheme")),React.createElement(r.ColorPalette,{value:n.iconBackgroundColor,onChange:function(e){return a({iconBackgroundColor:e})}})),React.createElement("div",{className:"components-base-control"},React.createElement("span",null,(0,t.__)("アイコンの枠線の色","mytheme")),React.createElement(r.ColorPalette,{value:n.iconBorderColor,onChange:function(e){return a({iconBorderColor:e})}}))),React.createElement(r.PanelBody,{title:(0,t.__)("質問設定","mytheme")},React.createElement("div",{className:"components-base-control"},React.createElement("span",null,(0,t.__)("背景色","mytheme")),React.createElement(r.ColorPalette,{value:n.questionBackgroundColor,onChange:function(e){return a({questionBackgroundColor:e})}})),React.createElement("div",{className:"components-base-control"},React.createElement("span",null,(0,t.__)("文字色","mytheme")),React.createElement(r.ColorPalette,{value:n.questionTextColor,onChange:function(e){return a({questionTextColor:e})}}))),React.createElement(r.PanelBody,{title:(0,t.__)("回答設定","mytheme")},React.createElement("div",{className:"components-base-control"},React.createElement("span",null,(0,t.__)("背景色","mytheme")),React.createElement(r.ColorPalette,{value:n.answerBackgroundColor,onChange:function(e){return a({answerBackgroundColor:e})}})),React.createElement("div",{className:"components-base-control"},React.createElement("span",null,(0,t.__)("文字色","mytheme")),React.createElement(r.ColorPalette,{value:n.answerTextColor,onChange:function(e){return a({answerTextColor:e})}})))),React.createElement("div",m({},l,{className:"faq-child-block style-".concat(c),style:"divider"===c?{borderBottom:"".concat(n.dividerWidth,"px ").concat(n.dividerStyle," ").concat(n.dividerColor)}:"box"===c?{backgroundColor:n.boxColor,border:"".concat(n.boxBorderWidth,"px solid ").concat(n.boxBorderColor),borderRadius:"".concat(n.boxBorderRadius,"px"),marginBottom:"10px"}:void 0}),React.createElement("div",{className:"faq-question-wrapper",style:{backgroundColor:n.questionBackgroundColor,color:n.questionTextColor}},React.createElement("span",{className:"faq-icon ".concat("circle"===n.iconStyle?"faq-icon-circle":"rounded"===n.iconStyle?"faq-icon-rounded":""),style:{width:n.iconSize+"px",height:n.iconSize+"px",borderWidth:n.iconBorderWidth+"px",fontSize:n.iconFontSize+"px",color:n.iconColor,backgroundColor:n.iconBackgroundColor,borderColor:n.iconBorderColor,borderRadius:"rounded"===n.iconStyle?"".concat(n.iconBorderRadius,"px"):void 0}},"Q"),React.createElement(o.RichText,{tagName:"h4",className:"faq-question",value:n.question,onChange:function(e){return a({question:e})},placeholder:(0,t.__)("質問を入力...","mytheme"),style:{color:n.questionTextColor}})),React.createElement("div",{className:"faq-answer-wrapper",style:{backgroundColor:n.answerBackgroundColor,color:n.answerTextColor}},React.createElement("span",{className:"faq-icon ".concat("circle"===n.iconStyle?"faq-icon-circle":"rounded"===n.iconStyle?"faq-icon-rounded":""),style:{width:n.iconSize+"px",height:n.iconSize+"px",borderWidth:n.iconBorderWidth+"px",fontSize:n.iconFontSize+"px",color:n.iconColor,backgroundColor:n.iconBackgroundColor,borderColor:n.iconBorderColor,borderRadius:"rounded"===n.iconStyle?"".concat(n.iconBorderRadius,"px"):void 0}},"A"),React.createElement("div",{className:"faq-answer"},React.createElement(o.InnerBlocks,{template:[["core/paragraph",{placeholder:(0,t.__)("回答を入力...","mytheme")}]],templateLock:!1})))))},save:function(e){var t=e.attributes,r=o.useBlockProps.save(),n=t.style;return React.createElement("div",m({},r,{className:"faq-block style-".concat(n),style:"divider"===n?{borderBottom:"".concat(t.dividerWidth,"px ").concat(t.dividerStyle," ").concat(t.dividerColor)}:"box"===n?{backgroundColor:t.boxColor,border:"".concat(t.boxBorderWidth,"px solid ").concat(t.boxBorderColor),borderRadius:"".concat(t.boxBorderRadius,"px"),marginBottom:"10px"}:void 0}),React.createElement("div",{className:"faq-question-wrapper",style:{backgroundColor:t.questionBackgroundColor}},React.createElement("span",{className:"faq-icon ".concat("circle"===t.iconStyle?"faq-icon-circle":"rounded"===t.iconStyle?"faq-icon-rounded":""),style:{width:t.iconSize+"px",height:t.iconSize+"px",borderWidth:t.iconBorderWidth+"px",fontSize:t.iconFontSize+"px",color:t.iconColor,backgroundColor:t.iconBackgroundColor,borderColor:t.iconBorderColor,borderRadius:"rounded"===t.iconStyle?"".concat(t.iconBorderRadius,"px"):void 0}},"Q"),React.createElement(o.RichText.Content,{tagName:"h4",className:"faq-question",value:t.question,style:{color:t.questionTextColor}})),React.createElement("div",{className:"faq-answer-wrapper",style:{backgroundColor:t.answerBackgroundColor,color:t.answerTextColor}},React.createElement("span",{className:"faq-icon ".concat("circle"===t.iconStyle?"faq-icon-circle":"rounded"===t.iconStyle?"faq-icon-rounded":""),style:{width:t.iconSize+"px",height:t.iconSize+"px",borderWidth:t.iconBorderWidth+"px",fontSize:t.iconFontSize+"px",color:t.iconColor,backgroundColor:t.iconBackgroundColor,borderColor:t.iconBorderColor,borderRadius:"rounded"===t.iconStyle?"".concat(t.iconBorderRadius,"px"):void 0}},"A"),React.createElement("div",{className:"faq-answer"},React.createElement(o.InnerBlocks.Content,null))))}})})();
//# sourceMappingURL=newBlocks.bundle.js.map