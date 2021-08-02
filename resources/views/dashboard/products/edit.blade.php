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
                            <li class="breadcrumb-item"><a href="{{route('dashboard.products.index')}}">@lang('site.products')</a>
                            </li>
                            <li class="breadcrumb-item active">@lang('site.edit')</li>

                        </ol>
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="content-body">
        <!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    @include('partials._errors')
    <div class="row match-height">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" action="{{route('dashboard.products.update', $product->id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('put') }}



                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                    <div class="form-group">
                                        <label>@lang('site.categories')</label>
                                        <select name="category_id" class="form-control">
                                            <option value="">@lang('site.all_categories')</option>
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>

                                    @foreach(config('translatable.locales') as $locale)
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">@lang('site.' . $locale . '.name')</label>
                                            <input type="text" id="first-name-vertical" class="form-control" value="{{ $product->name }}" name="{{$locale}}[name]">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">@lang('site.' . $locale . '.description')</label>
                                            <textarea class="form-control ckeditor" name="{{$locale}}[description]">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                    @endforeach



                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>@lang('site.image')</label>
                                            <input type="file"  class="form-control image" name="image">
                                        </div>
                                    </div>

                                    <div class="col-12">

                                        <img src="{{ $product->imge_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>@lang('site.purchase_price')</label>
                                            <input type="number"  class="form-control image" step="0.01" name="purchase_price" value="{{ $product->purchase_price }}">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>@lang('site.sale_price')</label>
                                            <input type="number"  class="form-control image" step="0.01" name="sale_price" value="{{ $product->sale_price }}">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>@lang('site.stock')</label>
                                            <input type="number"  class="form-control image" name="stock" value="{{ $product->stock }}">
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><i class="fa fa-plus"></i>@lang('site.edit')</button>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- // Basic Vertical form layout section end -->

    </div>
</div>
</div>
@endsection

