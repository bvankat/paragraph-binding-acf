const { registerBlockVariation } = wp.blocks;
const { TextControl } = wp.components;

registerBlockVariation( 'core/paragraph', {
	name: 'acf-field',
	title: 'ACF Field Paragraph',
	description: 'A Paragraph block that displays content from an ACF field.',
	attributes: {
		acfFieldSlug: {
			type: 'string',
			default: '',
		},
	},
	edit: ( props ) => {
		const { attributes, setAttributes } = props;

		return (
			<>
				<TextControl
					label="ACF Field Slug"
					value={ attributes.acfFieldSlug }
					onChange={ ( value ) => setAttributes( { acfFieldSlug: value } ) }
					help="Enter the slug of the ACF field to display in this paragraph."
				/>
			</>
		);
	},
	save: () => {
		// This block is dynamic, so we don't need to save anything here.
		return null;
	},
});
