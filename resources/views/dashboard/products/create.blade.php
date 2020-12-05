@extends('layouts.admin')

@section('title', 'Add New Product')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add New Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Add Product</li>
                        <li class="breadcrumb-item "><a href="{{route('products.index')}}">Products</a></li>
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <div class="card card-gray">
            <div class="card-header">
                <h3 class="card-title">
                    Add New Product
                </h3>
            </div>
            <div class="card-body">
                @include('dashboard.includes.alerts._errors')
                <form action=" {{route('products.store')}} " method="post" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label> Categories </label>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ""}} > {{$category->name}} </option>
                            @endforeach
                        </select>
                    </div>

                    @foreach (config('translatable.locales') as $locale)
                        <div class="form-group">
                            <label>Product Name In <span class="text-uppercase">{{$locale}}</span></label>
                            <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale . '.name') }}">
                        </div>

                        <div class="form-group">
                            <label>Description In <span class="text-uppercase">{{$locale}}</span></label>
                            <textarea name="{{ $locale }}[desc]"  rows="2" class="form-control ckeditor">{{ old($locale . '.desc') }}</textarea>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control image">
                    </div>
                    <div class="form-group">
                        <img src=" {{asset('storage/images/Products/image.png')}} " width="120px" class="img-thumbnail round image-preview">
                    </div>

                    <div class="form-group">
                        <label for="">Purchase Price</label>
                        <input type="number" name="purchase_price" class="form-control" value="{{old('purchase_price')}}">
                    </div>

                    <div class="form-group">
                        <label for="">Sale Price</label>
                        <input type="number" name="sale_price" class="form-control" value="{{old('sale_price')}}">
                    </div>

                    <div class="form-group">
                        <label for="">Stock</label>
                        <input type="number" name="stock" class="form-control" value="{{old('stock')}}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary my-3"><span><i class="fa fa-plus"aria-hidden="true"></i></span> Add</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Main content -->

    <!-- /.content -->
</div>
@endsection
