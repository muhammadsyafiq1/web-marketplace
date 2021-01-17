@extends('layouts.frontend.index')

@section('title')
    Category page
@endsection

@section('content')
<div class="page-content page-home">
    <!-- all categories -->
    <section class="store-trend-categories">
      <div class="container">
        <div class="row">
          <div class="col-12" data-aos="fade-up">
            <h5>All Categories</h5>
          </div>
          @foreach ($categories as $category)
          <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="100">
            <a href="{{ route('product.category',$category->slug) }}" class="component-categories d-block">
              <div class="categories-image">
                <img src="{{ Storage::url($category->photo) }}" alt="gadgets" class="w-100">
                <p class="categories-text">{{ $category->name }}</p>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </section>

      <!-- new product -->
    <section class="store-new-products">
      <div class="container">
        <div class="row">
          <div class="col-12" data-aos="fade-up">
            <h5>All Products</h5>
          </div>
        </div>
        <div class="row">
          @forelse ($products as $product)
          <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
            <a href="{{ route('detail',$product->slug) }}" class="component-products d-block">
              <div class="products-thumbnail">
                <div class="products-image" style="background-image: url('{{ Storage::url($product->gallery->first()->image) }}');">
                </div>
              </div>
              <div class="products-text">
                {{ $product->name }}
              </div>
              <div class="products-price">
                Rp. {{ number_format($product->price) }}
              </div>
            </a>
          </div>
          @empty
              <div class="col-12 text-center">
                <div class="alert alert-primary">
                  <h5 class="text-white">Product Categroy ini Belum Tersedia.</h5>
                </div>
              </div>
          @endforelse
        </div>
      </div>
    </section>
</div>
@endsection