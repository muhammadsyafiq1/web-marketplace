@extends('layouts.dashboard-user.index')

@section('title')
    Dashboard User
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Dashboard</h2>
            <p class="dashboard-subtitle">
                Look what you have made today
            </p>
        </div>
        <!-- section content -->
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dahboard-card-title">
                                Total Product
                            </div>
                            <div class="dashboard-card-subtitle">
                                {{ $product }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dahboard-card-title">
                                Revenue
                            </div>
                            <div class="dashboard-card-subtitle">
                                Rp. {{ number_format($revenue) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dahboard-card-title">
                                Total Transaction
                            </div>
                            <div class="dashboard-card-subtitle">
                                {{ $transactionCount }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 mt-2">
                    <h5 class="mb-3">
                        Recent Transaction
                    </h5>
                    @forelse ($sellTransaction as $sell)
                    <a href="{{ $sell->id }}" class="card card-list d-block">
                       <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="/frontend/images/dashboard-icon-product-1.png">
                                </div>
                                <div class="col-md-4">
                                    {{ $sell->product->name }}
                                </div>
                                <div class="col-md-3">
                                    {{ $sell->transaction->user->name }}
                                </div>
                                <div class="col-md-3">
                                    {{ date('d-M-y',strtotime($sell->created_at)) }}
                                </div>
                                <div class="col-md-1 d-none d-md-block">
                                    <img src="/frontend/images/dashboard-arrow-right.svg">
                                </div>
                            </div>
                        </div>
                       @empty
                        <div class="alert alert-primary">
                            <h5>Belum Ada Transaksi</h5>
                        </div>
                    </a>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection