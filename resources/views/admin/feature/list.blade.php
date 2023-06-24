@extends('layouts.admin')
@section('title', 'Services')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Services List</h3>
                    <div class="card-tools">
                        <a href="{{ route('feature.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body search-body">
                    <div class="row">
                        <div class="p-1 col-lg-8">
                            <form action="" class="">
                                <div class=" row">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4">
                                    <button class="view-btn"><i class="fa fa fa-search"></i></button>
                                </div>
                        </div>
                        </form>
                    </div>
                    <div class="p-1 col-lg-4">
                        <div class="card-tools float-right">
                            @can('feature-create')
                                <a href="{{ route('feature.create') }}" class="global-btn">
                                    <i class="fa fa-plus"></i> Add New Service</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div style="overflow-x: scroll" class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">S.N</th>
                            <th>Title</th>
                            <th>Featured Image</th>
                            <th>Status</th>
                            <th style="text-align:center;" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tablecontents">
                        @foreach ($data as $key => $value)
                            <tr class="row1" data-id="{{ $value->id }}">
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $value->title }}</td>
                                <td>
                                    <img src="{{ @$value->feature_image }}" alt="{{ @$value->title }}"
                                        class="img img-thumbail" style="width:60px">
                                </td>


                                <td>
                                    <span class="badge badge-{{ $value->publish_status == '1' ? 'success' : 'danger' }}">
                                        {{ $value->publish_status == '1' ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="btn-group">
                                        @can('feature-edit')
                                            <a href="{{ route('feature.edit', $value->id) }}" title="Edit Service"
                                                class="view-btn mr-1"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('feature-delete')
                                            {{ Form::open(['method' => 'DELETE', 'route' => ['feature.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this Service?")']) }}
                                            {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Delete Feature ']) }}
                                            {{ Form::close() }}
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="text-sm">
                                Showing <strong>{{ $data->firstItem() }}</strong> to
                                <strong>{{ $data->lastItem() }} </strong> of <strong>
                                    {{ $data->total() }}</strong>
                                entries
                                <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to
                                    render</span>
                            </p>
                        </div>
                        <div class="col-md-8">
                            <span class="pagination-sm m-0 float-right">{{ $data->links() }}</span>
                        </div>
                    <button class="global-btn text-capitalize" onclick="window.location.reload()"><b>Update Position</b></button>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@push('scripts')

  <!-- jQuery UI -->
  <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>

  <!-- Datatables Js-->
  {{-- <script type="text/javascript" src="//cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script> --}}

  <script type="text/javascript">
  $(function () {
    // $("#table").DataTable();

    $( "#tablecontents" ).sortable({
      items: "tr",
      cursor: 'move',
      opacity: 0.6,
      update: function() {
          sendOrderToServer();
      }
    });

    function sendOrderToServer() {

      var position = [];
      $('tr.row1').each(function(index,element) {
        position.push({
          id: $(this).attr('data-id'),
          position: index+1
        });
      });

      $.ajax({
        type: "POST",
        dataType: "json",
        url: "{{ route('updateOrderFeature') }}",
        data: {
          position:position,
          _token: '{{csrf_token()}}'
        },
        success: function(response) {
            if (response.status == "success") {
              console.log(response);
            } else {
              console.log(response);
            }
        }
      });

    }
  });

</script>

@endpush
