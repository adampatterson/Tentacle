</div>
<!-- #body-wrapper -->
<? //render_debug(); ?>
<footer class="footer">
<div class="navbar-fixed-bottom">
	<div class="navbar-inner">
		<div class="navbar navbar-fixed-bottom" style="position: absolute;">
			<div class="navbar-inner">
				<div class="container" style="width: auto; padding: 0 20px;">
					<ul class="nav">
						<li><a href="https://github.com/adampatterson/Tentacle/wiki" target="_blank">Documentation</a></li>
						<li><a href="https://github.com/adampatterson/Tentacle/issues">Feedback</a></li>
						<li><a href="https://github.com/adampatterson/Tentacle/wiki/Credits">Credits</a></li>
						<li><p><? upgrade::check_core_version_footer(); ?></p></li>
					</ul>
					<ul class="nav pull-right">
						<li><p><small>Thanks for creating with<small> <a href="http://tentaclecms.com"><img src="<?= ADMIN_URL.'/images/tentacle_logo_footer.png' ?>" alt="Tentacle CMS" /></a></p></li>
					</ul>
				</div>
			</div>
		</div>	
	</div>
</div>
</footer>
<? if(user_editor() == 'wysiwyg'): ?>

    <script type="text/javascript" src="<?= ADMIN_JS; ?>raptor/raptor.0deps.js"></script>
	<link rel="stylesheet" href="<?= ADMIN_JS; ?>raptor/theme.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<style type="text/css" media="screen">
        .ui-widget-content  .ui-icon-fancy-modal {
            background-image: url(http://www.winsteps.com/blahdocs/images/smiley.gif);
        }
    </style>
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
                    this.dialog = $('<div style="display:none"><iframe src="<?= ADMIN ?>/media_insert" /></div>').appendTo('body');
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


        $('.wysiwyg textarea').editor({
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
                ['embed', 'viewSource', 'clearFormatting', 'clean'],
                ['tagMenu'],
                ['undo', 'redo'],
                ['tentacleMediaLibrary'],
            ],
            plugins: {
                dock: {
                    docked: true,
                    dockToElement: true,
                    persist: false
                }
            }
        });
    </script>
<? else: ?>
	<link rel="stylesheet" href="<?=ADMIN_JS; ?>CodeMirror/lib/codemirror.css">
	<script src="<?=ADMIN_JS; ?>CodeMirror/lib/codemirror.js"></script>
	<script src="<?=ADMIN_JS; ?>CodeMirror/mode/xml/xml.js"></script>
	<script src="<?=ADMIN_JS; ?>CodeMirror/mode/css/css.js"></script>
	<script src="<?=ADMIN_JS; ?>CodeMirror/mode/javascript/javascript.js"></script>
	<script src="<?=ADMIN_JS; ?>CodeMirror/mode/clike/clike.js"></script>
	<script src="<?=ADMIN_JS; ?>CodeMirror/mode/php/php.js"></script>
	<script src="<?=ADMIN_JS; ?>CodeMirror/mode/htmlmixed/htmlmixed.js"></script>
	
	<script>
		var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
			lineNumbers: true,
			theme: "default",
			mode: "text/html",
			onCursorActivity: function() {
				editor.setLineClass(hlLine, null);
				hlLine = editor.setLineClass(editor.getCursor().line, "activeline");
			},
			onKeyEvent: function(cm, e) {
				// Hook into ctrl-space
			if (e.keyCode == 32 && (e.ctrlKey || e.metaKey) && !e.altKey) {
				e.stop();
				return CodeMirror.simpleHint(cm, CodeMirror.javascriptHint);
				}
			}
		});
		var hlLine = editor.setLineClass(0, "activeline");
	</script>
<? endif; ?>

<? if( in_array('jupload', $assets ) ): ?>
		
		<!-- The Templates plugin is included to render the upload/download listings -->
		<script src="http://blueimp.github.com/JavaScript-Templates/tmpl.min.js"></script>
		<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
		<script src="http://blueimp.github.com/JavaScript-Load-Image/load-image.min.js"></script>
		<!-- The Canvas to Blob plugin is included for image resizing functionality -->
		<script src="http://blueimp.github.com/JavaScript-Canvas-to-Blob/canvas-to-blob.min.js"></script>
		<!-- Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo -->
		<script src="http://blueimp.github.com/Bootstrap-Image-Gallery/js/bootstrap-image-gallery.min.js"></script>
		<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
		<script src="<?= ADMIN_JS ?>jQuery-File-Upload/jquery.iframe-transport.js"></script>
		<!-- The basic File Upload plugin -->
		<script src="<?= ADMIN_JS ?>jQuery-File-Upload/jquery.fileupload.js"></script>
		<!-- The File Upload image processing plugin -->
		<script src="<?= ADMIN_JS ?>jQuery-File-Upload/jquery.fileupload-fp.js"></script>
		<!-- The File Upload user interface plugin -->
		<script src="<?= ADMIN_JS ?>jQuery-File-Upload/jquery.fileupload-ui.js"></script>
		<!-- The localization script -->
		<script src="<?= ADMIN_JS ?>jQuery-File-Upload/locale.js"></script>
		<!-- The main application script -->
		<script src="<?= ADMIN_JS ?>jQuery-File-Upload/main.js"></script>
		<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
		<!--[if gte IE 8]><script src="<?= ADMIN_JS ?>jQuery-File-Upload/js/cors/jquery.xdr-transport.js"></script><![endif]-->

<? endif; ?>

	<script type="text/javascript" src="<?=ADMIN_JS; ?>application.js"></script>

	<!-- begin olark code --><script data-cfasync="false" type='text/javascript'>/*{literal}<![CDATA[*/
	window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){f[z]=function(){(a.s=a.s||[]).push(arguments)};var a=f[z]._={},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={0:+new Date};a.P=function(u){a.p[u]=new Date-a.p[0]};function s(){a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{b.contentWindow[g].open()}catch(w){c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{var t=b.contentWindow[g];t.write(p());t.close()}catch(x){b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
	/* custom configuration goes here (www.olark.com/documentation) */
	olark.identify('6479-579-10-4369');/*]]>{/literal}*/</script><noscript><a href="https://www.olark.com/site/6479-579-10-4369/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
	<!-- end olark code -->

<!-- 
<?
	echo shell_exec('git status'); 
?>
-->

</body>
</html>
