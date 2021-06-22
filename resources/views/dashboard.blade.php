@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            {{-- <i class="material-icons">content_copy</i> --}}
                            <i class="fas fa-money-bill-alt"></i>
                        </div>
                        <p class="card-category">Total Purchase</p>
                        <h3 class="card-title">&#2547; {{ $purchase_total }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="fas fa-info-circle" style="font-size: 18px;padding-right:5px"></i>
                            <a href="{{route('manage.purchase')}}">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            {{-- <i class="material-icons">store</i> --}}
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <p class="card-category">Total Sell</p>
                        <h3 class="card-title">&#2547; {{$sell_total}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="fas fa-info-circle" style="font-size: 18px;padding-right:5px"></i>
                            <a href="{{route('manage.sell')}}">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">info_outline</i>
                        </div>
                        <p class="card-category">Purchase Due</p>
                        <h3 class="card-title">&#2547; {{$due_total}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="fas fa-info-circle" style="font-size: 18px;padding-right:5px"></i>
                            <a href="{{route('manage.purchase')}}">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            {{-- <i class="fab fa-twitter"></i> --}}
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <p class="card-category">Invoice Due</p>
                        <h3 class="card-title">&#2547; {{ $sell_due}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="fas fa-info-circle" style="font-size: 18px;padding-right:5px"></i>
                            <a href="{{route('manage.sell')}}">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-chart">
                    <div class="card-header card-header-success">
                        <div class="ct-chart" id="dailySalesChart"></div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Daily Sales</h4>
                        <p class="card-category">
                            {{-- <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p> --}}
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated 4 minutes ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-chart">
                    <div class="card-header card-header-warning">
                        <div class="ct-chart" id="websiteViewsChart"></div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Daily Purchase</h4>
                        {{-- <p class="card-category">Last Campaign Performance</p> --}}
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated 4 minutes ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-chart">
                    <div class="card-header card-header-danger">
                        <div class="ct-chart" id="completedTasksChart"></div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Total Stocks</h4>
                        {{-- <p class="card-category">Last Campaign Performance</p> --}}
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated 4 minutes ago
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Top 5 Sell Product</h4>
                        <p class="card-category">Monthly Top 5 Sell of Product</p>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <th>Sl</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Vim Dishwashing Liquid</td>
                                    <td>164</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Teer Sugar 1 Kg Pack</td>
                                    <td>144</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Nescafe Original Coffee (Indonesia)</td>
                                    <td>132</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Sepnil Disinfectant Spray</td>
                                    <td>114</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>ACI Savlon Liquid Antiseptic</td>
                                    <td>109</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Top 5 Customer</h4>
                        <p class="card-category">Monthly Top 5 Customer Product Purchase</p>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Total</th>
                                <th>Address</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mr. Md Abul Bashar</td>
                                    <td>&#2547; 16,738</td>
                                    <td>Mirpur 10</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Mr. Rafiquzzaman</td>
                                    <td>&#2547; 15,344</td>
                                    <td>Mirpur 12</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Mr. Kamruzzaman</td>
                                    <td>&#2547; 13,982</td>
                                    <td>Mirpur 11</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Rezaul Karim</td>
                                    <td>&#2547; 13,735</td>
                                    <td>Mirpur 10</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Kamal Ahmed</td>
                                    <td>&#2547; 12,735</td>
                                    <td>Mirpur 11</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $.ajax({
                url: "/dailySale",
                method: "get",
                data: "",
                success: function(res) {
                    console.log(res);
                    // this.name(res);
                    md.initDashboardPageCharts(res);
                }
            });

      // Javascript method's body can be found in assets/js/demos.js
    //   md.initDashboardPageCharts();
    });
</script>
@endpush
