@extends('layouts.front')
@section('page_title', 'Air Logistics Group')
@section('meta')
    @include('website.pages.meta')
@endsection
@section('content')
    @include('website.index.slider')
    @include('website.index.welcome')
    @include('website.index.about')
    @include('website.index.newsboard')
    @include('website.index.content')
    {{-- @include('website.index.popular_article') --}}
    {{-- @include('website.index.gallery') --}}
    @include('website.index.logo')
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $("#getPrice").submit(function(e) {
                console.log('here2');
                $('#price').addClass('d-none');
                e.preventDefault();
                $(this).prop("disabled", true);
                if (!$('#to').val()) {
                    toastr.error('Please select destination country')
                    return null;
                }
                if (!$('#integrator').val()) {
                    toastr.error('Please select integrator')
                    return null;
                }
                if (!$('#weight').val()) {
                    toastr.error('Please enter weight')
                    return null;
                }
                var data = {
                    _token: "{{ csrf_token() }}",
                    to: $('#to').val(),
                    from: $('#from').val(),
                    integrator: $('#integrator').val(),
                    weight: $('#weight').val(),
                    agentId: 2,
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
                        document.getElementById("resultprice").innerHTML = res.price;
                        document.getElementById("resultweight").innerHTML = res.weight;

                    },
                    error: function(result, status, err) {
                        console.log(result.responseJSON.message);
                        toastr.options.closeButton = true;
                        toastr.error(result.responseJSON.message);
                    },

                });
            });
        });
    </script>
@endpush
