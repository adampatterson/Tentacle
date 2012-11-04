<? load::view('admin/templates/template-header', array('title' => 'Resource', 'assets' => array('application')));?>
<div id="wrap">
	<div class="full-content">
		<div id="post-body">
			<div class="one-full">
				<div class="title pad-right">
					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" />Test Page</h1>
				</div>
			</div>
		</div>
		<div class="one-full">
			<textarea id="element-to-edit" class="editor">asdsad</textarea>
			<style type="text/css" media="screen">
				.ui-widget-content  .ui-icon-fancy-modal {
				    background-image: url(http://www.winsteps.com/blahdocs/images/smiley.gif);   
				}
			</style>
			<script type="text/javascript" src="https://raw.github.com/PANmedia/Raptor/master/packages/raptor.0deps.min.js"></script>
			<link rel="stylesheet" href="<?= ADMIN_CSS ?>custom-theme/jquery-ui-1.8.16.custom.css" type="text/css" media="screen" title="no title" charset="utf-8">
			<script type="text/javascript">
			    
				$.ui.editor.registerUi({
				    fancyModal: {
				        init: function(editor, options) {
				            return this.editor.uiButton({
				                title: 'Fancy Modal',
				                /**
				                 * This function will be called when the user clicks your fancyModal button                
				                 */
				                click: function() {
				                    // Open your modal here, prepare your HTML
				                    var someHTML = 'Some HTML';
				                    alert('About to replace selection with "' + someHTML + '"');

				                    // Replace the selection (inserting at caret position if 0 selection)
				                    $.ui.editor.selectionReplace(someHTML);
				                }
				            });
				        }
				    }
				});
			
				$('#element-to-edit').editor({
					autoEnable: true,
				    replace: true,
				    //enableUi: false,
				    draggable: false,
					uiOrder: [
					            ['textBold', 'textItalic', 'textUnderline', 'textStrike','quoteBlock','hr'], 
								['floatLeft', 'floatNone', 'floatRight'],
								['alignLeft', 'alignCenter', 'alignRight'],
								['listUnordered', 'listOrdered'],
								['link', 'unlink'],
								['embed', 'tag', 'viewSource', 'clearFormatting', 'clean'],
								['undo', 'redo'],
								['fancyModal'],
					        ],    
				    plugins: {
				        dock: {
				            docked: true,
				            dockToElement: true,
							persist: false 
				        },
				    }
				});
			</script>
		</div>
	</div><!-- .full-content -->
</div><!-- #wrap -->
<? load::view('admin/templates/template-footer', array( 'assets' => array( '' ) ) ); ?>