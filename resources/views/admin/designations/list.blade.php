@extends('layouts.admin')
@section('title', 'Designations')
@push('scripts')
    <script src="{{ asset('plugins/sortablejs/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/sortablejs/jquery.mjs.nestedSortable.js') }}"></script>
    <script src="{{ asset('plugins/toastrjs/toastr.min.js') }}"></script>
    <script>
        $('ol.sortable').nestedSortable({
            forcePlaceholderSize: true,
            placeholder: 'placeholder',
            handle: 'div.menu-handle',
            helper: 'clone',
            items: 'li',
            opacity: .6,
            maxLevels: {{ env('MENU_LEVEL', 3) }},
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
        });
        $("#serialize").click(function(e) {
            e.preventDefault();
            $(this).prop("disabled", true);
            $(this).html(
                `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Updating...`
            );
            var serialized = $('ol.sortable').nestedSortable('serialize');
            //console.log(serialized);
            $.ajax({
                url: "{{ route('update.designation') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    sort: serialized
                },
                success: function(res) {
                    //location.reload();
                    toastr.options.closeButton = true
                    toastr.success('Menu Order Successfuly', "Success !");
                    $('#serialize').prop("disabled", false);
                    $('#serialize').html(`<i class="fa fa-save"></i> Update Menu`);
                }
            });
        });

        function show_alert() {
            if (!confirm("Do you really want to do this?")) {
                return false;
            }
            this.form.submit();
        }
    </script>
@endpush
@push('styles')
    <style>
        ol {
            list-style-type: none;
        }

        .menu-handle {
            display: block;
            margin-bottom: 5px;
            padding: 6px 4px 6px 12px;
            color: #333;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            cursor: move;
        }

        .menu-handle:hover {
            color: #2ea8e5;
            background: #fff;
        }

        .placeholder {
            outline: 1px dashed #4183C4;
            margin-bottom: 10px;
            background: #D7F8FD
        }

    </style>
@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Designations List</h3>
                    <div class="card-tools">
                        <a href="{{ route('designations.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body search-body">
                    <div class="row">
                        <div class="p-1 col-lg-2">
                            <div class="btn-group">
                                <a href="{{ route('designations.index') }}" class="view-btn">
                                    <i class="fas fa-sync-alt fa-sm"></i> Refresh
                                </a>
                            </div>
                        </div>
                        <div class="p-1 col-lg-7">
                            <form action="" class="">
                                <div class=" row" style="align-items: center;">
                                <div class="p-1 col-lg-4 col-md-4 col-sm-4">
                                    {{ Form::open(['url' => route('designations.index'), 'files' => true, 'class' => 'form', 'name' => 'designations_form']) }}
                                    {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4">
                                    <button class="global-btn"><i class="fa fa fa-search"></i>
                                        Filter
                                    </button>
                                </div>
                                {{ Form::close() }}
                        </div>
                        </form>
                    </div>
                    <div class="p-1 col-lg-3">
                        <div class="card-tools">
                            @can('designation-create')
                                <a href="{{ route('designations.create') }}" class="global-btn">
                                    <i class="fa fa-plus"></i> Add New Designation</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body card-format">
                @if ($data->count() > 0)
                    <ol class="sortable" style="padding-left:0;">
                        @foreach ($data as $item)
                            @if ($item->parent_id == null)
                                <li id="designationItem_{{ $item->id }}">
                                    <div class="menu-handle d-flex justify-content-between">
                                        <span>
                                            <i class="fa fa-arrows-alt"></i> &nbsp;
                                            @if ($_website == 'Nepali' || $_website == 'Both')
                                                {{ $item->title['np'] }}
                                            @endif
                                            @if ($_website == 'English' || $_website == 'Both')
                                                {{ $item->title['en'] }}
                                            @endif
                                        </span>
                                        <div class="menu-options btn-group">

                                            @canany('designation-edit', 'designation-update')
                                                <a href="{{ route('designations.edit', $item->id) }}" class="view-btn mr-1">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcanany
                                            @can('designation-delete')
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['designations.destroy', $item->id], 'class' => 'display:hidden', 'id' => $item->id, 'onsubmit' => 'return confirm("Are you sure you want to delete this User?")']) }}

                                                {{ Form::button('<i class="fas fa-trash"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Delete Menu', 'onclick' => 'if(!confirm("Do you really want to delete this?")){return false}else{ document.getElementById(' . $item->id . ').submit()}']) }}
                                            {{ Form::close() }} @endcan
                                        </div>
                                    </div>

                                </li>
                            @endif
                        @endforeach
                        <div class="form-group mt-4">
                            @canany(['designation-create', 'designation-edit'])
                                <button type="button" class="global-btn mr-2" id="serialize"><i
                                        class="fa fa-save"></i>
                                    Update designation
                                </button>
                            @endcanany
                            <a href="{{ route('designation.resetorder') }}" type="button" class="global-btn"><i
                                    class="fas fa-sync-alt"></i> Reset Order</a>
                        </div>
                    </ol>
                @else
                    <p class="text-center">Designation Found in Database</p>
                @endif
            </div>

        </div>
        </div>
    </section>
@endsection
