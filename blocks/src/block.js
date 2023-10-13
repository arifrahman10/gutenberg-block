const { registerBlockType } = wp.blocks;
const { TextControl, Button } = wp.components;
const { __ } = wp.i18n;

import { registerBlockType } from '@wordpress/blocks';

registerBlockType('gutenberg-block/testimonial', {
    title: __('Testimonial 01', 'gutenberg-block'),
    icon: 'format-quote',
    category: 'common',
    attributes: {
        text: {
            type: 'string',
            default: '',
        },
        author: {
            type: 'string',
            default: '',
        },
    },
    edit: function (props) {
        const { attributes, setAttributes } = props;

        return (
            <div>
                <TextControl
                    label={__('Testimonial Text', 'gutenberg-block')}
                    value={attributes.text}
                    onChange={(text) => setAttributes({ text })}
                />
                <TextControl
                    label={__('Author', 'gutenberg-block')}
                    value={attributes.author}
                    onChange={(author) => setAttributes({ author })}
                />
                <Button>{__('Save Testimonial', 'gutenberg-block')}</Button>
            </div>
        );
    },
    save: function (props) {
        const { attributes } = props;
        return (
            <div className="testimonial">
                <blockquote>{attributes.text}</blockquote>
                <cite>{attributes.author}</cite>
            </div>
        );
    },
});