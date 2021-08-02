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
                        <h2 class="content-header-title float-left mb-0">@lang('site.orders')
                            <small>{{ $orders->total() }}</small>
                        </h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">@lang('site.dashboard')</a>
                                </li>
                                <li class="breadcrumb-item">@lang('site.orders')
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">

            <div class="row">

                <div class="col-md-8">

                    <div class="card">

                        <div class="card-header">

                            <h3 class="card-title" style="margin-bottom: 10px">@lang('site.orders')</h3>

                        </div><!-- end of card header -->


                        <div class="card-content">
                            <div class="panel-group">
                                <div class="panel panel-info">
                                    <div class="panel-header">
                                        <form action="{{ route('dashboard.orders.index') }}" method="get">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                                                </div>

                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                                </div>
                                            </div><!-- end of row -->

                                        </form><!-- end of form -->
                                    </div> <!-- end panel header -->
                                        @if ($orders->count() > 0)
                                        <div class="box-body table-responsive">
                                            <table class="table table-hover">
                                                <tr>
                                                    <th>@lang('site.client_name')</th>
                                                    <th>@lang('site.price')</th>
                                                    <th>@lang('site.created_at')</th>
                                                    <th>@lang('site.action')</th>
                                                </tr>

                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>{{ $order->client->name }}</td>
                                                        <td>{{ number_format($order->total_price, 2) }}</td>

                                                        <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                                        <td>
                                                            <button class="btn btn-primary btn-sm order-products"
                                                                    data-url="{{ route('dashboard.orders.products', $order->id) }}"
                                                                    data-method="get">
                                                                <i class="fa fa-list"></i>
                                                                @lang('site.show')
                                                            </button>
                                                            @if (auth()->user()->hasPermission('update_orders'))
                                                                <a href="{{ route('dashboard.clients.orders.edit', ['client' => $order->client->id, 'order' => $order->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> @lang('site.edit')</a>
                                                            @else
                                                                <a href="#" disabled class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                                            @endif

                                                            @if (auth()->user()->hasPermission('delete_orders'))
                                                                <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="post" style="display: inline-block;">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('delete') }}
                                                                    <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                                                </form>

                                                            @else
                                                                <a href="#" class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i> @lang('site.delete')</a>
                                                            @endif

                                                        </td>

                                                    </tr>

                                                @endforeach

                                            </table><!-- end of table -->

                                            {{ $orders->appends(request()->query())->links() }}

                                        </div>

                                    @else

                                        <div class="box-body">
                                            <h3>@lang('site.no_records')</h3>
                                        </div>

                                    @endif
                                </div> <!-- end panel info -->
                            </div> <!-- end panel group -->
                        </div> <!-- end card-content -->
                    </div><!-- end of card -->

                </div><!-- end of col -->



                <div class="col-md-4">

                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">@lang('site.show_products')</h3>
                        </div><!-- end of card header -->

                        <div class="card-body">

                            <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                                <div class="loader"></div>
                                <p style="margin-top: 10px">@lang('site.loading')</p>
                            </div>

                            <div id="order-product-list">

                            </div><!-- end of order product list -->

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

            </div><!-- end of row -->

        </div><!-- end of content body -->

    </div><!-- end of content wrapper -->
</div>
@endsection
