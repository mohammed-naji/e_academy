@extends('teachers.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Courses Page</h3>

            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th>Created At</th>
                    <th>Students</th>
                </tr>
                @forelse ($courses as $course )
                <tr>
                    <td>{{ $course->id }}</td>
                    <td><img width="50" src="{{ asset('images/'.$course->image) }}" alt=""></td>
                    <td>{{ $course->{'name_'.app()->currentLocale()} }}</td>
                    <td>${{ $course->price }}</td>
                    <td>{{ $course->duration }}</td>
                    <td>{{ $course->created_at->diffForHumans() }}</td>
                    <td>
                        <a class="show_std" data-bs-toggle="modal" data-bs-target="#exampleModal" href="{{ route('teacher.course_students', $course->id) }}">Show Students</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No data Found</td>
                </tr>
                @endforelse
            </table>
            {{ $courses->links() }}

        </div>


    </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Student List</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
    $('.show_std').click(function() {
        var link = $(this).attr("href");
        $('.modal-body').html('');
        $.get({
            url: link,
            success: function(res) {
                res.forEach(el => {
                    // console.log(el);
                    let p = `<p>${el.name}</p>`
                    $('.modal-body').append(p)
                });
            }
        })
    })
</script>
@endsection
