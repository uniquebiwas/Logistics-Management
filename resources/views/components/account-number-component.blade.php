<div class="form-group row">
    {{ Form::label('agentId', 'Select Agent', ['class' => 'col-md-4 text-capitalize form-control-sm ']) }}
    {!! Form::select('agentId', $allComponentAgent, old('agentId') ?? ($agentId ?? auth()->id()), ['class' => 'form-control form-control-sm col-md-6', 'id' => 'agentId', 'placeholder' => 'Select Agent', 'required' => true]) !!}
</div>
<input type="hidden" name="account_number" id="account_number" class="form-control form-control-sm col-md-6"
    value="{{ old('account_number') }}">
{{-- <input type="hidden" name="senderName" id="senderName" class="form-control form-control-sm col-md-6" value=""> --}}
@push('scripts')
    <script>
        $('#agentId').on('change', function() {
            var userId = $(this).val();
            if (!userId) {
                return null;
            }
            axios.post("{{ route('getSingleAgent') }}", {
                    'userId': userId,
                    _token: "{{ csrf_token() }}",
                }).then(function(response) {

                    $('#account_number').val(response.data.accountNumber);
                    $('#billing_account').val(response.data.billing_account);
                    $('#agentId').val(response.data.agentId);
                })
                .catch(function(error) {
                    toastr.error('error!', 'Error Occour')
                });
        })
    </script>
@endpush
