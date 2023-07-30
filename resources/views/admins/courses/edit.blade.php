@extends('admins.master')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit course</h1>
<form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')

    @include('admins.courses._form')

    <button class="btn btn-info px-5"><i class="fas fa-save"></i> Update</button>

</form>
@endsection
