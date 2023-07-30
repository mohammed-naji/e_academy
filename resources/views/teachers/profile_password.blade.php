@extends('teachers.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Your Profile</h3>
            <form action="{{ route('teacher.profile_password') }}" method="POST">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Old Password</label>
                            <input type="password" name="old_password" placeholder="Old Password" class="form-control @error('old_password') is-invalid @enderror"/>
                            @error('old_password')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>New Password</label>
                            <input type="password" name="password" placeholder="New Password" class="form-control @error('password') is-invalid @enderror"
                            />
                            @error('password')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>confirm Password</label>
                            <input type="password" name="password_confirmation" placeholder="Password Confirmation" class="form-control"
                            />
                        </div>
                    </div>

                </div>

                <button class="btn btn-success">Save</button>

            </form>
        </div>
    </div>
</div>
@endsection
