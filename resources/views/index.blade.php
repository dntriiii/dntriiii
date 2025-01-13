@extends('layouts.main')

@section('title')
<title>Denshop | {{ $title }}</title>
@endsection
@section('css')
<style>
    :root {
        --pinkbg: #FFC0CB;
    }

    .carousel-caption {
        background-color: rgba(0, 0, 0, 0.5);
        padding: 20px;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .carousel-caption h1 {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .carousel-caption p {
        font-size: 18px;
        margin-bottom: 20px;
    }

    .btn-custom {
        color: white;
        background-color: rgba(0, 0, 0, 0.8);
    }

    .btn-custom:hover {
        background-color: var(--pinkbg);
    }
</style>
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content">
    <div class="container-fluid" style="margin-top: 100px; background-color: #d9d9d9;">

            <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-start bg-light">
                <div class="col-md-12 p-lg-5 mx-auto my-5" style="height: 300px; position: relative; z-index: 1; padding-left: 30px;">
                    <h1 class="display-4 fw-normal" style="font-family:Brush Script MT; margin-left: 700px;">Denshop</h1>
                    <p class="lead fw-normal" style="margin-left: 700px;">Menyediakan produk kecantikan skincare Terbaik!</p>
                    <!-- <a class="btn btn-outline-secondary" href="#">Coming soon</a> -->
                </div>
                <img src="/img/slebew.jpg" class="product-device" alt="">
            </div>
        </div>
    </section>
    <!-- Main content -->


    <section class="marketing" id="marketing">
        @include('layouts.sectionindex.marketing')
    </section>

    <div class="container">
        <hr class="featurette-divider">

        <section id="carousel">
            @include('layouts.sectionindex.carousel')
        </section>

        <section id="category">
            @include('layouts.sectionindex.category')
        </section>

        <hr class="featurette-divider">
        {{-- product album --}}

        <section id="product">
            @include('layouts.sectionindex.product')
        </section>
    </div>
</div>
@endsection