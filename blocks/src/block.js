const {registerBlockType} = wp.blocks;
const {TextControl} = wp.components;
const {__} = wp.i18n;


registerBlockType('gutenberg/blocks', {
    title: __('My Gutenberg Block', 'gutenberg-block'),
    icon: 'smiley',
    category: 'custom',
    attributes: {
        content: {
            type: 'string',
            default: 'Hello, Gutenberg!',
        },
    },
    edit: function (props) {
        const {attributes, setAttributes} = props;

        return (
            <div>
                <TextControl
                    label={__('Content', 'gutenberg-block')}
                    value={attributes.content}
                    onChange={(newContent) => setAttributes({content: newContent})}
                />
            </div>
        );
    },
    save: function () {
        return null; // Block content is saved on the server side.
    },
});
