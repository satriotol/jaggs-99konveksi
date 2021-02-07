@extends('layouts.app')
@section('content')
<div class="content-wrapper" style="min-height: 1416.81px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{isset($user) ? 'Edit User' : 'Create User'}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Project Add</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">General</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <form action="{{route('user.updateemail',$user->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Error</h3>
                                </div>
                                <div class="card-body">
                                    @foreach ($errors->all() as $error)
                                    <li class="list-group-item text-danger">
                                        {{$error}}
                                    </li>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="inputName">Email Address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{isset($user) ? $user->email:''}}" required
                                    autocomplete="email">
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{url()->previous()}}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Register" class="btn btn-success float-right">
            </div>
            </form>
        </div>
    </section>
</div>

@endsection
@section('script')
@endsection
