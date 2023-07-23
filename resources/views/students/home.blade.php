@extends('students.master')

@section('content')

<!-- WELCOME-->
<section class="welcome pt-5 p-t-10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title-4">Welcome back
                    <span>John!</span>
                </h1>
                <hr class="line-seprate">
            </div>
        </div>
    </div>
</section>
<!-- END WELCOME-->

<!-- STATISTIC-->
<section class="statistic statistic2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--green">
                    <h2 class="number">5</h2>
                    <span class="desc">Course</span>
                    <div class="icon">
                        <i class="zmdi zmdi-account-o"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--orange">
                    <h2 class="number">10</h2>
                    <span class="desc">Appointment</span>
                    <div class="icon">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END STATISTIC-->
@stop
