@extends('layouts.backend.index')

@section('title')
    Shopping history
@endsection

@section('content')
<div class="container-fluid">
    <div class="dashboard-content">
        <div class="row">
            <div class="col-12 mt-2">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="pills-sell-tab" data-toggle="pill" href="#pills-sell" role="tab" aria-controls="pills-sell" aria-selected="true">Product Sold</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-buy-tab" data-toggle="pill" href="#pills-buy" role="tab" aria-controls="pills-buy" aria-selected="false">Buy a product</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-sell" role="tabpanel" aria-labelledby="pills-sell-tab">
                        @forelse ($sellTransaction as $transaction)
                        <a href="/dashboard-transaction-details.html" class="card card-list d-block" style="text-decoration: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{ Storage::url($transaction->product->gallery->first()->image ?? '') }}" class="w-100">
                                    </div>
                                    <div class="col-md-4">
                                        {{ $transaction->product->name }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ $transaction->transaction->user->name }} <br>
                                        <small class="text-muted">Buyer</small>
                                    </div>
                                    <div class="col-md-3">
                                        {{ date('d-M-y',strtotime($transaction->created_at)) }}
                                    </div>
                                    <div class="col-md-1 d-none d-md-block">
                                        <img src="/frontend/images/dashboard-arrow-right.svg">
                                    </div>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="col-12 text-center">
                            <div class="alert alert-success">
                                Anda Belum Menjual Apapun.
                            </div>
                        </div>
                        @endforelse
                    </div>
                    <div class="tab-pane fade" id="pills-buy" role="tabpanel" aria-labelledby="pills-buy-tab">
                        @forelse ($buyTransaction as $buy)
                        <a href="/dashboard-transaction-details.html" class="card card-list d-block" style="text-decoration: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{ Storage::url($buy->product->gallery->first()->image ?? '') }}" class="w-100">
                                    </div>
                                    <div class="col-md-4">
                                        {{ $buy->product->name }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ $buy->transaction->user->store_name }} <br>
                                        <small class="text-muted">Store</small>
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
                        @empty
                        <div class="col-12 text-center">
                            <div class="alert alert-success">
                                Anda Belum Menjual Apapun.
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection