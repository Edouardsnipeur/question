$(function () {
    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime  nonbreaking save  contextmenu directionality',
            'template paste textcolor colorpicker textpattern'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
        toolbar2: 'print preview | forecolor backcolor',
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '../../../backend/plugins/tinymce';
});