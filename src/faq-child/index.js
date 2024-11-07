
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { InnerBlocks } from '@wordpress/block-editor';
import { useBlockProps } from '@wordpress/block-editor';


// ブロックの登録
registerBlockType('mytheme/faq-child', {
    title: __('FAQ子ブロック', 'mytheme'),
    description: __('FAQのアンサーブロックです', 'mytheme'),
    category: 'zen',
    icon: 'editor-help',
    supports: {
        html: false,
    },
edit() {
        const blockProps = useBlockProps();
        return (
            <div {...blockProps}>
                <InnerBlocks 
                    template={[['core/paragraph', { placeholder: '回答を入力' }]]}
                    templateLock={false}
                />
                
            </div>
        );
    },
    save() {
        const blockProps = useBlockProps.save();
        return (
            <div {...blockProps}>
                <InnerBlocks.Content />
            </div>
        );
    },
});