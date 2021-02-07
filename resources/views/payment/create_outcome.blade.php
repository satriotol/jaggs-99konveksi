@extends('layouts.app')
@section('content')
<div class="content-wrapper" style="min-height: 1416.81px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{isset($payment) ? 'Edit Payment' : 'Create Payment'}}</h1>
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
                    <form action="{{isset($payment) ? route('payments.update',$payment->id): route('payment.storeoutcome')}}"
                        method="post">
                        @csrf
                        @if (isset($payment))
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
                            @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{session()->get('success')}}
                            </div>
                            @endif
                            <div class="form-group">
                                <input type="hidden" name="order_id" value="0">
                                <input type="hidden" name="type" value="outcome">
                                <label for="name">Pay Amount</label>
                                <input type="number" id="pay" name="pay" class="form-control"
                                    value="{{isset($payment) ? $payment->pay : ''}}" required autocomplete="off"
                                    autofocus>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Edit Type</label>
                                <select name="description" id="" class="form-control">
                                    {{-- <option value="">Choose One</option>
                                    <option value="dp" {{$payment->description == 'dp' ? 'selected' : ''}}>DP</option>
                                    <option value="pelunasan"
                                        {{$payment->description == 'pelunasan' ? 'selected' : ''}}>Pelunasan</option>
                                    <option value="lain" {{$payment->description == 'lain' ? 'selected' : ''}}>Lainnya
                                    </option> --}}
                                    <option value="">Choose One</option>
                                    <option value="lain">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <div class="input-group">
                                    <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                                        <input type="text" name="date" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker7" data-toggle="datetimepicker"
                                            autocomplete="off" value="{{isset($payment) ? $payment->date : ''}}" />
                                        <div class="input-group-append" data-target="#datetimepicker7">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{url()->previous()}}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Submit" class="btn btn-success float-right">
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
            format: 'YYYY/MM/DD',
        });
        $("#datetimepicker7").on("change.datetimepicker", function (e) {
            $('#datetimepicker8').datetimepicker('minDate', e.date);
        });
    });

</script>
@endsection
