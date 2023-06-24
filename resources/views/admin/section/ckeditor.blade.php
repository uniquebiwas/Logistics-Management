
<script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
{{-- <script src="{{ asset('/ckeditor/plugins/image2/image2/plugins.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('/assets/image_upload/js/laravel-file-manager-ck-editor-user.js') }}"></script>
<script>
    if($("#np_short_description").length){
        ckeditor('np_short_description', 200);
    }
    if($("#en_short_description").length){
        ckeditor('en_short_description', 200);
    }
    if($("#en_description").length){
        ckeditor('en_description', 200);
    }
    if($("#np_description").length){
        ckeditor('np_description', 00);
    }
    // CKEDITOR.replace('my-editor', {
    //     filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
    //     filebrowserUploadMethod: 'form'
    // });

    // CKEDITOR.replace('my-editor1', {
    //     filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
    //     filebrowserUploadMethod: 'form'
    // });

</script>
<style>
    /* .cke_browser_webkit {
        width: 80%;
    } */
</style>
 
 
<script>

	
// 	var options = {
//     filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
//     filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
//     filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
//     filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
//   };
//     CKEDITOR.replace('description', options);
//     CKEDITOR.config.height = 200;
//     CKEDITOR.config.extraPlugins = 'html5audio';
//     CKEDITOR.config.colorButton_colors = 'CF5D4E,454545,FFF,CCC,DDD,CCEAEE,66AB16';
//     CKEDITOR.config.colorButton_enableMore = true;
//     CKEDITOR.config.floatpanel = true;
//     CKEDITOR.config.panel = true;
//     CKEDITOR.config.extraPlugins = 'image2';
//     CKEDITOR.config.removeButtons = 'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,CreateDiv,BidiLtr,BidiRtl,Language,PageBreak,Font,Styles,Format,ShowBlocks,About';

   
</script>
 
