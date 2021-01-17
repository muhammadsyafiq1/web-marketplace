@extends('layouts.dashboard-user.index')

@section('title')
    Show Transaction
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">#{{ $transaction->transaction->transaction_code }}</h2>
            <p class="dashboard-subtitle">
                Transaction Details
            </p>
        </div>
        @if (session('info'))
            <div class="alert text-center text-white">
                <div class="alert-primary">
                    {{ session('info') }}
                </div>
            </div>
        @endif
        <!-- section content -->
        <div class="dashboard-content" id="transactionDetails">
            <div class="row">
                <form action="{{ route('transaction.update',$transaction->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <img src="/frontend/images/product-details-1.jpg" class="w-100 mb-3">
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">Customer name</div>
                                            <div class="product-subtitle">{{ $transaction->transaction->user->name }}</div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">Product name</div>
                                            <div class="product-subtitle">{{ $transaction->product->name }}</div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">Date of Transaction</div>
                                            <div class="product-subtitle">{{ date('d-M-y',strtotime($transaction->transaction->created_at)) }}</div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">Status</div>
                                            <div class="product-subtitle text-danger">
                                                {{ $transaction->shipping_status}}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">Total amount</div>
                                            <div class="product-subtitle">Rp. {{ number_format($transaction->price) }}</div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">Mobile</div>
                                            <div class="product-subtitle">{{ $transaction->transaction->user->phone_number }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <h5> Shipping Informations</h5>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">Address I</div>
                                            <div class="product-subtitle">{{ $transaction->transaction->user->address_one }}</div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">Address II</div>
                                            <div class="product-subtitle">{{ $transaction->transaction->user->address_one }}</div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="product-title">Province</div>
                                            <div class="product-subtitle">{{ App\Models\Province::find($transaction->transaction->user->provinces_id)->name }}</div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="product-title">kecamatan</div>
                                            <div class="product-subtitle">{{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name }}</div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="product-title">Kota</div>
                                            <div class="product-subtitle">{{ App\Models\District::find($transaction->transaction->user->districts_id)->name }}</div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">Postal code</div>
                                            <div class="product-subtitle">{{ $transaction->transaction->user->zip_code }}</div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">Country</div>
                                            <div class="product-subtitle">{{ $transaction->transaction->user->country }}</div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="product-title">Status</div>
                                            <select name="shipping_status" id="status" class="form-control" v-model="status">
                                                <option value="unpaid">Unpaid</option>
                                                <option value="pending">Pending</option>
                                                <option value="shipping">Shipping</option>
                                                <option value="success">Success</option>
                                            </select>
                                        </div>
                                        <template v-if="status == 'shipping'">
                                            <div class="col-md-3">
                                                <div class="product-title">Input resi</div>
                                                <input type="text" class="form-control" name="resi" v-model="resi">
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-success btn-block mt-4">
                                                    Update resi
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary mt-4">
                                        Save Now
                                    </button>
                                </div>
                            </div>
                        </div>                                    
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="/frontend/vendor/vue/vue.js"></script>
    <script>
        var transactionDetails = new Vue ({
            el: "#transactionDetails",
            data: {
                status: "{{ $transaction->shipping_status }}",
                resi: "#{{ mt_rand(100000000,999999999) }}"
            },
        })
    </script>
@endpush