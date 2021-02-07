@extends('layouts.app')
@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Outcome</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Outcome</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Rincian</h3>
                        </div>
                        <div class="card-body">
                            @php
                                $outcome_total = 0;
                            @endphp
                            @foreach ($outcomes as $outcome)
                            @php
                                $outcome_total += $outcome->pay
                            @endphp
                            @endforeach
                            <h3>Total Pengeluaran : Rp. {{number_format($outcome_total,2)}}</h3>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Income</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{route('payment.outcomecreate')}}" class="btn btn-success">+ Add Outcome</a>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($outcomes as $outcome)
                                    <tr>
                                        <td>{{$outcome->date}}</td>
                                        <td>{{$outcome->description}}</td>
                                        <td>Rp. {{number_format($outcome->pay,2)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
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
