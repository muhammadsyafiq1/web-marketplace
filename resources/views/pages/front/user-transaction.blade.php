@extends('layouts.dashboard-user.index')

@section('title')
    History Transaction
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Transactions</h2>
            <p class="dashboard-subtitle">
                Big result start from teh small one
            </p>
        </div>
        <!-- section content -->
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12 mt-2">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="pills-sell-tab" data-toggle="pill" href="#pills-sell" role="tab" aria-controls="pills-sell" aria-selected="true">Sell product</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="pills-buy-tab" data-toggle="pill" href="#pills-buy" role="tab" aria-controls="pills-buy" aria-selected="false">Buy product</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-sell" role="tabpanel" aria-labelledby="pills-sell-tab">
                            @forelse ($sellTransaction as $sell)
                            <a href="{{ route('transaction.detail',$sell->id) }}" class="card card-list d-block">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="{{ Storage::url($sell->product->gallery->first()->image )}}" class="w-100">
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
                            </a>
                            @empty
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <div class="alert alert-primary">
                                            Belum ada Transaction
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="tab-pane fade" id="pills-buy" role="tabpanel" aria-labelledby="pills-buy-tab">
                            @foreach ($buyTransaction as $buy)
                            <a href="/dashboard-transaction-details.html" class="card card-list d-block">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="{{ Storage::url($buy->product->gallery->first()->image) }}" class="w-100">
                                        </div>
                                        <div class="col-md-4">
                                            {{ $buy->product->name }}
                                        </div>
                                        <div class="col-md-3">
                                            {{ $buy->transaction->user->name }}
                                        </div>
                                        <div class="col-md-3">
                                            {{ date('d-M-y',strtotime($buy->created_at)) }}
                                        </div>
                                        <div class="col-md-1 d-none d-md-block">
                                            <img src="/frontend/images/dashboard-arrow-right.svg">
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection