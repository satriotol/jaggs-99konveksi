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
                        <table id="example1" class="table table-bordered table-striped">
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
                                    <td>{{$od->qty}}</td>
                                    <td>Rp. {{number_format($od->price,2)}}</td>
                                    <td>Rp. {{number_format($od->qty * $od->price,2)}}</td>
                                </tr>
                                <?php $sum_tot += $od->price*$od->qty ?>
                                @endif
                                @endforeach
                                <tr>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center" colspan="3">Subtotal</th>
                                    <td>Rp. {{number_format($sum_tot,2)}}</td>
                                </tr>
                            </tfoot>
                        </table>
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
@endsection
@section('script')
<script>
    // var qtyvalue = $("#inputqty").val();
    // var pricevalue = $("#inputprice").val();
    var totalvalue = $("#inputtotal");
    $(".calc").keyup(function () {
        var qtyvalue = parseFloat($("#inputqty").val());
        var pricevalue = parseFloat($("#inputprice").val());
        totalvalue.val(pricevalue * qtyvalue);
    });

</script>
@endsection
