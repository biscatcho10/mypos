@extends('layouts.admin')

@section('title', 'All Categories')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="{{route('categories.index')}}">Categories</a></li>
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        @include('sweet::alert')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <div class="row">
                        <div class="col-10">
                            <form action=" {{route('categories.index')}} " method="get" class="d-flex float-left">
                                @csrf
                                <div class="row">
                                    <div class="col-10">
                                        <input type="text" name="search" class="form-control" placeholder="search" value=" {{request()->search}} ">
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-primary "><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-2">
                            @if (Auth::user()->hasPermission('users_create'))
                                <a href=" {{route('categories.create')}} " class="btn btn-outline-info"> <i class="fa fa-plus" aria-hidden="true"></i> </a>
                            @else
                                <a href="" class="btn btn-outline-info disabled" > <i class="fa fa-plus" aria-hidden="true"></i> </a>
                            @endif
                        </div>
                    </div>
                </h3>
            </div>
            <div class="card-body">
                @include('dashboard.includes.alerts._success')
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th><i class="fa fa-dot-circle" aria-hidden="true"></i></th>
                            <th>Name</th>
                            <th>Product Count</th>
                            <th>Related Products</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       @if ($categories->count() > 0)
                        @foreach ($categories as $category)
                            <tr>
                                <td> {{$category->id}} </td>
                                <td> {{$category->name}} </td>
                                <td> {{$category->products->count()}} </td>
                                <td>
                                    <a href=" {{route('related-productd', $category->id)}} " class="btn btn-success">Related Products</a>
                                </td>
                                <td>

                                    @if (Auth::user()->hasPermission('users_update'))
                                        <a href=" {{route('categories.edit', $category->id)}} " class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i> </a>
                                    @else
                                        <button disabled="disabled" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button>
                                    @endif

                                    @if (Auth::user()->hasPermission('users_delete'))
                                        <form action="{{route('categories.destroy', $category->id)}}" method="post" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                    @else
                                    <button disabled="disabled" class="btn btn-danger btn-sm delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                       @else
                          <h2>No Data Found </h2>
                       @endif
                    </tbody>
                </table>
                <div class="w-25 mt-3 mx-auto">
                    {{ $categories->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->

    <!-- /.content -->
</div>
@endsection
