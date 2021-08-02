@extends('layouts.dashboard.app')


@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('site.categories')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">@lang('site.dashboard')</a>
                            </li>
                            <li class="breadcrumb-item active">@lang('site.categories')</li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
</div>
<form action="{{ route('dashboard.categories.index')}}" method="get" style="margin-bottom: 20px">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" value="{{ request()->search}}" placeholder="@lang('search')">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>@lang('site.search')</button>
            @if(auth()->user()->hasPermission('create_categories'))
                <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</a>
            @else
            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>@lang('site.add')</a>
            @endif

        </div>
    </div>
</form>

<div class="content-body">
<div class="row" id="table-hover-row">
    <div class="col-12">
        <div class="card">

            <div class="card-content">
                <div class="table-responsive">
                    @if($categories->count() > 0)
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.products_count')</th>
                                <th>@lang('site.related_products')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index=>$category)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->products->count() }}</td>
                                    <td><a href="{{ route('dashboard.products.index', ['category_id' => $category->id]) }}" class="btn btn-info btn-sm">@lang('site.related_products')</a></td>
                                    <td>

                                        @if(auth()->user()->hasPermission('update_categories'))
                                            <a href="{{route('dashboard.categories.edit', $category->id)}}" class="btn btn-info btn-sm">@lang('site.edit')</a>
                                        @else
                                            <button class="btn btn-info btn-sm disabled">@lang('site.edit')</button>
                                        @endif

                                        @if(auth()->user()->hasPermission('delete_categories'))
                                        <form action="{{route('dashboard.categories.destroy', $category->id)}}" method="post" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-danger btn-sm delete">@lang('site.delete')</button>
                                        </form>
                                        @else
                                            <button class="btn btn-danger btn-sm disabled">@lang('site.delete')</button>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $categories->appends(request()->query())->links() }}
                    @else
                    <h2>@lang('site.no_data_found')</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
