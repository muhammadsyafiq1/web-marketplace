@extends('layouts.dashboard-user.index')

@section('title')
    Account
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">My account</h2>
            <p class="dashboard-subtitle">
                Update your current profile
            </p>
        </div>
        <!-- section content -->
        <div class="dashboard-content">
                <form action="{{ route('store.update','account') }}" method="POST" enctype="multipart/form-data" id="locations">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="name">Your name</label>
                                      <input type="text" id="name" class="form-control" name="name"value="{{ $user->name }}">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="addressOne">Email</label>
                                      <input type="email" id="email" class="form-control" name="email" value="{{ $user->email }}">
                                    </div>
                                  </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="address_one">Address 1</label>
                                    <input type="text" id="address_one" class="form-control" name="address_one" value="{{ $user->address_one }}">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="address_two">Address II</label>
                                    <input type="text" id="address_two" class="form-control" name="address_two"value="{{ $user->address_two }}">
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <label for="provinces_id">Provinsi</label>
                                  <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces" v-model="provinces_id">
                                    <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                                  </select>
                                  <select v-else class="form-control"></select>
                                </div>
                                <div class="col-md-4">
                                  <label for="regencies_id">Kecamatan</label>
                                  <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies" v-model="regencies_id">
                                    <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                                  </select>
                                  <select v-else class="form-control"></select>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="districts_id">Kota </label>
                                      <select name="districts_id" id="districts_id" class="form-control" v-if="districts" v-model="districts_id">
                                        <option v-for="district in districts" :value="district.id">@{{ district.name }}</option>
                                      </select>
                                      <select v-else class="form-control"></select>
                                    </div>
                                  </div>
                                <div class="col-lg-6">
                                  <label for="zip_code">Postal Code</label>
                                  <input 
                                    type="number" 
                                    class="form-control" 
                                    id="zip_code"
                                    value="{{ $user->zip_code }}"
                                    name="zip_code"
                                  />
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="phone_number">Number</label>
                                    <input 
                                      type="text" 
                                      id="phone_number" 
                                      class="form-control" 
                                      name="phone_number"
                                      value="{{ $user->phone_number }}"
                                    />
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <button class="btn btn-success px-4" type="submit">
                                        Save now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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