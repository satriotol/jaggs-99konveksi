@component('mail::message')
{{$order->judul}}
# INV/{{$order->id}}

Dear {{$order->cust_name}}, <br>
<?php $sum_tot = 0?>
@foreach ($order->orderdetail as $od)
<?php $sum_tot += $od->price*$od->qty ?>
@endforeach
Here is your invoice INV/{{$order->id}} amounting in Rp {{number_format($sum_tot,2)}} from Ninetynine Konveksi. Please
remit payment at your
earliest convenience.

Do not hesitate to contact us if you have any questions.

Thanks,<br>
Ninetynine Konveksi
@endcomponent
