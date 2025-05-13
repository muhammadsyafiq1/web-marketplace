@extends('layouts.dashboard-user.index')

@section('title')
    Show Product
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">{{ $product->name }}</h2>
            <p class="dashboard-subtitle">
                Product details
            </p>
            @if (session('info'))
                <div class="alert alert-success">
                    {{ session('info') }}
                </div>
            @endif
        </div>
        <!-- section content -->
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('products.update', $product->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    {{-- NAME --}}
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="name">Product name</label>
                                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $product->name) }}">
                                            @error('name')
                                                <div class="invalid-feedback d-block">
                                                    <div class="alert alert-danger p-1">{{ $message }}</div>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- PRICE --}}
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="price">Product price</label>
                                            <input type="text" id="price" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $product->price) }}">
                                            @error('price')
                                                <div class="invalid-feedback d-block">
                                                    <div class="alert alert-danger p-1">{{ $message }}</div>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- CATEGORY --}}
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- STOCK --}}
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input type="text" id="stock" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock', $product->stock) }}">
                                            @error('stock')
                                                <div class="invalid-feedback d-block">
                                                    <div class="alert alert-danger p-1">{{ $message }}</div>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- DESCRIPTION --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="editor">{{ old('description', $product->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col text-right">
                                        <button class="btn-block btn-success px-4" type="submit">
                                            Save now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            {{-- <div class="row mt-3 mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form class="form-inline" action="{{ route('add.variant') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="">
                                        <select name="color_id" id="color_id" class="custom-select mb-2 mr-sm-2  @error('color_id') is-invalid @enderror" style="width: 200px;">
                                            <option disabled="true" selected="true">Choose Color</option>
                                            @foreach ($colors as $color)
                                                <option value="{{ $color->id }}">
                                                    {{ $color->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <select name="size_id" id="size_id" class="custom-select mb-2 mr-sm-2  @error('size_id') is-invalid @enderror" style="width: 200px;">
                                            <option disabled="true" selected="true">Choose Size</option>
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}">
                                                    {{ $size->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="number" name="stock" id="stock" value="{{ $product->productvariant->stock ?? 0 }}" placeholder="Enter Stock" class="form-control mb-2 mr-sm-2  @error('stock') is-invalid @enderror">
                                        <button type="submit" class="btn btn-primary mb-2 px-4">
                                            Add Now
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row mb-2 mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($product->gallery as $gallery)
                                <div class="col-md-4">
                                    <div class="gallery-container">
                                        <img src="{{ Storage::url($gallery->image) }}" class="w-100">
                                        <a href="{{ route('remove.image',$gallery->id) }}" class="delete-gallery">
                                            <img src="/frontend/images/icon-delete.svg">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-12">
                                    <form action="{{ route('galleries.store')}}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                            @error('image')
                                                <span class="invalid-feedback">
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                </span>
                                            @enderror
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input name="image" type="file" id="file" style="display: none;" onchange="form.submit()">
                                            <button class="btn btn-secondary btn-block mt-3" onclick="thisFileUpload()" type="button">
                                                Add Photo
                                            </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@push('scripts')
<script>
    function thisFileUpload() {
            document.getElementById("file").click();
        }
    </script>
@endpush
