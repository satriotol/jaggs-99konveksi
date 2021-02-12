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
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
                            <table id="example1" class="table table-bordered table-striped">
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
                                    @if ($order->user_id === Auth::user()->id)
                                    <tr>
                                        <td>{{$order->user->name}}</td>
                                        <td>{{$order->judul}}</td>
                                        <td><a href="{{route('orders.show',$order->id)}}" type="button"
                                                class="btn btn-outline-info">Info</a>
                                            <button class="btn btn-outline-danger" id="deleteCategoryForm"
                                                onclick="handleDelete({{$order->id}})">Delete</button>
                                        </td>
                                        <td>{{$order->cust_name}}</td>
                                        <td>{{$order->cust_phone}}</td>
                                        <?php $sum_qty = 0?>
                                        @foreach ($order->orderdetail as $od)
                                        <?php $sum_qty += $od->qty ?>
                                        @endforeach
                                        <td>{{$sum_qty}}</td>
                                        <?php $sum_price =0 ?>
                                        @foreach ($order->orderdetail as $od)
                                        <?php $sum_price += $od->price * $od->qty ?>
                                        @endforeach
                                        <td>Rp. {{number_format($sum_price,2)}}</td>
                                        <td>{{$order->start_date}}</td>
                                        <td>{{$order->end_date}}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
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
                                </tfoot>
                            </table>
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
@if ($orders->count()>0)
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('orders.destroy',$order->id)}}" method="POST">
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
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>


<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
            "info": true,
            "ordering": true,
            "paging": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ],
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

</script>
<script>
    function handleDelete(id) {
        var form = document.getElementById('deleteCategoryForm');
        form.action = '/orders/' + id;
        $('#deleteModal').modal('show');
    }

</script>
@endsection
