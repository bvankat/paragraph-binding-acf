const { registerBlockVariation } = wp.blocks;
const { TextControl } = wp.components;
const { InspectorControls } = wp.blockEditor;
const { Fragment } = wp.element;

registerBlockVariation( 'acf-paragraph-block/dynamic', {
	name: 'acf-field-paragraph',
	title: 'ACF Field Paragraph',
	description: 'A Paragraph block that displays content from an ACF field.',
	attributes: {
		acfFieldSlug: {
			type: 'string',
			default: '',
		},
	},
	scope: [ 'inserter' ],
	edit: ( props ) => {
		const { attributes, setAttributes } = props;
		return (
			<Fragment>
				<InspectorControls>
					<TextControl
						label="ACF Field Slug"
						value={ attributes.acfFieldSlug }
						onChange={ ( value ) => setAttributes( { acfFieldSlug: value } ) }
						help="Enter the slug of the ACF field to display."
					/>
				</InspectorControls>
				<p style={{ border: '1px dashed #ccc', padding: '8px' }}>
					{ attributes.acfFieldSlug 
						? `This will display the ACF field: ${attributes.acfFieldSlug}` 
						: 'Please set an ACF field slug in the block settings.' }
				</p>
			</Fragment>
		);
	},
	save: () => {
		// Dynamic block: content rendered on server
		return null;
	},
});