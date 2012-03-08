//<![CDATA[
	ckeditorSettings = { 	
		"textarea_id": "cke",  
		"autostart": true, 
		"outputFormat": { 
			"indent": true, 
			"breakBeforeOpen": true, 
			"breakAfterOpen": false, 
			"breakBeforeClose": false, 
			"breakAfterClose": true 
		}, 
		"externalPlugins": { 
			"wpmore": "plugins/wpmore/",
			"atd-ckeditor": "plugins/atd-ckeditor/",
			"autogrow": "plugins/autogrow/",
			"tableresize": "plugins/tableresize/",
			"stylesheetparser": "plugins/stylesheetparser/",
		},
		"configuration": {
			"height": "400px", 
			"skin": "tentacle", 
			"toolbar": "tentacle", 
			"removePlugins": "elementspath",
			"autoGrow_maxHeight": 800,
			"autoGrow_minHeight": 400,
			"customConfig": "ckeditor.config.js"
		}
	}
	CKEDITOR.on('instanceReady', function (ev) {
		if(ev.editor.name == 'tentacle-editor'){
			ckeditorOn();
		}
	});
	window.edInsertContent = function (myField, myValue) {
		if(typeof(CKEDITOR) != 'undefined' && typeof(CKEDITOR.instances[ckeditorSettings.textarea_id]) != 'undefined'){
			CKEDITOR.instances[ckeditorSettings.textarea_id].insertHtml(myValue);
		}
	}
//]]>