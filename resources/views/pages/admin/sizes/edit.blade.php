@extends('layouts.backend.index')

@section('title')
    Update Size
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('size.index') }}" class="mb-2 text-warning">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <form action="{{ route('size.update',$size->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name" value="{{ old('name') ? old('name') : $size->name }}">
                        @error('name')
                            <span class="invalid-feedback">
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-block btn-success mt-4">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection