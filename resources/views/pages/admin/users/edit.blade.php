@extends('layouts.backend.index')

@section('title')
    Update User
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('user.index') }}" class="mb-2 text-warning">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <form action="{{ route('user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="avatar">Avatar</label> <br>
                        @if ($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}">
                        @else
                            <i class="text-muted">Avatar belum diset.</i>
                        @endif
                        <input type="file" name="avatar" id="avatar" class="form-control @error('avatar') is-invalid @enderror">
                        <small class="text-muted">Kosongkan bila tidak ingin diubah.</small>
                        @error('avatar')
                            <div class="invalid-feedback">
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name" value="{{ old('name') ? old('name') : $user->name }}">
                        @error('name')
                            <span class="invalid-feedback">
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" value="{{ old('email') ? old('email') : $user->email }}"">
                        @error('email')
                            <span class="invalid-feedback">
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            </span>
                        @enderror
                    </div>
                    <label>Roles</label> <br>
                    <div class="form-check form-check-inline">
                        <input {{ $user->roles == 'admin' ? 'checked' : '' }} class="form-check-input" type="radio" name="roles" id="admin" value="admin">
                        <label class="form-check-label" for="admin">Admin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input {{ $user->roles == 'seller' ? 'checked' : '' }} class="form-check-input" type="radio" name="roles" id="seller" value="seller">
                        <label class="form-check-label" for="seller">Seller</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input  {{ $user->roles == 'customer' ? 'checked' : '' }} class="form-check-input" type="radio" name="roles" id="customer" value="customer">
                        <label class="form-check-label" for="customer">Customer</label>
                    </div>
                    <button type="submit" class="btn btn-block btn-success mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection