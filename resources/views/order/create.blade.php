@extends('layouts.app')
@section('content')
<div class="content-wrapper" style="min-height: 1416.81px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Make Invoice</h1>
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
                    <form action="{{route('orders.store')}}" method="post">
                        @csrf
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
                            <input type="hidden" id="inputName" name="user_id" value="{{ Auth::user()->id }}"
                                class="form-control">
                            <div class="form-group">
                                <label for="inputName">Title</label>
                                <input type="text" id="inputName" name="judul" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Start Date</label>
                                <div class="input-group">
                                    <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                                        <input type="text" name="start_date" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker7" data-toggle="datetimepicker" autocomplete="off" />
                                        <div class="input-group-append" data-target="#datetimepicker7">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <div class="input-group">
                                    <div class="input-group date" id="datetimepicker8" data-target-input="nearest">
                                        <input type="text" name="end_date" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker8" data-toggle="datetimepicker" autocomplete="off"/>
                                        <div class="input-group-append" data-target="#datetimepicker8">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Customer Name</label>
                                <input type="text" id="inputName" name="cust_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Customer Email</label>
                                <input type="text" id="inputName" name="cust_email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Customer Phone</label>
                                <input type="text" id="inputName" name="cust_phone" class="form-control">
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Create Invoice" class="btn btn-success float-right">
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
