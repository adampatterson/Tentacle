<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Tentacle Admin</title>
    <!--

        _/_/_/_/_/                      _/                          _/
           _/      _/_/    _/_/_/    _/_/_/_/    _/_/_/    _/_/_/  _/    _/_/
          _/    _/_/_/_/  _/    _/    _/      _/    _/  _/        _/  _/_/_/_/
         _/    _/        _/    _/    _/      _/    _/  _/        _/  _/
        _/      _/_/_/  _/    _/      _/_/    _/_/_/    _/_/_/  _/    _/_/_/
        ======================================================================-->


    <link type="text/css" rel="stylesheet" href="<?=ADMIN_CSS; ?>application.css">
    <link type="text/css" rel="stylesheet" href="<?=ADMIN_CSS; ?>admin.css">

    <script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.min.js"></script>

    <script type="text/javascript" src="<?=ADMIN_JS; ?>bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>bootstrap-transition.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>bootstrap-collapse.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>bootstrap-tab.js"></script>

    <script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.reveal.js"></script>



    <meta name="viewport"/>
</head>
<body id="admin-window">

<div id="wrap">
    <div class="full-content">
        <div id="post-body">
            <div class="one-full">
                <div class="title pad-right">
                    <h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Threaded</h1>
                    <hr />
                </div>

                <script>

                    $(document).ready(function() {
                    
                    });

                </script>


                <p><a href="#" id="myButton" >Insert Media</a></p>


                <form action="#" method="post">

                    <textarea cols="100" id="editor" name="cke" rows="10">&lt;p&gt;This is some &lt;strong&gt;sample text&lt;/strong&gt;. You are using &lt;a href="http://ckeditor.com/"&gt;CKEditor&lt;/a&gt;.&lt;/p&gt;</textarea>

                    <script>
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

								var image_url				= '<?= IMAGE_URL ?>' + filename + image_size + '.' + filenextension;

								if (!link_url) {
					                var HtmlLink = '<img src="'+ image_url +'" alt="' + alt_text + '" title="' + title + '"  />';
					            } else {
					                var HtmlLink = '<a href="' + link_url + '"><img src="'+ image_url +'" alt="' + alt_text + '" title="' + title + '" /></a>';
					            }

								console.log( HtmlLink );
								insert_media( HtmlLink );
								
								$('.insert_media').trigger('reveal:close');

								return false;
							});

						});
                    </script>
            </div>
        </div>
    </div>
</div>
</body>
</html>