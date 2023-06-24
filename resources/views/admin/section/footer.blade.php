</div>
{{-- <script src="{{ asset('/assets/front/js/jquery.min.js') }}" type="text/javascript"></script> --}}
<script src="{{ asset('js/manifest.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/vendor.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/admin.js') }}" type="text/javascript"></script>
{{-- <script src="//{{ Request::getHost() }}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        $('input[name="startDate"],input[name="endDate"],input[type="date"]').each(function(index) {
            this.setAttribute('data-date', '');
            $(this).prop('type', 'text');
            $(this).attr("placeholder", "dd/mm/YYYY");
            $(this).on('focus', function() {
                $(this).prop('type', 'date');
            })

        });
        $('[data-date]').on("change", function() {
            console.log(this);
            this.setAttribute('data-date', '');
            this.setAttribute('placeholder', 'DD/MM/YYYY');
            if (this.value) {
                this.setAttribute(
                    "data-date",
                    moment(this.value, "YYYY-MM-DD")
                    .format('DD/MM/YYYY')
                )
            }

        }).trigger("change");



    })
</script>
@livewireScripts
@stack('scripts')
</body>

</html>
