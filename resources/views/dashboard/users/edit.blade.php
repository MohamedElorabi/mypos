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
                    <h2 class="content-header-title float-left mb-0">@lang('site.users')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">@lang('site.dashboard')</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('dashboard.users.index')}}">@lang('site.users')</a>
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
                        <form class="form form-vertical" action="{{route('dashboard.users.update', $user->id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">@lang('site.first_name')</label>
                                            <input type="text" id="first-name-vertical" class="form-control" value="{{ $user->first_name }}" name="first_name" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="last-name-vertical">@lang('site.last_name')</label>
                                            <input type="text" id="last-name-vertical" class="form-control" value="{{ $user->last_name }}" name="last_name" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">@lang('site.email')</label>
                                            <input type="email" id="email-id-vertical" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>@lang('site.image')</label>
                                            <input type="file" id="email-id-vertical" class="form-control image" name="image">
                                        </div>
                                    </div>

                                    <div class="col-12">

                                        <img src="{{ $user->image_path}}" style="width: 100px" class="image_thumbnail image-preview" alt="">
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password-vertical">@lang('site.password')</label>
                                            <input type="password" id="password-vertical" class="form-control" name="password" placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password-vertical">@lang('site.password_confirmation')</label>
                                            <input type="password" id="password-vertical" class="form-control" name="password_confirmation" placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                            <div class="table-responsive border rounded px-1 tile" id="tile-1">
                                                <h6 class="border-bottom py-1 mx-1 mb-0 font-medium-2"><i class="feather icon-lock mr-50 "></i>@lang('site.permission')</h6>


                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <th>Module</th>
                                                            <th>@lang('site.create')</th>
                                                            <th>@lang('site.read')</th>
                                                            <th>@lang('site.update')</th>
                                                            <th>@lang('site.delete')</th>
                                                        </tr>
                                                    </thead>
                                                    @php
                                                        $models = ['users', 'categories', 'products', 'clients', 'orders'];
                                                    @endphp
                                                    <tbody>
                                                        @foreach ($models as $index => $model)
                                                        <tr>
                                                                <td>{{$model}}</td>

                                                                @foreach ($permissions as $permission)
                                                                <td>

                                                                    <input class="lists" type="checkbox" value="{{$permission->id}}" name="permissions[]">

                                                                </td>
                                                                @endforeach

                                                        </tr>

                                                        @endforeach


                                                    </tbody>
                                                </table>
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



{{-- @foreach($permissions_modules as $key=>$page)
            <tr>
                <td>
                    {{__(ucwords($key))}}
                <td>
                    @foreach($page as $index=>$p)
                        <input class="lists" type="checkbox" value="{{$index.' '.$key}}" name="permissions[]" @if(isset($role) && in_array($index.' '.$key,optional($role->getPermissionNames())->toArray())) checked @endif> {{__($p)}}
                    @endforeach
                </td>
            </tr>
        @endforeach --}}

