<div class="card row mt-2">
    <div class="card-header">
        <div class="card-title">Shipment Package</div>
    </div>

</div>
<div class="card-body row col-12">
    <div class="card-body p-0">
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th style="width: 10px">S.n</th>
                    <th>Particular</th>
                    <th>Service</th>
                    <th>AWB/MBL/HBL No</th>
                    <th>AWB/MBL/HBL Date</th>
                    <th>Consignee</th>
                    <th>Destination</th>
                    <th>PCS(KGS)</th>
                    <th>Weight(KGS)</th>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="generateAwb">
                @foreach ($invoice->awbs as $key => $item)
                    <tr>
                        <td class="serialNumber"></td>
                        <td><input type="text" class="form-control text-capitalize" style="min-width:200px;" name="particulars[]"
                                value="{{ $item->particulars ?? $invoice::PARTICULAR[0] }}"></td>
                        <td style="min-width:200px;"> {!! Form::select('service[]', $invoice::SERVICES, $item->service, ['class' => 'form-control']) !!}</td>
                        <td><input type="text" class="form-control text-capitalize" name="awbNumber[]"
                                value="{{ $item->awbNumber }}"></td>
                        <td><input type="text" class="form-control" name="awbDate[]" value="{{ $item->awbDate }}">
                        </td>
                        <td><input type="text" class="form-control" name="consignee[]"
                            value="{{ $item->consignee }}"></td>
                        <td><input type="text" class="form-control" name="destination[]"
                                value="{{ $item->destination }}"></td>
                        <td><input type="text" class="form-control pcs" name="pcs[]" value="{{ $item->pcs }}"></td>
                        <td><input type="text" class="form-control weight" name="weight[]"
                                value="{{ $item->weight }}"></td>
                        <td><input type="text" class="form-control rate" name="rate[]" value="{{ $item->rate }}"></td>
                        <td><input type="text" class="form-control amount" name="amount[]" readonly
                                value="{{ $item->amount }}"></td>
                        <td><button class='view-btn deleteRow'><i class="fas fa-trash"></i></button></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="text-bold">
                    <td colspan="7" class="text-right">
                        <span class="text-right"> Total</span>
                    </td>
                    <td>
                        <span id="totalPcs">0</span>
                    </td>
                    <td>
                        <span id="totalWeight">0</span>
                    </td>
                    <td>
                        <span id="totalRate">0</span>
                    </td>
                    <td>
                        <span id="totalAmount">0</span>
                    </td>
                    <td>
                        <button id="addRow" type="button" class="view-btn"><i class="fas fa-plus"></i></button>
                    </td>

                </tr>
            </tfoot>
        </table>
    </div>
</div>

@push('scripts')
    <script>
        var template = `<tr>
                            <td class='serialNumber'></td>
                            <td><input type="text" class="form-control text-capitalize" name="particulars[]"
                                    value="{{ $invoice::PARTICULAR[0] }}"></td>
                            <td> {!! Form::select('service[]', $invoice::SERVICES, 1, ['class' => 'form-control text-capitalize']) !!}</td>
                            <td><input type="text" class="form-control" name="awbNumber[]"></td>
                            <td><input type="text" class="form-control" name="awbDate[]"></td>
                            <td><input type="text" class="form-control" name="consignee[]"></td>
                            <td><input type="text" class="form-control" name="destination[]"></td>
                            <td><input type="text" class="form-control pcs" name="pcs[]"></td>
                            <td><input type="text" class="form-control weight" name="weight[]"></td>
                            <td><input type="text" class="form-control rate" name="rate[]"></td>
                            <td><input type="text" class="form-control amount" name="amount[]"  readonly></td>
                            <td><button class='view-btn deleteRow'><i class="fas fa-trash"></i></button></td>
                        </tr>`;

        $(document).ready(function() {
            if ($('#generateAwb tr').length == 0) {
                $('#generateAwb').append(template);
            }
            $('#addRow').on('click', function(e) {
                e.preventDefault();
                $('#generateAwb').append(template);
            });

        });
        $(document).on('click', '.deleteRow', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        })

        $(document).on('input', '.pcs,.weight,.rate', function(e) {
            rate = $(this).closest("tr").find(".rate").val();
            weight = $(this).closest("tr").find(".weight").val();
            $(this).closest("tr").find(".amount").val(Math.floor(rate * weight ));
        });



        function getTotal(selector) {
            let totalValue = 0;
            $(selector).each(function() {
                if (this.value !== '') {
                    totalValue += parseFloat(this.value);

                }
            })
            return totalValue;
        }
        setInterval(() => {
            $('#totalPcs').text(getTotal('.pcs'));
            $('#totalWeight').text(getTotal('.weight'));
            $('#totalRate').text(getTotal('.rate'));
            $('#totalAmount').text(getTotal('.amount'));
        }, 500);
    </script>
@endpush

@push('styles')
    <style>
        body {
            counter-reset: Serial;
        }

        tr td.serialNumber:first-child:before {
            counter-increment: Serial;
            /* Increment the Serial counter */
            content: counter(Serial);
            /* Display the counter */
        }

    </style>
@endpush
