@extends('layouts.admin')
@section('title', 'News List')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">News List</h3>
                    <div class="card-tools">
                        <a href="{{ route('blog.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="p-1 col-lg-2">
                            <div class="btn-group">
                                <a href="{{ route('news.index') }}" class="btn btn-primary btn-flat btn-sm">
                                    <i class="fas fa-sync-alt fa-sm"></i> Refresh
                                </a>
                            </div>
                        </div>
                        <div class="p-1 col-lg-6">
                            <form action="" class="">
                                <div class="row">
                                    <div class="p-1 col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search News']) !!}
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-4">
                                        <button class="btn btn-primary btn-sm btn-flat">
                                            <i class="fa fa fa-search"></i>
                                            Filter
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-1 col-lg-4">
                            <div class="card-tools">
                                <div class="btn-group">
                                    {{-- <a href="{{ route('news.create') }}" class="btn btn-success btn-sm btn-flat mr-2">
                                <i class="fa fa-plus"></i> Add News
                                </a> --}}
                                    @can('newsnepali-create')
                                    @if (request()->route()->getName() == 'editorialNews')
                                    <a href="{{ route('createNewsInNepali') }}?t=editorial"
                                    class="btn btn-success btn-sm btn-flat mr-2">
                                    <i class="fa fa-plus"></i> Add News
                                </a>
                                @else

                                <a href="{{ route('createNewsInNepali') }}"
                                    class="btn btn-success btn-sm btn-flat mr-2">
                                    <i class="fa fa-plus"></i> Add News
                                </a>
                                    @endif
                                    @endcan


                                    {{-- @can('newsenglish-create')

                                        <a href="{{ route('createNewsInEnglish') }}"
                                            class="btn btn-success btn-sm btn-flat mr-2">
                                            <i class="fa fa-plus"></i> Add News in English
                                        </a>
                                    @endcan --}}



                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @isset($reporter)
                    <div class="card-header">
                        <div class="info-box bg-green">
                            <span class="info-box-icon bg-green">
                                <i class="fa fa-flag-o">
                                    <img src="{{ asset('uploads/' . $reporter->profile_image) }}" class="img-fluid"
                                        alt="">
                                    </i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text text-capitalize">Name: {{ $reporter->name['en'] }}</span>
                                <span class="info-box-text text-capitalize">email: {{ $reporter->email }}</span>
                                <span class="info-box-text text-capitalize">Name: {{ $reporter->name['en'] }}</span>
                                <span class="info-box-number text-capitalize">total news :
                                    {{ $reporter->reporter_news_count }}</span>

                                <!-- /.info-box-content -->
                            </div>

                        </div>
                    @endisset
                    <div style="overflow-x: scroll" class="card-body card-format">
                        <table class="table table-striped table-hover"> {{-- table-bordered --}}
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>
                                        Title </th>
                                    <th> Thumbnail </th>
                                    <th> Categories </th>
                                    <th> Tags </th>
                                    <th>Reporter</th>
                                    <th> Status </th>
                                    <th style="text-align:center;" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($news as $key => $value)

                                    <tr>
                                        <td>{{ $key + 1 }}.</td>
                                        <td>{{ @$value->title['np'] }}</td>
                                        <td>
                                            <a target="_blank"
                                                href="{{ create_image_url($value->img_url,'thumbnail') }}">
                                                <img src="{{ create_image_url($value->img_url, 'thumbnail') }}"
                                                    alt="{{ @$value->title['en'] }}" class="img img-thumbail"
                                                    style="width:60px">
                                            </a>
                                        </td>

                                        <td>

                                            @if ($value->newsHasCategories)
                                                @foreach ($value->newsHasCategories as $key => $catItem)
                                                    <span
                                                        class="badge badge-success">{{ @$catItem->title[$_locale] }}</span>
                                                @endforeach
                                            @endif
                                        </td>

                                        <td>
                                            @if ($value->newsHasTags)
                                                @foreach ($value->newsHasTags as $key => $tagItem)
                                                    <span class="badge badge-info">{{ @get_title(@$tagItem) }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </td>

                                        <td>
                                            @if ($value->news_reporters)
                                            @foreach($value->news_reporters as $reporter)
                                                <a href="{{ route('newsReporter', $reporter->id) }}">
                                                    {{ get_reporter($reporter) }}</a>
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                            @endforeach
                                            @endif
                                        </td>

                                        <td>
                                            <span
                                                class="badge badge-{{ $value->publish_status == '1' ? 'success' : 'danger' }}">
                                                {{ $value->publish_status == '1' ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                {{-- <a href="{{ route('newsDetail', $value->slug) }}"
                                                    title="Edit News" class="btn btn-primary btn-sm btn-flat" target="_blank">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @canany('news-edit','newsenglish-update','newsnepali-update')
                                                @if (@$value->news_language == 'en')
                                                    <a href="{{ route('editNewsInEnglish', $value->id) }}"
                                                        title="Edit News" class="btn btn-success btn-sm btn-flat">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('editNewsInNepali', $value->id) }}"
                                                        title="Edit News" class="btn btn-success btn-sm btn-flat">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                @endcanany
                                                @can('news-delete')
                                                    {{ Form::open(['method' => 'DELETE', 'route' => ['news.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this News?")']) }}
                                                    {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete News ']) }}
                                                    {{ Form::close() }}
                                                @endcan --}}
                                                <?php $userRole =  request()->user()->roles->first()->name ?>
                                                @if($userRole == 'Super Admin' || $userRole == 'Admin')
                                                @canany(['news-edit','newsenglish-update','newsnepali-update'])
                                                    <a href="{{ route('news.edit', $value->id) }}" title="Edit News"
                                                        class="btn btn-success btn-sm btn-flat"><i class="fas fa-edit"></i></a>
                                                @endcanany
                                                @canany(['news-delete','newsenglish-delete','newsnepali-delete'])
                                                    {{ Form::open(['method' => 'DELETE', 'route' => ['news.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this News?")']) }}
                                                    {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete News ']) }}
                                                    {{ Form::close() }}
                                                @endcanany
                                                @elseif($userRole != 'Super Admin' && $userRole != 'Admin' && $value->publish_status == '0')
                                                @canany(['news-edit','newsenglish-update','newsnepali-update'])
                                                    <a href="{{ route('news.edit', $value->id) }}" title="Edit News"
                                                        class="btn btn-success btn-sm btn-flat"><i class="fas fa-edit"></i></a>
                                                @endcanany
                                                @canany(['news-delete','newsenglish-delete','newsnepali-delete'])
                                                    {{ Form::open(['method' => 'DELETE', 'route' => ['news.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this News?")']) }}
                                                    {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete News ']) }}
                                                    {{ Form::close() }}
                                                @endcanany
                                                @endif
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
                                        Showing <strong>{{ $news->firstItem() }}</strong> to
                                        <strong>{{ $news->lastItem() }} </strong> of <strong>
                                            {{ $news->total() }}</strong>
                                        entries
                                        <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to
                                            render</span>
                                    </p>
                                </div>
                                <div class="col-md-8">
                                    <span class="pagination-sm m-0 float-right">{{ $news->links() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
