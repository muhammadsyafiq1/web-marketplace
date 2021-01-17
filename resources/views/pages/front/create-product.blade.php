@extends('layouts.dashboard-user.index')

@section('title')
    Create product
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Create new product</h2>
            <p class="dashboard-subtitle">
                Create your own product
            </p>
        </div>
        <!-- section content -->
        <div class="dashboard-content">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Product name</label>
                                    <input type="text" id="name"class="form-control" name="name">
                                </div> 
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" id="price"class="form-control" name="price">
                                </div> 
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group" >
                                    <label>Kategori</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="0" disabled selected>Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-grou">
                                    <label for="desc">Description</label>
                                    <textarea name="description" id="editor"></textarea>
                                    @error('description')
                                        <span class="invalid-feedback">
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="image">Thumbnails</label>
                                    <input type="file" id="image"class="form-control" name="image">
                                    <p class="text-muted">
                                        Kamu dapat memilih lebih dari satu foto
                                    </p>
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
</div>
@endsection