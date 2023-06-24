 

@if(session('success'))
<div class="successmessage messagebox alert alert-success">
    <p><i class=" fa fa-check"></i> {{session('success')}} <i class="fa fa-close remove_icon"></i></p>
</div>

@endif
@if(session('error'))
<div class="errormessage messagebox alert alert-info">
    <p><i class=" fa fa-check"></i> {{session('error')}} <i class="fa fa-close remove_icon"></i></p>
</div>

@endif
@if(session('warning'))

<div class="warningmessage messagebox alert alert-warning">
    <p><i class=" fa fa-times"></i> {{session('warning')}} <i class="fa fa-close remove_icon"></i></p>
</div>
@endif
@if(session('danger'))

<div class="dangermessage messagebox alert alert-danger" >
    <p><i class=" fa fa-times"></i> {{session('danger')}} <i class="fa fa-close remove_icon"></i></p>
</div>
@endif
 

<script>
    setTimeout(function() {
        $('.messagebox').slideUp('slow');
    }, 12000);
</script>