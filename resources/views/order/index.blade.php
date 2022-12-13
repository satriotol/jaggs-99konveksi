@extends('layouts.app')
@section('content')
    <div class="content-wrapper" style="min-height: 1200.88px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Invoice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $orders->total() }}</h3>
                                <p>Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('orders.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Invoice</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Judul</label>
                                                <input type="text" class="form-control" name="judul"
                                                    value="{{ @old('judul') }}" id="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" name="cust_name"
                                                    value="{{ @old('cust_name') }}" id="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Marketing</label>
                                                <select name="user_id" id="" class="form-control">
                                                    <option value="">Pilih Marketing</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}"
                                                            @if (@old('user_id') == $user->id) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <input type="submit" value="Cari" class="btn btn-primary" name=""
                                            id="">
                                    </div>
                                </form>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Marketing</th>
                                            <th>Title</th>
                                            <th>Action</th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            <th>Total Qty</th>
                                            <th>Total Price</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr
                                                @if ($order->getStatusPayment() == 0) style="background-color: lightgreen" @endif>
                                                <td>{{ $order->user->name }}</td>
                                                <td>{{ $order->judul }}</td>
                                                <td>
                                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('orders.show', $order->id) }}" type="button"
                                                            class="btn btn-outline-info">Detail</a>
                                                        <input type="submit" value="Hapus" class="btn btn-outline-danger"
                                                            onclick="confirm('are you sure?')" name=""
                                                            id="">
                                                    </form>
                                                </td>
                                                <td>{{ $order->cust_name }}</td>
                                                <td>{{ $order->cust_phone }}</td>
                                                <td>{{ $order->getQty() }}</td>
                                                <td>Rp. {{ number_format($order->getTotalPrice(), 2) }}</td>
                                                <td>{{ $order->start_date }}</td>
                                                <td>{{ $order->end_date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    {!! $orders->appends(['judul' => @old('judul'), 'user_id' => @old('user_id'), 'cust_name' => @old('cust_name')])->render() !!}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
