@extends('layouts.frontend.index')

@section('title')
    Store
@endsection

@section('content')
<div class="page-content page-home">
  <!-- carousel image -->
  <section class="store-carousel">
    <div class="container">
      <div class="row">
        <div class="col-lg-12" data-aos="zoom-in">
          <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
              @foreach ($banners as $banner)
              @if ($banner->is_active == 1)
              <div class="carousel-item active">
                <img class="d-block w-100" src="{{ Storage::url($banner->banner) }}" alt="First slide">
              </div>
              @endif
              <div class="carousel-item">
                <img class="d-block w-100" src="{{ Storage::url($banner->banner) }}" alt="">
              </div>
              @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon text-dark" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- trend categories -->
  <section class="store-trend-categories">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>Trend Categories</h5>
        </div>
       @foreach ($categories as $category)
       <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="200">
            <a href="#" class="component-categories d-block">
              <div class="categories-image">
                <img 
                  src="{{ Storage::url($category->photo) }}" 
                  alt="make up" 
                  class="w-100"
                >
                <p class="categories-text">{{ $category->name }}</p>
              </div>
            </a>
        </div>
       @endforeach
    </div>
  </section>

  {{-- product terlaris --}}
  <section class="store-new-products">
    <div class="container">
      <div class="row" style="margin-top: 50px;">
        <div class="col-12" data-aos="fade-up">
          <h5>Product Terlaris</h5>
        </div>
      </div>
      <div class="row" style="margin-top: 20px">
        @forelse ($product_demands as $product)
        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
          <a href="{{ route('detail',$product->slug) }}" class="component-products d-block">
            <div class="products-thumbnail">
              <div 
                class="products-image" 
                style="
                  @if($product->gallery)
                    background-image: url('{{ Storage::url($product->gallery->first()->image) }}')
                  @else
                    background-image: #eee;
                  @endif
                ">
              </div>
              </div>
              <div class="products-text">
              </div>
              <div class="products-price">
                @if($product->productvariant)
                Rp. {{ number_format($product->price) }}
                @endif
              </div>
            </a>
          </div>
        @empty
          <div class="row text-center">
            <div class="col-12">
              <div class="alert alert-primary">
                Product Kosong
              </div>
            </div>
          </div>
        @endforelse
        </div>
      </div>
    </div>
  </section>

  <!-- new product -->
  <section class="store-new-products">
    <div class="container">
      <div class="row" style="margin-top: 50px;">
        <div class="col-12" data-aos="fade-up">
          <h5>Product terbaru</h5>
        </div>
      </div>
      <div class="row" style="margin-top: 20px;">
        @forelse ($products as $product)
        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
          <a href="{{ route('detail',$product->slug) }}" class="component-products d-block">
            <div class="products-thumbnail">
              <div 
                class="products-image" 
                style="background-image: url('{{ Storage::url($product->gallery->first()->image) }}');">
              </div>
              </div>
              <div class="products-text">
                {{ $product->name }} ({{ $product->productvariant->first()->stock }})
              </div>
              <div class="products-price">
                @if($product->productvariant)
                Rp. {{ number_format($product->price) }}
                @endif
              </div>
            </a>
          </div>
        @empty
          <div class="row text-center">
            <div class="col-12">
              <div class="alert alert-primary">
                Product Kosong
              </div>
            </div>
          </div>
        @endforelse
        </div>
        <div class="row">
          <div class="col-12">
            {{$products->links()}}
          </div>
        </div>
      </div>
    </div>
  </section>
  
</div>
@endsection