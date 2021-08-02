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
                            <li class="breadcrumb-item active">@lang('site.clients')</li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
</div>
<form action="{{ route('dashboard.clients.index')}}" method="get" style="margin-bottom: 20px">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" value="{{ request()->search}}" placeholder="@lang('search')">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>@lang('site.search')</button>
            @if(auth()->user()->hasPermission('create_clients'))
                <a href="{{ route('dashboard.clients.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</a>
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
                    @if($clients->count() > 0)
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.phone')</th>
                                <th>@lang('site.address')</th>
                                <th>@lang('site.add_order')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $index=>$client)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$client->name}}</td>
                                    <td>{{ is_array($client->phone) ? implode($client->phone, '-') : $client->phone }}</td>
                                    <td>{{$client->address }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('create_orders'))

                                        <a href="{{ route('dashboard.clients.orders.create', $client->id)}}" class="btn btn-primary">@lang('site.add_order')</a>

                                        @else
                                            <a href="#" class="btn btn-primary disabled">@lang('site.add_order')</a>

                                        @endif
                                    </td>
                                    <td>

                                        @if(auth()->user()->hasPermission('update_clients'))
                                            <a href="{{route('dashboard.clients.edit', $client->id)}}" class="btn btn-info btn-sm">@lang('site.edit')</a>
                                        @else
                                            <button class="btn btn-info btn-sm disabled">@lang('site.edit')</button>
                                        @endif

                                        @if(auth()->user()->hasPermission('delete_clients'))
                                        <form action="{{route('dashboard.clients.destroy', $client->id)}}" method="post" style="display: inline-block">
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

                    {{ $clients->appends(request()->query())->links() }}
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
