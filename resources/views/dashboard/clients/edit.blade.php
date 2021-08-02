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
                    <h2 class="content-header-title float-left mb-0">@lang('site.clients')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">@lang('site.dashboard')</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('dashboard.clients.index')}}">@lang('site.clients')</a>
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
                        <form class="form form-vertical" action="{{route('dashboard.clients.update', $client->id)}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>@lang('site.name')</label>
                                            <input type="text" name="name" class="form-control" value="{{ $client->name}}">
                                        </div>
                                    </div>


                                    @for ($i = 0; $i < 2; $i++)
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>@lang('site.phone')</label>
                                            <input type="text" name="phone[]" value="{{ $client->phone[$i] ?? '' }}" class="form-control">
                                        </div>
                                    </div>
                                    @endfor



                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>@lang('site.address')</label>
                                            <textarea name="address" class="form-control">{{ $client->address }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><i class="fa fa-edit"></i>@lang('site.edit')</button>
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

