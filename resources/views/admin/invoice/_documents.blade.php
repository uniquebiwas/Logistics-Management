<!-- Button trigger modal -->
<button type="button" class="view-btn" data-toggle="modal" data-target="#{{ 'modal-' . $value->invoiceNumber }}">
    <i class="fas fa-eye    "></i>
</button>

<!-- Modal -->
<div class="modal fade" id="{{ 'modal-' . $value->invoiceNumber }}" tabindex="-1" role="dialog"
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">#{{ $value->invoiceNumber }} Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    @forelse ($value->invoiceDocument as $item)
                    <a href="{{ $item->document }}">
                        {!! getEventProgramFileThumb(asset($item->document)) !!}
                    </a>
                    @empty
                        <span>No supporting Documents found</span>
                    @endforelse

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="view-btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

</script>
