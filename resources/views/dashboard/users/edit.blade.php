@extends('layouts.admin')

@section('title', 'Add New User')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Edit User</li>
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
                    Edit User
                </h3>
            </div>
            <div class="card-body">
                {{-- @include('dashboard.includes.alerts._errors') --}}
                <form action=" {{route('users.update', $user->id)}} " method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">First Name</label>
                        <input type="text" name="first_name" value="{{$user->first_name}}" class="form-control"
                            placeholder="first name">
                        @error('first_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Last Name</label>
                        <input type="text" name="last_name" value="{{$user->last_name}}" class="form-control"
                            placeholder="last name">
                        @error('last_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control"
                            placeholder="your email">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control image">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <img src=" {{asset('storage/'.$user->image)}} " width="120px" class="img-thumbnail round image-preview">
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
                                        <label><input type="checkbox" class="form-control" name="permissions[]" value="{{$model. '_' .$map}}" {{$user->hasPermission($model.'_'.$map) ? 'checked' : ''}}>{{$map}}</label>
                                    @endforeach
                                </div>
                            @endforeach
                          </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><span><i class="fa fa-plus"aria-hidden="true"></i></span> Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Main content -->

    <!-- /.content -->
</div>
@endsection
