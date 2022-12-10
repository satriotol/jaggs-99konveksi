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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Invoice</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="">
                                    <div class="form-group">
                                        <label>Cari</label>
                                        <input type="text" class="form-control" name="search"
                                            value="{{ @old('search') }}" id="">
                                        <div class="text-right">
                                            <input type="submit" value="Cari" class="btn btn-primary" name=""
                                                id="">
                                        </div>
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
                                    {{ $orders->links() }}
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
    <!-- Modal -->
    @if ($orders->count() > 0)
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center text-bold">Are you sure want to delete this category?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection
@section('script')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('deleteCategoryForm');
            form.action = '/orders/' + id;
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
