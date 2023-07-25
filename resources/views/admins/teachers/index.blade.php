@extends('admins.master')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">All Teachers</h1>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Eamil</th>
        <th>Join At</th>
        <th>Last Edit</th>
        <th>Actions</th>
    </tr>
    @forelse ($teachers as $teacher )
    <tr>
        <td>{{ $teacher->id }}</td>
        <td><img width="50" src="{{ asset('images/'.$teacher->image) }}" alt=""></td>
        <td>{{ $teacher->name }}</td>
        <td>{{ $teacher->email }}</td>
        <td>{{ $teacher->created_at->diffForHumans() }}</td>
        <td>{{ $teacher->updated_at->diffForHumans() }}</td>
        <td>
            <a class="btn btn-sm btn-primary" href="{{ route('admin.teachers.edit', $teacher->id) }}"><i class="fas fa-edit"></i></a>
            <form class="d-inline" action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST">
                @csrf
                @method('delete')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure')"><i class="fas fa-trash"></i></button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4">No data Found</td>
    </tr>
    @endforelse
</table>
{{ $teachers->links() }}
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
