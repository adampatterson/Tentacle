/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * Documentation:
 * http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html
 */

CKEDITOR.editorConfig = function(config) {
	// The minimum editor width, in pixels, when resizing it with the resize handle.
	config.resize_minWidth = 450;

	// Protect PHP code tags (<?...?>) so CKEditor will not break them when
	// switching from Source to WYSIWYG.
	config.protectedSource.push(/<\?[\s\S]*?\?>/g);

	// Define toolbars, you can remove or add buttons.
	// List of all buttons is here: http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html#.toolbar_Full


	// WordPress full toolbar
	config.toolbar_tentacle = [
			['Bold','Italic','NumberedList', 'BulletedList'],
			['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
			['Format'],
			['Outdent','Indent','Blockquote'],
			['Link','Unlink'],
			//['PasteFromWord'],
			//['Table','HorizontalRule'],
			//['Maximize'],
			//['atd-ckeditor', 'WPMore']
			['Source'],
		 ];

		config.toolbarCanCollapse = false;
		
		config.resize_enabled = false;

	// mediaembed plugin
	// config.extraPlugins += (config.extraPlugins ? ',mediaembed' : 'mediaembed' );
	// CKEDITOR.plugins.addExternal('mediaembed', ckeditorSettings.pluginPath + 'plugins/mediaembed/');
};
