/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { useSelect } from '@wordpress/data';
import { useBlockProps } from '@wordpress/block-editor';

registerBlockType( 'gutenberg-blocks/latest-posts', {
    apiVersion: 3,
    title: 'Example: Latest Posts',
    icon: 'megaphone',
    category: 'gutenberg-block-category',

    edit: function( props ) {

        const blockProps = useBlockProps();
        const posts = useSelect( ( select ) => {
            return select( 'core' ).getEntityRecords( 'postType', 'post' );
        }, [] );

        return (
            <div { ...blockProps }>
                <h2>Latest Posts</h2>
                { ! posts && 'Loading...' }
                { posts && posts.map( ( post ) => (
                    <p key={ post.id }>{ post.title.rendered }</p>
                ) ) }
            </div>
        );

    }

});