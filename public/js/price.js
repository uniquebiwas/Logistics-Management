const getPrice   =  function(from,integrator,weight,agentId) {
    $(this).prop("disabled", true);
    if (!$('#to').val()) {
    var data = {
        _token:$('meta[name="csrf-token"]').attr('content'),
        agentId:agentId,
        from:from,
        integrator: integrator,
        weight: weight,
    };
    $.ajax({
        method: "POST",
        url: "{{ route('searchPrice') }}",
        data: JSON.stringify(data),
        processData: false,
        contentType: "application/json; charset=utf-8",
        success: function(res) {
            console.log(res.price);
            toastr.success(res.message[0]);
            $('#price').removeClass('d-none');
            document.getElementById("axiosPrice").innerHTML = res.price;
        },
        error: function(result, status, err) {
            console.log(result.responseJSON.message);
            toastr.options.closeButton = true;
            toastr.error(result.responseJSON.message);
        },

    });
