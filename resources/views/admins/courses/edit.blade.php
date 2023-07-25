@extends('admins.master')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Teacher</h1>
<form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $teacher->name) }}"
                />
                @error('name')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" placeholder="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $teacher->email) }}"
                />
                @error('email')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" placeholder="phone" class="form-control @error('phone') is-invalid @enderror"
                value="{{ old('phone', $teacher->phone) }}"
                />
                @error('phone')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image"  class="form-control @error('image') is-invalid @enderror"/>
                @error('image')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label>Experiance Years</label>
                <input type="number" name="ex_years" placeholder="Experiance Years" class="form-control @error('ex_years') is-invalid @enderror"
                value="{{ old('ex_years',$teacher->ex_years) }}"
                />
                @error('ex_years')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="mb-3">
                <label>Bio</label>
                <textarea name="bio" placeholder="Bio" class="form-control @error('bio') is-invalid @enderror" rows="5">{{ old('bio', $teacher->bio) }}</textarea>
                @error('bio')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>

    </div>

    <button class="btn btn-success px-5"><i class="fas fa-save"></i> Edit</button>

</form>
@endsection
