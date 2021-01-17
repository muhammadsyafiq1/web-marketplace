@extends('layouts.backend.index')

@section('title')
    Product variant
@endsection

@section('content')
<style>
    .form-control:disabled, .form-control[readonly] {
    background-color: #ffffff;
    opacity: 1;
}
</style>
    <div class="container-fluid">
        <div class="card shadow mb-4">
                @if (session('info'))
                    <div class="alert alert-success">
                        {{ session('info') }}
                    </div>
                @endif
            <div class="card-body">
                <div class="row">
                    <h3 class="badge badge-success disabled">{{ $product->name }}</h3>
                </div>
                <div class="row mt-3 align-items-center">
                    <form class="form-inline" action="{{ route('product-variant.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <select name="color_id" id="color_id" class="custom-select mb-2 mr-sm-2  @error('color_id') is-invalid @enderror" style="width: 200px;">
                            <option value="0" disabled="true" selected="true">Choose Color</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}">
                                    {{ $color->name }}
                                </option>
                            @endforeach
                        </select>
                        <select name="size_id" id="size_id" class="custom-select mb-2 mr-sm-2  @error('size_id') is-invalid @enderror" style="width: 200px;">
                            <option value="0" disabled="true" selected="true">Choose Size</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">
                                    {{ $size->name }}
                                </option>
                            @endforeach
                        </select>
                        <input type="number" name="stock" id="stock" placeholder="Enter Stock" class="form-control mb-2 mr-sm-2  @error('stock') is-invalid @enderror">
                        <input type="number" name="price" id="price" placeholder="Enter price" class="form-control mb-2 mr-sm-2  @error('price') is-invalid @enderror">
                        <button type="submit" class="btn btn-primary mb-2 px-4">
                            Add Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <h5 class="text-center">Tambahkan Foto Product</h5>
                </div>
                <form action="{{ route('galleries.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="row mt-3 align-items-center">
                        <form class="form-inline" action="" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="file" name="image" id="image"class="form-control mb-2 mr-sm-2 @error('image') is-invalid @enderror" style="width: 500px;">
                            @error('image')
                                <span class="invalid-feedback">
                                    <div class="alert alert-danger" style="width: 500px;">
                                        {{ $message }}
                                    </div>
                                </span>
                            @enderror
                            <button type="submit" class="btn btn-primary mb-2 px-4">
                                Add Now
                            </button>
                        </form>
                    </div>
                </form>
                <div class="row p-2">
                    @foreach ($product->gallery as $gallery)
                        <div class="col-4">
                            <div class="gallery-container mt-3">
                                <a href="{{ route('galleries.delete-image',$gallery->id) }}" class="delete-gallery">
                                    <img src="/frontend/images/icon-delete.svg">
                                </a>
                                <img src="{{ Storage::url($gallery->image) }}" alt="">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card mt-3 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="crudtable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var datatable = $("#crudtable").DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax : '{!! url()->current() !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'size.name', name: 'size.name'},
                {data: 'color.name', name: 'color.name'},
                {data: 'price', name: 'price'},
                {data: 'stock', name: 'stock'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '15%'
                },
            ]
        })
    </script>
@endpush