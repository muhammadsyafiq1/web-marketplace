@extends('layouts.frontend.index')

@section('title')
    Register
@endsection

@section('content')
<div class="page-content page-auth">
    <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
                <div class="row align-items-center justify-content-center row-login mt-2" id="register">
                    <div class="col-lg-4">
                        <h2>
                            Memulai jual beli <br>
                            dengan cara terbaru.
                        </h2>
                        <form action="{{ route('register') }}" class="mt-3" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    class="form-control @error('name') is-invalid @enderror"
                                    autofocus
                                    name="name"
                                    v-model="name"
                                />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input 
                                    type="text" 
                                    id="email" 
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror" 
                                    v-model="email"
                                />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- password --}}
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    class="form-control @error('password') is-invalid @enderror"
                                    required
                                    name="password"
                                    autocomplete="new-password"
                                />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- confirmation --}}
                            <div class="form-group">
                            <label for="password_confirmation">Konfirmasi password</label>
                            <input 
                                type="text" 
                                id="password_confirmation" 
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"/>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Store</label>
                                <p class="text-muted">
                                    Apakah anda ingin membuka toko ?
                                </p>
                                <div class="custom-control custom-radio custom-control-inline">
                                <input 
                                    type="radio" 
                                    name="is_store_open" 
                                    id="openStoreTrue" 
                                    v-model="is_store_open" 
                                    class="custom-control-input" 
                                    :value="true"
                                    value="1"
                                />
                                <label for="openStoreTrue" class="custom-control-label">
                                    Iya, boleh
                                </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                <input 
                                    type="radio" 
                                    name="is_store_open" 
                                    id="openStoreFalse" 
                                    v-model="is_store_open" 
                                    class="custom-control-input" 
                                    :value="false"
                                    value="0"
                                />
                                <label for="openStoreFalse" class="custom-control-label">
                                    Enggak, Makasih
                                </label>
                                </div>
                            </div>
                            <div class="form-group" v-if="is_store_open">
                                <label for="store_name">Nama Toko</label>
                                <input 
                                    type="text" 
                                    id="store_name" 
                                    class="form-control"
                                    name="store_name"
                                />
                            </div>
                            <div class="form-group" v-if="is_store_open">
                                <label for="category">Kategori</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="0" selected disabled>Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-block btn-success mt-4" type="submit">
                                Sign Up
                            </button>
                            <button class="btn btn-block btn-signup mt-2" type="submit">
                                Back to sign in
                            </button>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <<script src="/frontend/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted@1.1.28/dist/vue-toasted.min.js"></script>
    <script>
        Vue.use(Toasted);
    
        var resgister = new Vue({
            el: '#register',
            mounted() {
                AOS.init();
            },
            data: {
                is_store_open: true,
                store_name: "",
            },
        });
    </script>
@endpush