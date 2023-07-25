@extends('admins.master')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">All courses</h1>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Duration</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
    @forelse ($courses as $course )
    <tr>
        <td>{{ $course->id }}</td>
        <td><img width="50" src="{{ asset('images/'.$course->image) }}" alt=""></td>
        <td>{{ $course->name }}</td>
        <td>{{ $course->email }}</td>
        <td>{{ $course->created_at->diffForHumans() }}</td>
        <td>{{ $course->updated_at->diffForHumans() }}</td>
        <td>
            <a class="btn btn-sm btn-primary" href="{{ route('admin.courses.edit', $course->id) }}"><i class="fas fa-edit"></i></a>
            <form class="d-inline" action="{{ route('admin.courses.destroy', $course->id) }}" method="POST">
                @csrf
                @method('delete')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure')"><i class="fas fa-trash"></i></button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="7" class="text-center">No data Found</td>
    </tr>
    @endforelse
</table>
{{ $courses->links() }}
@endsection
@section('js')
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })

    @if(session('msg'))
    Toast.fire({
        icon: '{{ session("type") }}',
        title: '{{ session("msg") }}'
    })
    @endif
</script>
@endsection
