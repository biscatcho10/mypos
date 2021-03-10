@extends('layouts.admin')

@section('title', 'Add New Order')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>Add Order</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ route('clients.index') }}">Clients</a></li>
                <li class="active">Add Order</li>
            </ol>
        </section>

        <section class="content">

            <div class="container">
                <div class="row">
                    <div class="col-md-6">

                        <div class="card card-primary">

                            <div class="card-header">

                                <h3 class="card-title" style="margin-bottom: 10px">Categories</h3>

                            </div><!-- end of card header -->

                            <div class="card-body">

                                <div class="accordion" id="accordionExample">

                                    @foreach ($categories as $key => $category)
                                        <div class="card">
                                            <div class="card-header" id="{{ 'heading_' . $key }}">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link btn-block text-left" type="button"
                                                        data-toggle="collapse" data-target="#{{ 'collapse_' . $key }}"
                                                        aria-expanded="true" aria-controls="{{ 'collapse_' . $key }}">
                                                        {{ $category->name }}
                                                    </button>
                                                </h2>
                                            </div>

                                            <div id="{{ 'collapse_' . $key }}" class="collapse"
                                                aria-labelledby="{{ 'heading_' . $key }}" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    @if ($category->products->count() > 0)
                                                        <table class="table table-hover">
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Stock</th>
                                                                <th>Price</th>
                                                                <th>Add
                                                            </tr>
                                                            </tr>

                                                            @foreach ($category->products as $product)
                                                                <tr>
                                                                    <td>{{ $product->name }}</td>
                                                                    <td>{{ $product->stock }}</td>
                                                                    <td>{{ number_format($product->sale_price, 2) }}</td>
                                                                    <td>
                                                                        <a href="" id="product-{{ $product->id }}"
                                                                            data-name="{{ $product->name }}"
                                                                            data-id="{{ $product->id }}"
                                                                            data-price="{{ $product->sale_price }}"
                                                                            class="btn btn-success btn-sm add-product-btn">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </table>
                                                    @else
                                                        <h5>No Data Found</h5>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                            </div><!-- end of card body -->

                        </div><!-- end of card -->

                    </div><!-- end of col -->

                    <div class="col-md-6">

                        <div class="card card-primary">

                            <div class="card-header">

                                <h3 class="card-title">Orders</h3>

                            </div><!-- end of card header -->

                            <div class="card-body">
                                @include('dashboard.includes.alerts._errors')
                                <form action="{{ route('clients.orders.store', $client->id) }}" method="post">

                                    {{ csrf_field() }}
                                    {{ method_field('post') }}

                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>

                                        <tbody class="order-list">


                                        </tbody>

                                    </table><!-- end of table -->

                                    <h4>Totel : <span class="total-price">0</span></h4>

                                    <button class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i
                                            class="fa fa-plus"></i> Add Order</button>

                                </form>

                            </div><!-- end of card body -->

                        </div><!-- end of card -->

                        {{-- @if ($client->orders->count() > 0) --}}

                        <div class="card card-primary">

                            <div class="card-header">

                                <h3 class="card-title" style="margin-bottom: 10px">Pervious Orders
                                    <small>{{ $orders->total() }}</small>
                                </h3>

                            </div><!-- end of card header -->

                            <div class="card-body">

                                @foreach ($orders as $order)

                                    <div class="panel-group">

                                        <div class="panel panel-success">

                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse"
                                                        href="#{{ $order->created_at->format('d-m-Y-s') }}">
                                                        {{ $order->created_at->toFormattedDateString() }}
                                                    </a>
                                                </h4>
                                            </div>

                                            <div id="{{ $order->created_at->format('d-m-Y-s') }}"
                                                class="panel-collapse collapse">

                                                <div class="panel-body">

                                                    <ul class="list-group">
                                                        @foreach ($order->products as $product)
                                                            <li class="list-group-item">{{ $product->name }}</li>
                                                        @endforeach
                                                    </ul>

                                                </div><!-- end of panel body -->

                                            </div><!-- end of panel collapse -->

                                        </div><!-- end of panel primary -->

                                    </div><!-- end of panel group -->

                                @endforeach

                                {{ $orders->links() }}

                            </div><!-- end of card body -->

                        </div><!-- end of card -->


                    </div><!-- end of col -->
                </div>
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
@endsection
