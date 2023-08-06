@extends('teachers.master')

@section('css')
<style>
    tr.success {
    background: #efffed;
}

tr.danger {
    background: #fff3f3;
}
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Appointment Page</h3>

            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Day</th>
                    <th>Created At</th>
                    <th>Actios</th>
                </tr>
                @forelse ($appointments as $appointment )
                <tr class="{{ $appointment->status == 1 ? 'success' : '' }} {{ $appointment->status == 2 ? 'danger' : '' }}">
                    <td>{{ $appointment->id }}</td>
                    <td>{{ $appointment->student->name }}</td>
                    <td>{{ $appointment->available_time->day??'' }}</td>
                    <td>{{ $appointment->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('teacher.appointment_status', [$appointment->id, 1]) }}" class="btn btn-sm btn-success">
                            <i class="fas fa-check"></i>
                        </a>
                        <a href="{{ route('teacher.appointment_status', [$appointment->id, 2]) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No data Found</td>
                </tr>
                @endforelse
            </table>
            {{ $appointments->links() }}
        </div>
    </div>
</div>
@endsection
