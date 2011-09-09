// -------------------------------------------------------------------
// markItUp!
// -------------------------------------------------------------------
// Copyright (C) 2008 Jay Salvat
// http://markitup.jaysalvat.com/
// -------------------------------------------------------------------
// Textile tags example
// http://en.wikipedia.org/wiki/Textile_(markup_language)
// http://www.textism.com/
// -------------------------------------------------------------------
// Feel free to add more tags
// -------------------------------------------------------------------
mySettings = {
	previewParserPath:	'', // path to your Textile parser
	onShiftEnter:		{keepDefault:false, replaceWith:'\n\n'},
	markupSet: [
      	{name:'Heading 1', className:'button_heading1', openWith:'h1(!(([![Class]!]))!). ', placeHolder:'Your title here...' },
        {name:'Heading 2', className:'button_heading2', openWith:'h2(!(([![Class]!]))!). ', placeHolder:'Your title here...' },
        {name:'Heading 3', className:'button_heading3', openWith:'h3(!(([![Class]!]))!). ', placeHolder:'Your title here...' },
        {name:'Paragraph', className:'button_paragraph', openWith:'p(!(([![Class]!]))!). '},
        {name:'Bold', className:'button_bold', closeWith:'*', openWith:'*'},
        {name:'Italic', className:'button_italic', closeWith:'_', openWith:'_'},
        {name:'Strike through', className:'button_strike', closeWith:'-', openWith:'-'},
        {name:'Bulleted List', className:'button_bullet_list', replaceWith:function(h){return selection.replace(/(\n)(.+)/g,'$1* $2').replace(/^/,'* ')} },
        {name:'Numeric List', className:'button_number_list', replaceWith:function(markItUp){return selection.replace(/(\n)(.+)/g,'$1# $2').replace(/^/,'# ')}},
        {name:'Link', className:'button_link', openWith:'"', closeWith:'([![Title]!])":[![Link:!:http://]!]', placeHolder:'Your text to link here...' },
 	]
}