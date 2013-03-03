// Replace the <textarea id="editor1"> with an CKEditor instance.
CKEDITOR.replace( 'editor');

function insert_media( html ) {
    // Get the editor instance that we want to interact with.
    var editor = CKEDITOR.instances.editor;

    // Check the active editing mode.
    if ( editor.mode == 'wysiwyg' )
    {
        // Insert HTML code.
        // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-insertHtml
        editor.insertHtml( html );
    }
    else
        alert( 'You must be in WYSIWYG mode!' );
}


$(document).ready(function(){

	$('#myButton').click(function(e) {
	      e.preventDefault();
	      $('#myModal').reveal({
	          animation: 'fade',                   //fade, fadeAndPop, none
	          animationspeed: 150,                       //how fast animtions are
	          closeonbackgroundclick: true,              //if you click background will modal close?
	          dismissmodalclass: 'close-reveal-modal'    //the class of a button or element that will close an open modal
	      });
	  });

	$('.insert_media').click(function() {

		var title				    = $('.title').val();
		var alt_text				= $('.alt_text').val();
		var caption				    = $('.caption').val();
		var link_url				= $('.link_url').val();

		var filename				= $('.filename').val();
		var filenextension			= $('.extension').val();

        var size		          	= $('.image_size:checked').val();

		if ( size != '' ) {
			var image_size			= '_'+size;
		} else {
			var image_size			= '';
		};

		var url				= image_url + filename + image_size + '.' + filenextension;

		if (!link_url) {
            var HtmlLink = '<img src="'+ url +'" alt="' + alt_text + '" title="' + title + '"  />';
        } else {
            var HtmlLink = '<a href="' + link_url + '"><img src="'+ url +'" alt="' + alt_text + '" title="' + title + '" /></a>';
        }

		console.log( HtmlLink );
		insert_media( HtmlLink );
		
		$('.insert_media').trigger('reveal:close');

		return false;
	});

});