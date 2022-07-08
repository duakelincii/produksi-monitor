@extends('layouts.master')
@section('heading')
    <h1>Dashboard</h1>
@endsection
@section('content')
    <div class="row justify-content-beetwen">


        <!-- Jumlah Pasien Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="" class="text-decoration-none card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pesanan Baru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah['order_baru'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-address-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="" class="text-decoration-none card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pesanan Proses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah['proses'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-address-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="" class="text-decoration-none card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pesanan Siap Kirim</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah['siap_kirim'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-address-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="" class="text-decoration-none card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pesanan Selesai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah['selesai'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-address-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php $role = Auth::user()->role; ?>
    @if ($role == 'admin')
        <figure class="highcharts-figure">
            <div id="pendapatan"></div>
        </figure>
     @elseif ($role == 'manager')
        <figure class="highcharts-figure">
            <div id="pendapatan"></div>
        </figure>
    @endif


    <script type="text/javascript">
        var bulan = <?php echo json_encode($bulan); ?>;
        var pendapatan = <?php echo json_encode($pendapatan); ?>;
        Highcharts.chart('pendapatan', {
            title: {
                text: 'Pendapatan Penjualan Bulanan'
            },
            yAxis: {
                title: {
                    text: 'Pendapatan Bulanan'
                },
                labels : {
                    formatter: function(value, index, values) {
                        if (value === 0) {
                            value = "";
                            return value;
                        } else if (value < 1000000) {
                            return new Number(value);
                        } else if (value < 1000000000) {
                            return new Number(value / 1000000).toFixed(0) + 'jt';
                        } else if (value < 1000000000000) {
                            return new Number(value / 1000000000).toFixed(1) + 'M';
                        } else {
                            return new Number(value / 1000000000000).toFixed(0) + 'T';
                        }
                    },
                }
            },
            xAxis: {
                categories: bulan
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                },
                line:{
                    dataLabels: {
                        enabled: true,
                     },
                }
            },
            series: [{
                name: 'Nominal Pendapatan',
                data: pendapatan
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>
@endsection
