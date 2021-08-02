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
                    <h2 class="content-header-title float-left mb-0">@lang('site.products')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">@lang('site.dashboard')</a>
                            </li>
                            <li class="breadcrumb-item active">@lang('site.products')</li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
</div>
<form action="{{ route('dashboard.products.index')}}" method="get" style="margin-bottom: 20px">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" value="{{ request()->search}}" placeholder="@lang('search')">
        </div>

        <div class="col-md-4">
            <select name="category_id" class="form-control">
                <option value="">@lang('site.all_categories')</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name}}</option>
                @endforeach

            </select>
        </div>


        <div class="col-md-4">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>@lang('site.search')</button>
            @if(auth()->user()->hasPermission('create_products'))
                <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</a>
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
                    @if($products->count() > 0)
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.description')</th>
                                <th>@lang('site.category')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.purchase_price')</th>
                                <th>@lang('site.sale_price')</th>
                                <th>@lang('site.profit_percent') %</th>
                                <th>@lang('site.stock')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index=>$product)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{!!$product->description!!}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td><img src="{{ $product->image_path }}" style="width:100px" class="img-thumbnail" alt=""></td>
                                    <td>{{$product->purchase_price}}</td>
                                    <td>{{$product->sale_price}}</td>
                                    <td>{{$product->profit_percent}} %</td>
                                    <td>{{$product->stock}}</td>
                                    <td>

                                        @if(auth()->user()->hasPermission('update_products'))
                                            <a href="{{route('dashboard.products.edit', $product->id)}}" class="btn btn-info btn-sm">@lang('site.edit')</a>
                                        @else
                                            <button class="btn btn-info btn-sm disabled">@lang('site.edit')</button>
                                        @endif

                                        @if(auth()->user()->hasPermission('delete_products'))
                                        <form action="{{route('dashboard.products.destroy', $product->id)}}" method="post" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-danger delete btn-sm">@lang('site.delete')</button>
                                        </form>
                                        @else
                                            <button class="btn btn-danger btn-sm disabled">@lang('site.delete')</button>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $products->appends(request()->query())->links() }}
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
