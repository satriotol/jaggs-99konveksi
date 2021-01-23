@extends('layouts.app')
@section('content')
<div class="content-wrapper" style="min-height: 1416.81px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice {{$order->id}}</h1>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4><i class="fas fa-globe"></i> {{$order->judul}}
                            <small class="float-right">{{$order->start_date}} - {{$order->end_date}}</small>
                        </h4>
                        <div class="row">
                            <div class="col-sm-6">
                                From
                                <address>
                                    <strong>{{ Auth::user()->name }}</strong><br>
                                    {{Auth::user()->phone_number}}<br>
                                    {{Auth::user()->email}}
                                </address>
                            </div>
                            <div class="col-sm-6">
                                To
                                <address>
                                    <strong>{{ $order->cust_name }}</strong><br>
                                    {{ $order->cust_phone }}<br>
                                    {{ $order->cust_email }}
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sum_tot = 0?>
                                        @foreach ($orderdetails as $od)
                                        @if ($od->order_id == $order->id)
                                        <tr>
                                            <td>{{$od->product_name}}</td>
                                            <td>{{$od->qty}} pcs</td>
                                            <td>Rp. {{number_format($od->price,2)}}</td>
                                            <td>Rp. {{number_format($od->qty * $od->price,2)}}</td>
                                        </tr>
                                        <?php $sum_tot += $od->price*$od->qty ?>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-md-6">

                            </div>
                            <!-- /.col -->
                            <div class="col-md-6 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>Rp. {{number_format($sum_tot,2)}}</td>
                                            </tr>
                                            <?php $sum_kekurangan = 0?>
                                            @foreach ($payments as $payment)
                                            @if ($payment->order_id == $order->id)
                                            <tr>
                                                <th>Payment <br><small><i>{{$payment->created_at}}</i></small></th>
                                                <td>Rp. {{number_format($payment->pay,2)}}</td>
                                            </tr>
                                            <?php $sum_kekurangan += $payment->pay?>
                                            @endif
                                            @endforeach
                                            <tr>
                                                <th>Not Yet Paid</th>
                                                <td>Rp. {{number_format($sum_tot-$sum_kekurangan,2)}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i
                                        class="fas fa-print"></i> Print</a>
                                @if ($sum_tot-$sum_kekurangan > 1)
                                <button type="button" class="btn btn-success float-right" data-toggle="modal"
                                    data-target="#modal-default"><i class="far fa-credit-card"></i> Submit
                                    Payment
                                </button>
                                @endif
                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Make Items</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('orderdetail.store')}}" method="post">
                            @csrf
                            <input type="hidden" id="inputName" name="order_id" value="{{$order->id}}"
                                class="form-control">
                            <div class="form-group">
                                <label for="inputName">Product</label>
                                <input type="text" id="inputName" name="product_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Quantity</label>
                                <input type="number" id="inputqty" name="qty" class="form-control calc">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Price</label>
                                <input type="number" id="inputprice" name="price" class="form-control calc">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Total Price</label>
                                <input type="text" readonly id="inputtotal" name="subtotal" class="form-control">
                            </div>
                            <input type="submit" value="Add Items" class="btn btn-success float-right">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Payment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('payments.store')}}" method="post">
                    @csrf
                    <input type="hidden" id="inputName" name="order_id" value="{{$order->id}}" class="form-control">
                    <div class="form-group">
                        <label for="inputName">Pay</label>
                        <input type="text" id="inputName" name="pay" class="form-control">
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection
@section('script')
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
    var totalvalue = $("#inputtotal");
    $(".calc").keyup(function () {
        var qtyvalue = parseFloat($("#inputqty").val());
        var pricevalue = parseFloat($("#inputprice").val());
        totalvalue.val(pricevalue * qtyvalue);
    });

</script>
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
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
        $('#example3').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

</script>
@endsection
