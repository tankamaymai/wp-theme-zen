!function(t){t.blocks.registerBlockType;var e=t.blockEditor.InspectorControls,r=t.components,o=r.TextControl,n=r.PanelBody,i=t.hooks.addFilter,u=t.element.createElement;i("blocks.registerBlockType","mytheme/custom-attributes",(function(t,e){return"core/paragraph"!==e?t:_.assign({},t,{attributes:_.assign({},t.attributes,{customAttribute:{type:"string",default:"Hello, World!"}})})})),i("editor.BlockEdit","mytheme/add-custom-attribute-controls",t.compose.createHigherOrderComponent((function(r){return function(i){if("core/paragraph"!==i.name)return u(r,i);var s=i.attributes,a=i.setAttributes,l=s.customAttribute;return u(t.element.Fragment,{},u(r,i),u(e,null,u(n,{title:"カスタム属性",initialOpen:!0},u(o,{label:"Custom Attribute:",value:l,onChange:function(t){return a({customAttribute:t})}}))))}}),"withCustomAttributeControl"))}(window.wp);
//# sourceMappingURL=custom-blocks.bundle.js.map