@extends('layouts.admin')

@section('title', 'Edit Order')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>Edit Order</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ route('clients.index') }}">Clients</a></li>
                <li class="active">Edit Order</li>
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
                                                                    <td>{{ $product->sale_price }}</td>
                                                                    @if (in_array($product->id, $order->products->pluck('id')->toArray()))
                                                                        <td>
                                                                            <a href="" class="btn btn-default btn-sm disabled">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                        </td>
                                                                    @else
                                                                        <td>
                                                                            <a href="" id="product-{{ $product->id }}"
                                                                                data-name="{{ $product->name }}"
                                                                                data-id="{{ $product->id }}"
                                                                                data-price="{{ $product->sale_price }}"
                                                                                class="btn btn-success btn-sm add-product-btn">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                        </td>
                                                                    @endif
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
                                <form action="{{ route('clients.orders.update', ['order' => $order->id, 'client' => $client->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}

                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>

                                        <tbody class="order-list">

                                            @foreach ($order->products as $product)
                                                <tr>
                                                    <td>{{ $product->name }}</td>
                                                    <td> <input type="number"
                                                            name="products[{{ $product->id }}][quantity]"
                                                            data-price="{{ number_format($product->sale_price, 2) }}"
                                                            class="form-control prod-quan" min="1"
                                                            value="{{ $product->pivot->quantity }}">
                                                    </td>
                                                    <td class="prod-price">
                                                        {{ $product->sale_price * $product->pivot->quantity }}
                                                    </td>
                                                    <td>
                                                        <button type="button" id="{{ 'product-' . $product->id }}"
                                                            data-id="{{ $product->id }}"
                                                            class="btn btn-danger btn-sm remove-product-button">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table><!-- end of table -->

                                    <h4>Totel : <span class="total-price"> {{number_format($order->total_price ,2)}} </span></h4>

                                    {{-- <button type="submit" class="btn btn-primary btn-block disabled" id="add-order-form-btn">
                                        <i class="fa fa-plus"></i> Edit Order
                                    </button> --}}

                                    <button type="submit" class="btn btn-primary btn-block" id="add-order-form-btn">
                                        <i class="fa fa-plus"></i> Edit Order
                                    </button>

                                </form>

                            </div><!-- end of card body -->

                        </div><!-- end of card -->

                        @if ($orders->count() > 0)

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title" style="margin-bottom: 10px">Pervious Orders
                                        <small>{{ $orders->total() }}</small>
                                    </h3>
                                </div><!-- end of card header -->

                                <div class="card-body">
                                    @foreach ($orders as $order)
                                        <div class="accordion" id="accordionExample">
                                            <div class="card">
                                            <div class="card-header" id="{{$order->id}}">
                                                <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#{{'collapseOne'.$order->id}}" aria-expanded="true" aria-controls="collapseOne">
                                                    {{ $order->created_at->toFormattedDateString() }}
                                                </button>
                                                </h2>
                                            </div>

                                            <div id="{{'collapseOne'.$order->id}}" class="collapse" aria-labelledby="{{ $order->id}}" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    @foreach ($order->products as $product)
                                                        <li class="list-group-item">{{ $product->name }}</li>
                                                    @endforeach
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{ $orders->links() }}
                                </div><!-- end of card body -->
                            </div><!-- end of card -->
                        @endif
                    </div><!-- end of col -->
                </div>
            </div>
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->
@endsection
