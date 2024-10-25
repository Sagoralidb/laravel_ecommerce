{{--  Project2 --}}
@extends('layouts.admin')

@section('title','Admin Dashboad')

@section('css')
    
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{$totalPendding ? $totalPendding:'0'}}</h3>
    
                    <p>Pendding Orders</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="{{route('order.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{ $totalOrders ? $totalOrders : '' }}</h3>
    
                    <p>Total Order</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="{{route('order.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>{{$OrderCancelled ? $OrderCancelled :'0'}}</h3>
    
                    <p>Order Cancelled</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="{{route('order.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>{{$totalUser}}</h3>
    
                    <p>Total User</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="{{route('users.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-md-3">
                <div class="card card-primary collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title">Total Sale</h3>
    
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                      </button>
                    </div>
                    <!-- /.card-tools -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                   <h5>{{config('stripe.currency_symbol')}}{{number_format($totalRevenue ? $totalRevenue: '0',2)}}</h5> 
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <div class="col-md-3">
                <div class="card card-success collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title">Sale of ({{$currentMonthName}})</h3> {{-- Sale of This month --}}
                    
    
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                      </button>
                    </div>
                    <!-- /.card-tools -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <h5>{{ config('stripe.currency_symbol') }}{{ number_format($revenueThisMonth ? (float)$revenueThisMonth : 0, 2) }}</h5>
                        
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <div class="col-md-3">
                <div class="card card-info collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title">Last month sale({{$lastMonthName}})</h3> {{--Sale of last month--}}
    
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                      </button>
                    </div>
                    <!-- /.card-tools -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    {{-- <h5>{{config('stripe.currency_symbol')}}{{number_format($revenueLastMonth ? $revenueLastMonth: '',2)}}</h5> --}}
                    <h5>{{ config('stripe.currency_symbol') }}{{ number_format((float) ($revenueLastMonth ?? 0), 2) }}</h5>

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <div class="col-md-3">
                <div class="card card-danger collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title">Sale of last 30 day</h3>
    
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                      </button>
                    </div>
                    <!-- /.card-tools -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    {{-- <h5>{{config('stripe.currency_symbol')}}{{number_format($revenueLast_30_Dasy ? $revenueLast_30_Dasy: '',2)}}</h5> --}}
                    <h5>{{ config('stripe.currency_symbol') }}{{ number_format((float) ($revenueLast_30_Dasy ?? 0), 2) }}</h5>

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            
            
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{$totalProducts ? $totalProducts: ''}}</h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('products.index')}}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{$totalCustomer ? $totalCustomer:''}}</h3>
                        <p>Total Customers</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('users.index')}}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{$totalAdmin ? $totalAdmin:''}}</h3>
                        <p>Total Admin</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('users.index')}}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>	
   
    {{-- Visitor count  --}}
                    <div class="container">
                        <h1 class="mt-5">User Graph</h1>
                
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="card text-white bg-primary mb-3">
                                    <div class="card-header">Today's Visitors</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $todayVisitors }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <canvas id="visitorsChart"></canvas>
                            </div>
                        </div>
                
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <canvas id="deviceChart"></canvas>
                            </div>
                            <div class="col-md-6">
                                <canvas id="browserChart"></canvas>
                            </div>
                        </div>
                    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('scripts')
<script>
    const visitorsCtx = document.getElementById('visitorsChart').getContext('2d');
    const visitorsChart = new Chart(visitorsCtx, {
        type: 'line',
        data: {
            labels: @json(array_keys($dailyVisitors)),
            datasets: [{
                label: 'Daily Visitors',
                data: @json(array_values($dailyVisitors)),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const deviceCtx = document.getElementById('deviceChart').getContext('2d');
    const deviceChart = new Chart(deviceCtx, {
        type: 'doughnut',
        data: {
            labels: @json(array_keys($deviceData)),
            datasets: [{
                label: 'Device Types',
                data: @json(array_values($deviceData)),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        }
    });

    const browserCtx = document.getElementById('browserChart').getContext('2d');
    const browserChart = new Chart(browserCtx, {
        type: 'pie',
        data: {
            labels: @json(array_keys($browserData)),
            datasets: [{
                label: 'Browsers',
                data: @json(array_values($browserData)),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        }
    });
</script>
@endsection