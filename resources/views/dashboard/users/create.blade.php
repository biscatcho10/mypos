@extends('layouts.admin')

@section('title', 'Add New User')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add New User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Add User</li>
                        <li class="breadcrumb-item "><a href="{{route('users.index')}}">Users</a></li>
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
                    Add New User
                </h3>
            </div>
            <div class="card-body">
                {{-- @include('dashboard.includes.alerts._errors') --}}
                <form action=" {{route('users.store')}} " method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">First Name</label>
                        <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control"
                            placeholder="first name">
                        @error('first_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Last Name</label>
                        <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control"
                            placeholder="last name">
                        @error('last_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control"
                            placeholder="your email">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Password Confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control">
                                @error('password_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control image">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            @php
                                $models = ['users', 'categories', 'products', 'clients', 'orders'];
                                $maps = ['create', 'read', 'update', 'delete'];
                            @endphp
                            @foreach ($models as $index => $model)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-capitalize {{$index == 0 ? 'active' : ''}}" id="{{$model}}-tab" data-toggle="pill" href="#{{$model}}" role="tab" aria-controls="{{$model}}" aria-selected="false">{{$model}}</a>
                                </li>
                            @endforeach
                          </ul>
                          <div class="tab-content" id="pills-tabContent">
                            @foreach ($models as $index => $model)
                                <div class="tab-pane fade show {{$index == 0 ? 'active' : ''}} " id="{{$model}}" role="tabpanel" aria-labelledby="{{$model}}-tab">
                                    @foreach ($maps as $map)
                                        <label><input type="checkbox" class="form-control" name="permissions[]" value="{{$model. '_' .$map}}">{{$map}}</label>
                                    @endforeach
                                </div>
                            @endforeach
                          </div>
                    </div>

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
