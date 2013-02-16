var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
    lineNumbers: true,
    theme: "default",
    mode: "text/html",
    lineWrapping: true,
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