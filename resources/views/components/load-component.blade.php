<button id="loadShipment" class="global-btn">Today's Load Planning</button>
@push('scripts')
    <script>
        const getSelectedShipment = function() {
            var val = [];
            $('.checked:checked').each(function() {
                val.push($(this).val());
            })
            return val;
        }
        const loadShipment = function() {
            var allShipment = getSelectedShipment();
            if (allShipment.length == 0) {
                return toastr.error('error!', 'Select At least one AWB to load');
            }
            const url = "{{ route('load.store') }}";

            axios({
                method: 'post',
                url: url,
                data: {
                    'shipmentId': allShipment,
                }
            }).then((response) => {
                toastr.success('success!', response.data.message);
                setTimeout(location.reload(), 2000);
            }).catch(function(error) {
                if (error.response) {
                    error.response.data.message.forEach(element => {
                        toastr.error('Error!', element)
                    });
                }
            });

        }

        $('#loadShipment').on('click', loadShipment)
    </script>
@endpush
