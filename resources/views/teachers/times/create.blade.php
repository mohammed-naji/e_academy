@extends('teachers.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Add new Available Times</h3>

            <a class="btn btn-success" href="{{ route('teacher.times.index') }}">All Times</a>

            <form class="mt-3" action="{{ route('teacher.times.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Day</label>
                    <input type="date" class="form-control @error('day') is-invalid @enderror" name="day" value="{{ old('day') }}" />
                    @error('day')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Time From</label>
                    <input type="time" class="form-control @error('time_from') is-invalid @enderror" name="time_from" value="{{ old('time_from') }}" />
                    @error('time_from')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Time From</label>
                    <input type="time" class="form-control @error('time_to') is-invalid @enderror" name="time_to" value="{{ old('time_to') }}" />
                    @error('time_to')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <button class="btn btn-success px-4">Save</button>
            </form>

        </div>
    </div>
</div>
@endsection
