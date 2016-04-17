var editor = ace.edit("editor");
editor.setFontSize(16);
editor.setTheme("ace/theme/crimson_editor");
editor.getSession().setMode("ace/mode/html");

$(function() {

    $('#create-post').on('submit', function (e) {
        $('#create-page-page').val(editor.getValue());
    });

    $('.code-editor-wrapper').resize(function() {
        $('#editor').height($(this).height());
        editor.resize();
    });
});
