@extends('teachers.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Your Profile</h3>
            <form action="{{ route('teacher.profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ Auth::user()->name }}"
                            />
                            @error('name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" disabled name="email" placeholder="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ Auth::user()->email }}"
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
                            value="{{ Auth::user()->phone }}"
                            />
                            @error('phone')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Experiance Years</label>
                            <input type="number" name="ex_years" placeholder="Experiance Years" class="form-control @error('ex_years') is-invalid @enderror"
                            value="{{ Auth::user()->ex_years }}"
                            />
                            @error('ex_years')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image"  class="form-control @error('image') is-invalid @enderror"/>
                            <img width="80" src="{{ asset('images/'.Auth::user()->image) }}" alt="">
                            @error('image')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <a style="margin-top: 30px" class="btn btn-dark" href="{{ route('teacher.profile_password') }}">Change Password</a>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label>Bio</label>
                            <textarea maxlength="100" name="bio" placeholder="Bio" class="form-control @error('bio') is-invalid @enderror" rows="5">{{ Auth::user()->bio }}</textarea>
                            @error('bio')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                </div>

                <button class="btn btn-success">Save</button>

            </form>
        </div>
    </div>
</div>
@endsection
