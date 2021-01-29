<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:18px;
            margin:0;
        }
        .container{
            margin:0 auto;
            /* margin-top:10px; */
            padding:40px;
            width:750px;
            height:auto;
            background-color:#fff;
        }
        caption{
            font-size:28px;
            margin-bottom:15px;
        }
        table{
            border:1px solid #333;
            border-collapse:collapse;
            margin:0 auto;
            width:740px;
        }
        td, tr, th{
            padding:12px;
            border:1px solid #333;
            width:185px;
        }
        th{
            background-color: #f0f0f0;
        }
        h4, p{
            margin:0px;
        }
    </style>
</head>
<body>
    <div class="container">
        <table>
            <caption>
                Ninetynine Invoice
            </caption>
            <thead>
                <tr>
                    <th colspan="2">Invoice <strong>#{{ $order->id }}</strong></th>
                    <th colspan="2">{{$order->start_date}} - {{$order->end_date}}</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <h4>Perusahaan: </h4>
                        <p>Ninetynine Konveksi<br>
                            Jl Pete Selatan Nomor 18 Semarang<br>
                            {{$order->user->phone_number}}<br>
                            ninetyninekonveksi@gmail.com
                        </p>
                    </td>
                    <td colspan="2">
                        <h4>Pelanggan: </h4>
                        <p>{{$order->judul}}/{{ $order->cust_name }}<br>
                        {{ $order->cust_email }}<br>
                        {{ $order->cust_phone }} <br>
                        {{-- {{ $invoice->customer->email }} --}}
                        </p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
                <?php $sum_tot = 0?>
                @foreach ($order->orderdetail as $od)
                <tr>
                    <td>{{ $od->product_name }}</td>
                    <td>Rp {{ number_format($od->price,2) }}</td>
                    <td>{{ $od->qty }}</td>
                    <td>Rp {{ number_format($od->price*$od->qty,2) }}</td>
                </tr>
                <?php $sum_tot += $od->price*$od->qty ?>
                @endforeach
                <tr>
                    <th colspan="3">Subtotal</th>
                    <td>Rp {{ number_format($sum_tot,2) }}</td>
                </tr>
                <?php $sum_kekurangan = 0?>
                @foreach ($order->payment as $pay)
                <tr>
                    <th colspan="3">Payment <br><small><i>{{$pay->created_at}}</i></small></th>
                    <td>Rp {{ number_format($pay->pay,2) }}</td>
                </tr>
                <?php $sum_kekurangan += $pay->pay?>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Not Yet Paid</th>
                    <td>Rp {{ number_format($sum_tot-$sum_kekurangan,2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
