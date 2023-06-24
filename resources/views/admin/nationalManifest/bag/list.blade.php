@extends('layouts.admin')
@section('title', 'Baggage List')

@section('content')
    <section class="content-header pt-0"></section>
    <section class="content create-bag">
        <div class="container-fluid">
            <div class="b-noti-col">
                <div class="b-noti-btn">
                    <div class="b-noti-left common-btns">
                        <a name="" id="" class="global-btn" href="{{ route('bag.create') }}" role="button">
                            <i class="fas fa-shopping-bag"></i>create bag
                        </a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Baggage</h3>

                </div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class='row'>
                            <div class="col-lg-4">
                                {!! Form::select('type', ['national' => 'national', 'international' => 'international'], request()->type, ['class' => 'form-control form-control-sm']) !!}
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="view-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div style="overflow-x: scroll" class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Bag Name</th>
                                <th>Assigned To Manifest</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bag as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->title }}</td>

                                    <td>
                                        @if ($item->nationalManifestNumber || $item->internationalManifestNumber)
                                            <span class="badge badge-pill badge-success">Assigned</span>
                                        @else
                                            <span class="badge badge-pill badge-info">Not Assigned</span>

                                        @endif
                                    </td>
                                    <td>{{ $item->type }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @can('bag-edit')
                                                <a title="edit Bag" id="" class="view-btn mr-1"
                                                    href=" {{ route('bag.edit', $item->id) }} ">
                                                    <i class="fas fa-edit    "></i>
                                                </a>
                                            @endcan
                                            @can('bag-show')
                                                <a title="show Bag" id="" class="view-btn mr-1"
                                                    href=" {{ route('bag.show', $item->id) }} ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('bag-delete')
                                                {!! Form::open(['url' => route('bag.destroy', $item->id), 'onsubmit' => 'return confirm("Are you sure you want to delete this bag?")']) !!}
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="view-btn">
                                                    <i class="fas fa-trash    "></i>
                                                </button>
                                                {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
