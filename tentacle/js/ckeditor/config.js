/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {

    // Protect PHP code tags (<?...?>) so CKEditor will not break them when
    // switching from Source to WYSIWYG.

    config.protectedSource.push(/<\?[\s\S]*?\?>/g); // PHP Code
//    config.protectedSource.push(/<code>[\s\S]*?<\/code>/gi); // Code tags
//    config.protectedSource.push(/<pre>[\s\S]*?<\/pre>/gi); // Pre tags

    //IE: remove border of image when is as a link
    config.extraCss = "a img { border: 0px\\9; }";

    config.disableNativeSpellChecker = false;
    config.autogrow_maxHeight = 1000;
    config.autoGrow_minHeight = 550;
    config.autoGrow_onStartup = true;
    config.enterMode = CKEDITOR.ENTER_P;

    config.entities = false;
    config.entities_latin = false;
    config.fillEmptyBlocks = true;
    config.tabSpaces = 4;


    // Define changes to default configuration here.
    // For the complete reference:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config

    // The toolbar groups arrangement, optimized for a single toolbar row.
    config.toolbarGroups = [
        { name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
        // On the basic preset, clipboard and undo is handled by keyboard.
        // Uncomment the following line to enable them on the toolbar as well.
        // { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
        { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
        { name: 'forms' },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },
        { name: 'links' },
        { name: 'styles' },
        { name: 'colors' },
        { name: 'tools' }
    ];

	// The toolbar groups arrangement, optimized for a single toolbar row.
	// config.toolbarGroups = [
	// 	{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
	// 	{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
	// 	{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
	// 	{ name: 'forms' },
	// 	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	// 	{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
	// 	{ name: 'links' },
	// 	{ name: 'insert' },
	// 	{ name: 'styles' },
	// 	{ name: 'colors' },
	// 	{ name: 'tools' },
	// 	{ name: 'others' },
	// 	{ name: 'about' }
	// ];


    // The default plugins included in the basic setup define some buttons that
    // we don't want too have in a basic editor. We remove them here.
    config.removeButtons = 'Anchor,Underline,Strike,Subscript,Superscript';

    // Considering that the basic setup doesn't provide pasting cleanup features,
    // it's recommended to force everything to be plain text.
    config.forcePasteAsPlainText = true;

    // Let's have it basic on dialogs as well.
    config.removeDialogTabs = 'link:advanced';


    config.codemirror = {

        // Set this to the theme you wish to use (codemirror themes)
        theme: 'default',

        // Whether or not you want to show line numbers
        lineNumbers: true,

        // Whether or not you want to use line wrapping
        lineWrapping: true,

        // Whether or not you want to highlight matching braces
        matchBrackets: true,

        // Whether or not you want tags to automatically close themselves
        autoCloseTags: true,

        // Whether or not you want Brackets to automatically close themselves
        autoCloseBrackets: true,

        // Whether or not to enable search tools, CTRL+F (Find), CTRL+SHIFT+F (Replace), CTRL+SHIFT+R (Replace All), CTRL+G (Find Next), CTRL+SHIFT+G (Find Previous)
        enableSearchTools: true,

        // Whether or not you wish to enable code folding (requires 'lineNumbers' to be set to 'true')
        enableCodeFolding: true,

        // Whether or not to enable code formatting
        enableCodeFormatting: false,

        // Whether or not to automatically format code should be done every time the source view is opened
        autoFormatOnStart: true,

        // Whether or not to automatically format code which has just been uncommented
        autoFormatOnUncomment: true,

        // Whether or not to highlight the currently active line
        highlightActiveLine: true,

        // Whether or not to highlight all matches of current word/selection
        highlightMatches: true,

        // Whether or not to show the format button on the toolbar
        showFormatButton: true,

        // Whether or not to show the comment button on the toolbar
        showCommentButton: true,

        // Whether or not to show the uncomment button on the toolbar
        showUncommentButton: true
    };

};