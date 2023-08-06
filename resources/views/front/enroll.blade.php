@extends('front.app')

@section('content')
    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url({{ asset('images/page-banner-2.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        {{-- @dump($course) --}}
                        <h2 class="text-center">Enroll In : {{ $course->name }}</h2>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <section id="corses-singel" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @if (session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                    @endif

                    <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $id }}"></script>
                    <form action="{{ route('payment', $course->id) }}" class="paymentWidgets" data-brands="VISA MASTER"></form>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
@stop
