
@extends('front.app')

@section('title', $teacher->name . ' Profile')

@section('css')
<style>
#calendar {
    max-width: 1100px;
    /* min-height: 300px; */
    margin: 40px auto;
}
</style>
@endsection

@section('content')
    <section id="page-banner" class="pt-105 pb-130 bg_cover" data-overlay="8" style="background-image: url({{ asset('images/page-banner-3.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2 class="text-center">{{ $teacher->name }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/teachers') }}">Teachers</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $teacher->name }}</li>
                            </ol>
                        </nav>
                    </div> <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    <div id='calendar'></div>
    <section id="teachers-singel" class="pt-70 pb-120 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8">
                    <div class="teachers-left mt-50">
                        <div class="hero">
                            <img src="{{ asset('images/'.$teacher->image) }}" alt="Teachers">
                        </div>
                        <div class="name">
                            <h6>{{ $teacher->name }}</h6>
                            <span>Vice chencelor</span>
                        </div>
                        <div class="social">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                            </ul>
                        </div>
                        <div class="description">
                            <p>{{ $teacher->bio }}</p>
                        </div>
                    </div> <!-- teachers left -->
                </div>
                <div class="col-lg-8">
                    <div class="teachers-right mt-50">
                        <ul class="nav nav-justified" id="myTab" role="tablist">

                            <li class="nav-item">
                                <a class="active" id="courses-tab" data-toggle="tab" href="#courses" role="tab" aria-controls="courses" aria-selected="false">Courses</a>
                            </li>
                            <li class="nav-item">
                                <a id="reviews-tab" data-toggle="tab" href="#Available" role="tab" aria-controls="reviews" aria-selected="false">Available Times</a>
                            </li>
                        </ul> <!-- nav -->
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                                <div class="courses-cont pt-20">
                                    <div class="row">

                                        @foreach ($teacher->courses as $course)
                                        <div class="col-md-6">
                                            <div class="singel-course mt-30">
                                                <div class="thum">
                                                    <div class="image">
                                                        <img src="{{ asset('images/'.$course->image) }}" alt="Course">
                                                    </div>
                                                    <div class="price">
                                                        <span>${{ $course->price }}</span>
                                                    </div>
                                                </div>
                                                <div class="cont border">
                                                    <ul>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                    <span>(20 Reviws)</span>
                                                    <br>
                                                    <a href="{{ route('course', $course->id) }}"><h4>{{ $course->{'name_'.app()->currentLocale()} }}</h4></a>
                                                    <div class="course-teacher">
                                                        <div class="thum">
                                                            <a href="#"><img src="{{ asset('images/'.$teacher->image) }}" alt="teacher"></a>
                                                        </div>
                                                        <div class="name">
                                                            <a href="teachers-singel.php"><h6>{{ $teacher->name }}</h6></a>
                                                        </div>
                                                        <div class="admin">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-user"></i><span>
                                            {{ $course->students->count() }}
                                                                </span></a></li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- singel course -->
                                        </div>
                                        @endforeach

                                    </div> <!-- row -->
                                </div> <!-- courses cont -->
                            </div>
                            <div class="tab-pane fade" id="Available" role="tabpanel" aria-labelledby="reviews-tab">
                                <div id='calendar'></div>
                            </div>
                        </div> <!-- tab content -->
                    </div> <!-- teachers right -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    {{-- @dump() --}}
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    eventClick: function(info) {
      var eventObj = info.event;

      if (eventObj.url) {
        alert(
          'Clicked ' + eventObj.title + '.\n' +
          'Will open ' + eventObj.url + ' in a new tab'
        );

        window.open(eventObj.url);

        info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
      } else {
        alert('Clicked ' + eventObj.title);
      }
    },
    // initialDate: '2023-07-15',
    events: {!! $events !!}
  });

  calendar.render();
});
</script>
@stop
