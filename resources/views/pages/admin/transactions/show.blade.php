@extends('layouts.backend.index')

@section('title')
    Show Detail size
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="text-center">Show Transaction "{{ $transaction->transaction_code }}"</h5>
                        <div class="form-group mt-3">
                            <th>ID user :</th>
                            <span class="btn btn-success btn-sm disabled">{{ $transaction->user->id }}</span>
                            <br>
                            <hr>
                            <th>Shipping price :</th>
                            <p>{{ $transaction->shipping_price}}</p>
                            <th>Insurance price :</th>
                            <p>{{ $transaction->insurance_price }}</p>
                            <th>Total price :</th>
                            <p class="text-warning">{{ $transaction->total_price }}</p>
                            <th>User :</th>
                            <p>{{ $transaction->user->name }}</p>
                            <th>Created :</th>
                            <p>{{ date('d-M-y', strtotime($transaction->created_at)) }}</p>
                           <a href="{{ route('transaction.index') }}" class="btn btn-warning btn-sm mt-4">
                               <i class="fa fa-arrow-left text-white" ></i>
                           </a>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="text-center">Show Detail Transaction "{{ $transaction->transaction_code }}"</h5>
                        <br><hr>
                        <div class="form-group mt-3">
                            <th>Buy Product :</th>
                            <p>{{ $details->product->name}}</p>
                            <th>Price :</th>
                            <p>{{ $details->price}}</p>
                            <th>Shipping status :</th>
                            <p>{{ $details->shipping_status}}</p>
                            <th>Resi :</th>
                            <p>{{ $details->resi}}</p>
                            <th>Created :</th>
                            <p>{{ date('d-M-y', strtotime($transaction->created_at)) }}</p>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection