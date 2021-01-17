@extends('layouts.dashboard-user.index')

@section('title')
    Store Setting
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Store setting</h2>
            <p class="dashboard-subtitle">
                Make store that profitable
            </p>
        </div>
        @if (session('info'))
            <div class="alert text-center pb-1 pt-1">
                <div class="alert-primary">
                    <h5 class="text-white">{{ session('info') }}</h5>
                </div>
            </div>
        @endif
        <!-- section content -->
        <div class="dashboard-content">
                <form action="{{ route('store.update','store.setting') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="store_name">Nama Toko</label>
                                        <input name="store_name" type="text" id="store_name"class="form-control" name="store_name" value="{{ $user->store_name }}">
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <label for="category_id">Kategori</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $user->category_id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Store</label>
                                        <p class="text-muted">
                                            Status toko :
                                        </p>
                                        <div class="custom-control custom-radio custom-control-inline">
                                        <input 
                                            value="1"
                                            type="radio" 
                                            name="store_status" 
                                            id="openStoreTrue" 
                                            class="custom-control-input"
                                            {{ $user->store_status == 1 ? 'checked' : '' }}
                                        />
                                        <label for="openStoreTrue" class="custom-control-label">
                                            Buka
                                        </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                        <input 
                                            value="0"
                                            type="radio" 
                                            name="store_status" 
                                            id="openStoreFalse"
                                            class="custom-control-input"
                                            {{ $user->store_status == 0 ? 'checked' : '' }}
                                        />
                                        <label for="openStoreFalse" class="custom-control-label">
                                            Sementara tutup
                                        </label>
                                        </div>
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