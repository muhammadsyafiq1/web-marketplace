@extends('layouts.backend.index')

@section('title')
    Update Category
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('category.index') }}" class="mb-2 text-warning">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="photo">Photo</label> <br>
                        @if ($category->photo)
                            <img src="{{ Storage::url($category->photo) }}">
                        @else
                            <i class="text-muted">photo belum diset.</i>
                        @endif
                        <input type="file" name="photo" id="photo" class="form-control mt-3 @error('photo') is-invalid @enderror">
                        <small class="text-muted">Kosongkan bila tidak ingin diubah.</small>
                        @error('photo')
                            <div class="invalid-feedback">
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name" value="{{ old('name') ? old('name') : $category->name }}">
                        @error('name')
                            <span class="invalid-feedback">
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-block btn-success mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection