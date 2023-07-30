@extends('admins.master')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add new course</h1>
<form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @include('admins.courses._form')

    <button class="btn btn-success px-5"><i class="fas fa-save"></i> Add</button>

</form>
@endsection
