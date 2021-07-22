@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4> @yield('title') </h4>
            @include('partials.breadcrumb')
        </div>
    </div>
    <div class="col-sm-6">
        <div class="state-information d-none d-sm-block">
            <div class="state-graph">

            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-3 col-sm-6">
        <div class="card mini-stat bg-primary">
            <div class="card-body mini-stat-img">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-cube-outline float-end"></i>
                </div>
                <div class="text-white">
                    <h6 class="text-uppercase mb-3 font-size-16 text-white">Transactions</h6>
                    <h2 class="mb-4 text-white">{{ $sales }}</h2>
                    <!-- <span class="badge bg-info"> +11% </span> <span class="ms-2">From previous period</span> -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card mini-stat bg-primary">
            <div class="card-body mini-stat-img">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-buffer float-end"></i>
                </div>
                <div class="text-white">
                    <h6 class="text-uppercase mb-3 font-size-16 text-white">Takings</h6>
                    <h2 class="mb-4 text-white">${{ number_format(($revenue/100), 2) }}</h2>
                    <!-- <span class="badge bg-danger"> -29% </span> <span class="ms-2">From previous period</span> -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card mini-stat bg-primary">
            <div class="card-body mini-stat-img">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-tag-text-outline float-end"></i>
                </div>
                <div class="text-white">
                    <h6 class="text-uppercase mb-3 font-size-16 text-white">Average </h6>
                    <h2 class="mb-4 text-white">${{ number_format($average/100, 2) }}</h2>
                    <!-- <span class="badge bg-warning"> 0% </span> <span class="ms-2">From previous period</span> -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card mini-stat bg-primary">
            <div class="card-body mini-stat-img">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-briefcase-check float-end"></i>
                </div>
                <div class="text-white">
                    <h6 class="text-uppercase mb-3 font-size-16 text-white">Products Sold</h6>
                    <h2 class="mb-4 text-white">{{ $total }}</h2>
                    <!-- <span class="badge bg-info"> +89% </span> <span class="ms-2">From previous period</span> -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">

    <!-- <div class="col-xl-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Monthly Earnings</h4>

                <div class="row text-center mt-4">
                    <div class="col-6">
                        <h5 class="font-size-20">$56241</h5>
                        <p class="text-muted">Marketplace</p>
                    </div>
                    <div class="col-6">
                        <h5 class="font-size-20">$23651</h5>
                        <p class="text-muted">Total Income</p>
                    </div>
                </div>

                <div id="morris-donut-example" class="morris-charts morris-charts-height" dir="ltr"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Email Sent</h4>

                <div class="row text-center mt-4">
                    <div class="col-4">
                        <h5 class="font-size-20">$ 89425</h5>
                        <p class="text-muted">Marketplace</p>
                    </div>
                    <div class="col-4">
                        <h5 class="font-size-20">$ 56210</h5>
                        <p class="text-muted">Total Income</p>
                    </div>
                    <div class="col-4">
                        <h5 class="font-size-20">$ 8974</h5>
                        <p class="text-muted">Last Month</p>
                    </div>
                </div>

                <div id="morris-area-example" class="morris-charts morris-charts-height" dir="ltr"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Monthly Earnings</h4>

                <div class="row text-center mt-4">
                    <div class="col-6">
                        <h5 class="font-size-20">$ 2548</h5>
                        <p class="text-muted">Marketplace</p>
                    </div>
                    <div class="col-6">
                        <h5 class="font-size-20">$ 6985</h5>
                        <p class="text-muted">Total Income</p>
                    </div>
                </div>

                <div id="morris-bar-stacked" class="morris-charts morris-charts-height" dir="ltr"></div>
            </div>
        </div>
    </div> -->

</div>
@endsection