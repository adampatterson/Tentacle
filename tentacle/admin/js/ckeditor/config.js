//<![CDATA[

	$(function()
	{
		var config = {
			toolbar: [
				['Bold','Italic','StrikeThrough'],
				['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
				['NumberedList', 'BulletedList'],
				['Outdent','Indent','Blockquote'],
				['Link','Unlink'],
				['PasteFromWord'],
				['Format', 'Table','HorizontalRule'],
				['atd-ckeditor'],
				['Source']
			],
			skin : 'tentacle',
			width: '99%',
			height: 400,
			uiColor: 'white',
			removePlugins: 'elementspath',
			extraPlugins : 'autogrow',
			extraPlugins : 'stylesheetparser',
			extraPlugins : 'tableresize',
			extraPlugins : 'atd-ckeditor',
			atd_api_key  : 'WPORG-dkfjhds'
		}

		// Initialize the editor.
		// Callback function can be passed and executed after full instance creation.
		$('.jquery_ckeditor').ckeditor(config);
	});

	//]]>