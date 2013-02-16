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
                icon: 'ui-icon-media-modal',
                click: function() {
                    this.show();
                    //$('#myModal').reveal();
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
                minWidth: 780,
                minHeight: 575,
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
        ['tentacleMediaLibrary']
    ],
    disabledPlugins: ['unsavedEditWarning'],
    plugins: {
        dock: {
            docked: true,
            dockToElement: true,
            persist: false
        },
        placeholder: {
            content: ''
        }
    }
});