@extends('layouts.backend.index')

@section('title')
    Show Detail user
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="text-center">Show Profile "{{ $user->name }}"</h5>
                <hr>
                @if ($user->avatar)
                       <img src="{{ Storage::url($user->avatar) }}" style="width: 80px">
                    @else
                        <p>Avatar belum diset.</p>
                    @endif
                <div class="form-group mt-3">
                   <th>Name :</th>
                   <p>{{ $user->name }}</p>
                   <th>Roles :</th> 
                   <p>{{ $user->roles }}</p>
                   <th>Email :</th>
                   <p>{{ $user->email }}</p>
                   <th>Phone :</th>
                   <p>{{ $user->phone_number }}</p>
                   <th>Address I :</th>
                   <p>{{ $user->address_one }}</p>
                   <th>Address II :</th>
                   <p>{{ $user->address_two }}</p>
                   <th>Country :</th>
                   <p>{{ $user->country }}</p>
                   <th>Joined :</th>
                   <p>{{ date('d-M-y', strtotime($user->created_at)) }}</p>

                   <a href="{{ route('user.index') }}" class="btn btn-warning btn-sm mt-4">
                       <i class="fa fa-arrow-left text-white" ></i>
                   </a>
               </div>
            </div>
        </div>
    </div>
@endsection