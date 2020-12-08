@extends('layouts.admin')

@section('title', 'Edit Client')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Client</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Add Client</li>
                        <li class="breadcrumb-item "><a href="{{route('clients.index')}}">Clients</a></li>
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
                    Edit Client
                </h3>
            </div>
            <div class="card-body">
                @include('dashboard.includes.alerts._errors')
                <form action=" {{route('clients.update', $client->id)}} " method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value=" {{$client->name}} ">
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value=" {{$client->phone}}">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control"> {{$client->address}} </textarea>
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
