@extends('layouts.frontend.index')

@section('title')
    Detail Product
@endsection

@section('content')
<div class="page-content page-details">
    <!-- BREADCRUMB -->
    <section 
      class="store-breadcrumbs" 
      data-aos="fade-down" 
      data-aos-delay="100"
    >
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('home') }}">Home</a>
              </li>
              <li class="breadcrumb-item active">
                Product Detail
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    </section>

    <!-- gallery -->
    <section class="store-gallery" id="gallery">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <transition name="slide-fade" mode="out-in">
              <img 
                :src="image[activePhoto].url" 
                :key="image[activePhoto].id" 
                class=" main-image"
                style="width: 400px;"
                alt="activePhoto"
              />
            </transition>
          </div>
          <div class="col-lg-2" data-aos="zoom-in">
            <div class="row">
              <div 
                class="col-3 col-lg-12 mt-2 mt-lg-0"
                v-for="(photo, index) in image"
                :key="photo.id"
                data-aos="zoom-in"
                data-aos-delay="100"
                >
                <a href="#" @click="changeActive(index)">
                  <img 
                  :src="photo.url" 
                  class="w-100 thumbnail-image"
                  :class="{ active: index == activePhoto }"
                  alt="thumbnailPhoto"
                  />
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="store-detail-container" data-aos="fade-up">
      <section class="store-heading">
        <div class="container">
          <form action="{{ route('add.to.cart') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="row mt-3">
              <div class="col-lg-8">
                <h1>{{ $product->name }}</h1> 
                <div class="owner">Stock : {{ $product->productvariant->sum('stock') }}</div>
                <div class="owner">{{ $product->user->store_name }}</div>
                <div class="option">
                  <hr>
                  @if ($errors->any())
                      <div class="alert alert-danger" style="width: 350px;"> 
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                    <p class="text-muted">Attribute :</p>
                    @foreach ($product->productvariant as $productvariant) 
                      @if ($productvariant->stock > 1)
                        <label class="radio-inline"> 
                          <input type="radio" name="product_variant_id" value="{{ $productvariant->id }}" required>
                          {{ $productvariant->color->name }} (<small class="text-muted"> {{$productvariant->size->name}} , {{$productvariant->stock}} </small>)
                        </label>
                      @endif
                    @endforeach
                </div>
                <div class="price">Rp. {{ number_format($product->price) }}</div>
              </div>
              <div class="col-lg-2" data-aos="zoom-in">
                @auth
                  <button class="btn btn-primary px-4 text-white btn-block mb-3" type="submit">
                    Add to Cart
                  </button>
                  <a href="https://wasap.at/IG0trB" class="btn btn-success px-4 text-white btn-block mb-3" type="submit">
                    Pesan WA
                  </a>
                @else
                  <a href="{{ route('login') }}" 
                    class="btn btn-success px-4 text-white btn-block mb-3">
                    Login to Shop
                  </a>
                @endauth
              </div>
            </div>
          </form>
        </div>
      </section>
      <section class="store-description">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8">
              <h5 class="text-muted">Description</h5>
              <p>{!! $product->description !!}</p>
            </div>
          </div>
        </div>
      </section>
      <section class="store-review">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8 mt-3 mb-3">
              <h5>Customer Review ({{ $comentars->count() }})</h5>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-8">
              <ul class="list-unstyled">
                @forelse ($comentars as $comentar)
                <li class="media">
                  <img 
                    src="{{ Storage::url($comentar->user->avatar) }}" 
                    class="mr-3 rounded-circle"
                    alt="{{ $comentar->user->name  }}"
                  >
                  <div class="media-body">
                    <h5 class="mt-2 mb-1">{{ $comentar->user->name }}</h5>
                    {{ $comentar->content }}
                  </div>
                </li> 
                @empty
                    <div class="alert alert-primary text-center">
                      <h5 class="text-white">Belum Ada Review</h5>
                    </div>
                @endforelse
              </ul>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="/frontend/vendor/vue/vue.js"></script>
<script>
  var gallery = new Vue({
    el: "#gallery",
    mounted() {
      AOS.init();
    },
    data: {
      activePhoto: 0,
      image: [
        @foreach($product->gallery as $gallery)
        {
          id: {{ $gallery->id }},
          url: "{{ Storage::url($gallery->image) }}"
        },
        @endforeach
      ],
    },
    methods: {
      changeActive(id) {
        this.activePhoto = id;
      },
    },
  });
</script>
@endpush