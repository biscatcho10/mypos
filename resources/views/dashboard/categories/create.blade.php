@extends('layouts.admin')

@section('title', 'Add New Category')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add New Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Add Category</li>
                        <li class="breadcrumb-item "><a href="{{route('categories.index')}}">Categories</a></li>
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    Add New Category
                </h3>
            </div>
            <div class="card-body">
                @include('dashboard.includes.alerts._errors')
                <form action=" {{route('categories.store')}} " method="post" enctype="multipart/form-data">
                    @csrf

                    {{-- @foreach (config('translatable.locales') as  $lang)
                        <div class="form-group">
                            <label for="">Category Name In <span class="text-uppercase">{{$lang}}</span></label>
                            <input type="text" name="name:{{$lang}}" value="{{old('name:'.$lang)}}" class="form-control" placeholder="category name in {{$lang}}">
                        </div>
                    @endforeach --}}

                    @foreach (config('translatable.locales') as $locale)
                        <div class="form-group">
                            <label>Category Name In <span class="text-uppercase">{{$locale}}</span></label>
                            <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale . '.name') }}">
                        </div>
                    @endforeach

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><span><i class="fa fa-plus"aria-hidden="true"></i></span> Add</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Main content -->

    <!-- /.content -->
</div>
@endsection
