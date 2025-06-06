@extends('layouts.frontend.index')

@section('title')
    Cart
@endsection

@section('content')
<div class="page-content page-details">
    <!-- BREADCRUMB -->
    <section
      class="store-breadcrumbs"
      data-aos="fade-down"
      data-aos-delay="100"
    >
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('home') }}">Home</a>
              </li>
              <li class="breadcrumb-item active">
                Cart
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    </section>

    <!-- table buyyer -->
    <section class="store-cart">
        <div class="container">
          @if (session('info'))
            <div class="alert alert-primary text-white" style="width: 350px;" data-aos="fade-down" data-aos-delay="100">
                {{ session('info') }}
            </div>
          @endif
            <div class="row" data-aos="fade-up" data-aos-delay="100">
              <div class="col-12 table-responsive">
                  <table class="table table-borderless table-cart">
                      <thead>
                          <tr>
                              <td>Image</td>
                              <td>Name &amp; Seller</td>
                              <td>Price</td>
                              <td>Menu</td>
                          </tr>
                      </thead>
                      <tbody>
                          @php
                              $total_price = 0;
                          @endphp
                          @forelse ($carts as $cart)
                          <tr>
                                <td style="width: 25%;">
                                    <img
                                    src="{{ Storage::url($cart->product->gallery->first()->image) }}"
                                    class="cart-image"
                                />
                                </td>
                                <td style="width: 35%;">
                                    <div class="product-title">{{ $cart->product->name }}</div>
                                    <div class="product-subtitle">{{ $cart->user->store_name }}</div>
                                </td>
                                <td style="width: 35%;">
                                    <div class="product-title">Rp. {{ number_format($cart->product->price) }}</div>
                                    <div class="product-subtitle">IDR</div>
                                </td>
                                <td style="width: 20%;">
                                    <a href="{{ route('delete.cart',$cart->id) }}" class="btn btn-remove-cart" onclick="return confirm('Yakin ingin Menghapus Item ?')">
                                        Remove
                                    </a>
                                </td>
                            </tr>
                            @php
                                $total_price += $cart->product->price;
                            @endphp
                          @empty
                              <div class="col-12 text-center">
                                <div class="alert alert-primary">
                                  <h5 class="text-white">Belanja Anda Kosong.</h5>
                                </div>
                              </div>
                          @endforelse
                      </tbody>
                  </table>
              </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="150">
                <div class="col-12">
                    <hr>
                </div>
                <div class="col-12">
                  <h2 class="mb-4">
                    Shipping Details
                  </h2>
                </div>
            </div>
            <form action="{{ route('proccess.checkout') }}" method="post" id="locations">
              @csrf
              <input type="hidden" name="total_price" value="{{ $total_price }}">
              <input type="hidden" name="country" value="indonesia">
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="address_one">Address 1</label>
                    <input type="text" id="address_one" class="form-control" name="address_one" required/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="address_two">Address II</label>
                    <input type="text" id="address_two" class="form-control" name="address_two" required/>
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="province">Province</label>
                  <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces" v-model="provinces_id" required>
                    <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                  </select>
                  <select v-else class="form-control"></select>
                </div>
                <div class="col-md-4">
                  <label for="regencies_id">Regencies</label>
                  <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies" v-model="regencies_id" required>
                    <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                  </select>
                  <select v-else class="form-control"></select>
                </div>
                <div class="col-md-4">
                  <label for="districts_id">Kecamatan</label>
                  <select name="districts_id" id="districts_id" class="form-control" v-if="districts" v-model="districts_id" required>
                    <option v-for="district in districts" :value="district.id">@{{ district.name }}</option>
                  </select>
                  <select v-else class="form-control"></select>
                </div>
                <div class="col-md-6">
                    <label for="zip_code">Postal Code</label>
                    <input type="number" class="form-control" id="zip_code" name="zip_code" required/>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone_number">Number</label>
                    <input type="number" class="form-control" id="phone_number" name="phone_number" required/>
                  </div>
                </div>
              </div>
              <div class="row" data-aos="fade-up" data-aos-delay="150">
                <div class="col-12">
                    <hr>
                </div>
                <div class="col-12">
                  <h2 class="mb-1">
                    Payment Information
                  </h2>
                </div>
              </div>
              <div class="row" data-aos="fade-up" data-aos-delay="200">
                <div class="col-4 col-md-2">
                  <div class="product-title">Rp. 10</div>
                  <div class="product-subtitle">Country Tax</div>
                </div>
                <div class="col-4 col-md-3">
                  <div class="product-title">Rp. 280</div>
                  <div class="product-subtitle">Product Insurance</div>
                </div>
                <div class="col-4 col-md-2">
                  <div class="product-title">Rp. 580</div>
                  <div class="product-subtitle">Ship to Jakarta</div>
                </div>
                <div class="col-4 col-md-2">
                  <div class="product-title text-success">Rp. {{ number_format($total_price) }}</div>
                  <div class="product-subtitle">Total</div>
                </div>
                <div class="col-8 col-md-3">
                  <button class="btn btn-success mt-4 px-4 btn-block" type="submit">
                    Checkout Now
                  </button>
                </div>
              </div>
            </form>
        </div>
    </section>
  </div>
@endsection

@push('scripts')
<script src="/frontend/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
  var locations = new Vue({
    el: "#locations",
    mounted() {
      AOS.init();
      this.getProvincesData();
      this.getRegenciesData();
    },

    data: {
      provinces: null,
      regencies: null,
      districts: null,
      provinces_id: null,
      regencies_id: null,
      districts_id: null,
    },

    methods: {
      getProvincesData(){
        var self = this;
        axios.get('{{ route('api.provinces') }}')
          .then(function(response){
            self.provinces = response.data;
        })
      },
      getRegenciesData(){
        var self = this;
        axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
          .then(function(response){
            self.regencies = response.data;
        })
      },
      getDistrictsData(){
        var self = this;
        axios.get('{{ url('api/districts') }}/' + self.regencies_id)
        .then(function(response){
          self.districts = response.data;
        })
      }
    },

    watch: {
      provinces_id: function(val, oldVal) {
        this.regencies_id = null;
        this.getRegenciesData();
      },
      regencies_id: function(val, oldval) {
        this.districts_id = null;
        this.getDistrictsData();
      }
    },

  });
</script>
@endpush
