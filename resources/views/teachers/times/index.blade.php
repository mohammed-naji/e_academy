@extends('teachers.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Available Times</h3>

            <a class="btn btn-success" href="{{ route('teacher.times.create') }}">Add new Time</a>

            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Day</th>
                    <th>Time From</th>
                    <th>Time To</th>
                    <th>Created At</th>
                    <th>Actios</th>
                </tr>
                @forelse ($times as $time )
                <tr>
                    <td>{{ $time->id }}</td>
                    <td>{{ $time->day }}</td>
                    <td>{{ $time->time_from }}</td>
                    <td>{{ $time->time_to }}</td>
                    <td>{{ $time->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('teacher.times.edit', $time->id) }}" class="btn btn-sm btn-success">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form class="d-inline" action="{{ route('teacher.times.destroy',$time->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No data Found</td>
                </tr>
                @endforelse
            </table>
            {{ $times->links() }}
        </div>
    </div>
</div>
@endsection
