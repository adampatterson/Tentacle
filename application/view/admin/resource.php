<? load::view('admin/templates/template-header', array('title' => 'Resource', 'assets' => array('fancybox')));?>
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
			<script type="text/javascript" src="<?= ADMIN_JS; ?>jquery.reveal.js"></script>
			
			<script type="text/javascript" charset="utf-8">
				var raptorMediaLibrary = {"url":"<?= BASE_URL ?>admin/media_insert"};
			</script>	

			<textarea id="element-to-edit" class="editor">asdsad</textarea>
			
			<style type="text/css" media="screen">
				.ui-widget-content  .ui-icon-fancy-modal {
				    background-image: url(http://www.winsteps.com/blahdocs/images/smiley.gif);   
				}
			</style>
			<script type="text/javascript" src="<?= ADMIN_JS; ?>raptor/raptor.0deps.min.js"></script>

			<script type="text/javascript">
		

				    $.ui.editor.registerUi({

				        /**
				         * @name $.editor.ui.tentacleMediaLibrary
				         * @augments $.ui.editor.defaultUi
				         * @class Invokes wordpress media library
				         */
				        tentacleMediaLibrary: /** @lends $.editor.ui.tentacleMediaLibrary.prototype */ {

				            dialog: null,

				            /**
				             * @see $.ui.editor.defaultUi#init
				             */
				            init: function(editor) {

				                this.bindSendToEditor();

				                return editor.uiButton({
				                    title: 'Media Library',
				                    icon: 'ui-icon-fancy-modal',
				                    click: function() {
				                        this.show();
				                    }
				                });
				            },

				            bindSendToEditor: function() {
				                var ui = this;
				                window.send_to_editor = function(html) {

				                    $.ui.editor.selectionRestore();
				                    $.ui.editor.selectionReplace(html);

				                    ui.dialog.dialog('destroy');
				                    ui.dialog = null;
				                };
				            },

				            show: function() {
				                var ui = this;

				                $.ui.editor.selectionSave();
				                this.dialog = $('<div style="display:none"><iframe src="' + raptorMediaLibrary.url + '?type=image&TB_iframe=true" /></div>').appendTo('body');
				                this.dialog.dialog({
				                    title: 'Media Library',
				                    position: 'center center',
				                    resizable: true,
				                    modal: true,
				                    closeOnEscape: true,
				                    minWidth: 695,
				                    minHeight: 440,
				                    dialogClass: ui.options.baseClass + '-dialog',
				                    resize: function() {
				                        ui.resizeIframe();
				                    },
				                    open: function() {
				                        ui.resizeIframe();
				                    },
				                    close: function() {
				                        $.ui.editor.selectionRestore();
				                        if (ui.dialog) {
				                            ui.dialog.dialog('destroy');
				                            ui.dialog = null;
				                        }
				                    }
				                });
				            },
				            resizeIframe: function() {
				                $(this.dialog).find('iframe').height($(this.dialog).height() - 30);
				                $(this.dialog).find('iframe').width($(this.dialog).width());
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
								['tentacleMediaLibrary'],
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