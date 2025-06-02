@extends('admin.layouts.app')

@section('title', 'Appointments')

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NO.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Submitted</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($appointments as $appointment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $appointment->first_name }} {{ $appointment->last_name }}</td>
                    <td>{{ $appointment->email }}</td>
                    <td>{{ $appointment->phone }}</td>
                    <td>{{ $appointment->subject }}</td>
                    <td>{{ $appointment->message }}</td>
                    <td>{{ $appointment->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No appointments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $appointments->links() }}
@endsection
