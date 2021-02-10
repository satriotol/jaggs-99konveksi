@extends('layouts.app')
@section('content')
<div class="content-wrapper" style="min-height: 1416.81px;">
    <!-- Content Header (Page header) -->
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
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
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
                    <form action="{{isset($user) ? route('user.updateadmin',$user->id): route('user.store')}}" method="post">
                        @csrf
                        @if (isset($user))
                        @method('PUT')
                        @endif
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
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" readonly class="form-control"
                                    value="{{isset($user) ? $user->name : ''}}" required autocomplete="name" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="role">Edit Role</label>
                                <select name="role" id="" class="form-control">
                                    <option value="user" {{$user->role == 'user' ? 'selected' : ''}}>User</option>
                                    <option value="admin" {{$user->role == 'admin' ? 'selected' : ''}}>Admin</option>
                                </select>
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
<script type="text/javascript">
    $(function () {
        $('#datetimepicker7').datetimepicker({
            format: 'L',
        });
        $('#datetimepicker8').datetimepicker({
            useCurrent: false,
            format: 'L'
        });
        $("#datetimepicker7").on("change.datetimepicker", function (e) {
            $('#datetimepicker8').datetimepicker('minDate', e.date);
        });
        $("#datetimepicker8").on("change.datetimepicker", function (e) {
            $('#datetimepicker7').datetimepicker('maxDate', e.date);
        });
    });

</script>
@endsection
