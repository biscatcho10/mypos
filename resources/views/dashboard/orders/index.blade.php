@extends('layouts.admin')

@section('title', 'All Orders')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Orders</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a href="{{ route('orders.index') }}">Orders</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="container">
            @include('sweet::alert')
            <div class="row">
                <div class="col-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-10">
                                        <form action="{{ route('orders.index') }}" method="get">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input type="text" name="search" class="form-control"
                                                        placeholder="Search" value="{{ request()->search }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-2">
                                        @if (Auth::user()->hasPermission('users_create'))
                                            <a href=" {{ route('orders.create') }} " class="btn btn-outline-info"> <i
                                                    class="fa fa-plus" aria-hidden="true"></i> </a>
                                        @else
                                            <a href="" class="btn btn-outline-info disabled"> <i class="fa fa-plus"
                                                    aria-hidden="true"></i> </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Card Header -->

                        @include('dashboard.includes.alerts._success')

                        @if ($orders->count() > 0)

                            <div class="card-body table-responsive">

                                <table class="table table-hover">
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Price</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>

                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->client->name }}</td>
                                            <td>{{ number_format($order->total_price, 2) }}</td>
                                            <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                            <td>
                                                <button class="btn btn-dark btn-sm order-products"
                                                    data-url="{{ route('orders.products', $order->id) }}"
                                                    data-method="get">
                                                    <i class="fa fa-list"></i>
                                                    Show
                                                </button>
                                                @if (auth()->user()->hasPermission('orders_update'))
                                                    <a href="{{ route('clients.orders.edit', ['client' => $order->client->id, 'order' => $order->id]) }}"
                                                        class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                                @else
                                                    <a href="#" disabled class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                                @endif

                                                @if (auth() ->user()->hasPermission('orders_delete'))
                                                    <form action="{{ route('orders.destroy', $order->id) }}"
                                                        method="post" style="display: inline-block;">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button type="submit" class="btn btn-danger btn-sm delete"><i
                                                                class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                @else
                                                    <a href="#" class="btn btn-danger btn-sm" disabled><i
                                                            class="fa fa-trash"></i> Delete</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </table><!-- end of table -->

                                {{ $orders->appends(request()->query())->links() }}

                            </div>

                        @else
                            <div class="card-body">
                                <h3>No Recorders</h3>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" style="margin-bottom: 10px">Show Products</h3>
                        </div><!-- end of card header -->
                        <div class="card-body">
                            <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                                <div class="loader"></div>
                                <p style="margin-top: 10px">Loading</p>
                            </div>
                            <div id="order-product-list">
                            </div><!-- end of order product list -->
                        </div><!-- end of card body -->
                    </div><!-- end of card -->
                </div>
            </div>
        </div>
    </div><!-- Main content -->

    <!-- /.content -->
    </div>
@endsection
