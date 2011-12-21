/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

jQuery(document).ready(function () {
	ckeditorSettings.configuration['on'] = {
		configLoaded : function ( evt ) {
			if (typeof(ckeditorSettings.externalPlugins) != 'undefined') {
				var externals=new Array();
				for(var x in ckeditorSettings.externalPlugins) {
					CKEDITOR.plugins.addExternal(x, ckeditorSettings.externalPlugins[x]);
					externals.push(x);
				}
			}
			evt.editor.config.extraPlugins += (evt.editor.config.extraPlugins ? ','+externals.join(',') : externals.join(','));
			if (typeof(ckeditorSettings.additionalButtons) != 'undefined') {
				for (var x in ckeditorSettings.additionalButtons) {
					evt.editor.config['toolbar_' + evt.editor.config.toolbar].push(ckeditorSettings.additionalButtons[x]);
				}
			}
		}
	}
	CKEDITOR.on( 'instanceReady', function( ev )
	{
		var dtd = CKEDITOR.dtd;
		for ( var e in CKEDITOR.tools.extend( {}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent ) )
		{
			ev.editor.dataProcessor.writer.setRules( e, ckeditorSettings.outputFormat);
		}
		ev.editor.dataProcessor.writer.setRules( 'br',
			{
				breakAfterOpen : true
			});
		ev.editor.dataProcessor.writer.setRules( 'pre',
			{
				indent: false
			});
	});

	if(ckeditorSettings.textarea_id != 'comment'){
		edInsertContentOld = function () { return ; };
		if(typeof(window.edInsertContent) != 'undefined'){
			edInsertContentOld = window.edInsertContent;
		}
		window.edInsertContent = function (myField, myValue) {
			if(typeof(CKEDITOR) != 'undefined' && typeof(CKEDITOR.instances[ckeditorSettings.textarea_id]) != 'undefined'){
				CKEDITOR.instances[ckeditorSettings.textarea_id].insertHtml(myValue);
			} else {
				edInsertContentOld(myField, myValue);
			}
		}
		var autosaveOld = function () { return ; };
		if(typeof(window.autosave) != 'undefined'){
			autosaveOld = window.autosave;
		}
		window.autosave = function () {
			if(typeof(CKEDITOR) != 'undefined' && typeof(CKEDITOR.instances[ckeditorSettings.textarea_id]) != 'undefined'){
				CKEDITOR.instances[ckeditorSettings.textarea_id].updateElement();
			}
			autosaveOld();
		}
		if(typeof(window.switchEditors) != 'undefined') {
			window.switchEditors.go = function(id, mode) {
				if ('tinymce' == mode) {
					ckeditorOn();
				} else {
					ckeditorOff();
				}
			}
		}
	}

	if ( ckeditorSettings.qtransEnabled ){

		jQuery('#edButtonHTML').addClass('active');
		jQuery('#edButtonPreview').removeClass('active');

		if(ckeditorSettings.textarea_id != 'comment'){

			ckeditorSettings.textarea_id = 'qtrans_textarea_content';
			ckeditorSettings.configuration['on'].getData = function (evt) {
				evt.data.dataValue = evt.data.dataValue.replace(/(^<\/p>)|(<p>$)/g, '');
				evt.data.dataValue = evt.data.dataValue.replace(/^<p>(\s|\n|\r)*<p>/g, '<p>');
				evt.data.dataValue = evt.data.dataValue.replace(/<\/p>(\s|\n|\r)*<\/p>(\s|\n|\r)*$/g, '<\/p>');
				qtrans_save(evt.data.dataValue);
			}
			window.tinyMCE = (function () {
				var tinyMCE = {
					get : function (id) {
						var instant = {
							isHidden : function () {
								if(typeof(CKEDITOR.instances[ckeditorSettings.textarea_id]) != 'undefined'){
									return false;
								} else {
									return true;
								}
							},
							execCommand : function (command, int, val) {
								if(command == 'mceSetContent') {
									CKEDITOR.instances[ckeditorSettings.textarea_id].setData(val);
								}
							},
							onSaveContent : {
									add : function (func) {
										window.tinymceosc = func;
									}
							},
							getContentAreaContainer : function () {
								return {
									offsetHeight : CKEDITOR.instances[ckeditorSettings.textarea_id].config.height
								}
							},
							hide : function () {
								ckeditorOff();
							},
							show : function () {
								ckeditorOn();
							}
						}
						return instant;
					},
					execCommand : function (command, int, val) {
						if(command == 'mceAddControl'){
							ckeditorSettings.textarea_id = val;
							if(ckeditorSettings.autostart) {
								ckeditorOn();
							} else {
								document.getElementById('qtrans_textarea_content').removeAttribute('style');
							}
						}
					},
					triggerSave : function(param) {
						CKEDITOR.instances[ckeditorSettings.textarea_id].updateElement();
					}

				}

				return tinyMCE;
			})();
		}

	}
	else {
		if(ckeditorSettings.autostart && (typeof getUserSetting == 'undefined' || getUserSetting('editor') == 'tinymce')){
			ckeditorOn();
		}

	}

});

function ckeditorOn() {
	if ( jQuery('#'+ckeditorSettings.textarea_id).length && (typeof(CKEDITOR.instances) == 'undefined' || typeof(CKEDITOR.instances[ckeditorSettings.textarea_id]) == 'undefined' )) {
		CKEDITOR.replace(ckeditorSettings.textarea_id, ckeditorSettings.configuration);
		if(ckeditorSettings.textarea_id == 'content') {
			setUserSetting( 'editor', 'tinymce' );
			jQuery('#quicktags').hide();
			jQuery('#edButtonPreview').addClass('active');
			jQuery('#edButtonHTML').removeClass('active');
		}
                else if(ckeditorSettings.textarea_id == 'comment') {
                        var labelObj = jQuery('#'+ckeditorSettings.textarea_id).prev('label');
                        if (labelObj){
                            labelObj.hide();
                        }
                }
	}
}

function ckeditorOff() {
	if(typeof(CKEDITOR.instances[ckeditorSettings.textarea_id]) != 'undefined'){
		CKEDITOR.instances[ckeditorSettings.textarea_id].destroy();
		if(ckeditorSettings.textarea_id == 'content') {
			setUserSetting( 'editor', 'html' );
			jQuery('#quicktags').show();
			jQuery('#edButtonHTML').addClass('active');
			jQuery('#edButtonPreview').removeClass('active');
		}
	}
}
