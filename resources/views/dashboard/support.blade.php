@extends('app')

@section('title', 'Support Tickets')

@section('content')
    <div class="vh-100-custom mt-15 mx-3">
        <h2 class="text-white text-center text-shadow fw-bold mb-4">Support Tickets</h2>
        <div class="d-flex justify-content-center mb-4">
            <form action="{{ route('dashboard.support') }}" method="GET" class="d-flex justify-content-center">
                <div class="input-group" style="width: auto !important;">
                    <input type="text" name="search" class="input" placeholder="Search by username, name, problem..."
                        value="{{ request('search') }}">
                    <button class="btn-glass fw-bold" type="submit">Search</button>
                </div>
            </form>
            <form action="{{ route('dashboard.support') }}" method="GET" class="d-flex justify-content-center ms-5">
                <div class="input-group" style="width: auto !important;">
                    <select name="status" class="input" onchange="this.form.submit()">
                        <option value="" disabled selected>All Statuses</option>
                        <option value="Open" {{ request('status') == 'Open' ? 'selected' : '' }}>Open</option>
                        <option value="Closed" {{ request('status') == 'Closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    <button class="btn-glass fw-bold" type="submit">Filter</button>
                </div>
            </form>
            <div class="input-group ms-5" style="width: auto !important;">
                <a href="{{ route('dashboard.graphs') }}" class="btn-glass fw-bold"><i class="fa fa-line-chart"></i>
                    Graphs</a>
            </div>
        </div>
        <table class="glass-table">
            <thead>
                <tr>
                    <th class="text-center text-white text-shadow fw-bold p-2">Username</th>
                    <th class="text-center text-white text-shadow fw-bold p-2">Name</th>
                    <th class="text-center text-white text-shadow fw-bold p-2">Problem</th>
                    <th class="text-center text-white text-shadow fw-bold p-2">Reason</th>
                    <th class="text-center text-white text-shadow fw-bold p-2">Solution</th>
                    <th class="text-center text-white text-shadow fw-bold p-2">Technician</th>
                    <th class="text-center text-white text-shadow fw-bold p-2">Support</th>
                    <th class="text-center text-white text-shadow fw-bold p-2">Shift</th>
                    <th class="text-center text-white text-shadow fw-bold p-2">Status</th>
                    <th class="text-center text-white text-shadow fw-bold p-2">Note</th>
                    <th class="text-center text-white text-shadow fw-bold p-2">Created on</th>
                    <th class="text-center text-white text-shadow fw-bold p-2">Closed on</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td class="text-white text-shadow p-2 text-center">{{ $ticket->username }}</td>
                        <td class="text-white text-shadow p-2 text-center">{{ $ticket->name }}</td>
                        <td class="text-white text-shadow p-2 text-center">{{ $ticket->problem }}</td>
                        <td class="text-white text-shadow p-2 text-center">{{ $ticket->reason ?: 'N/A'  }}</td>
                        <td class="text-white text-shadow p-2 text-center">{{ $ticket->solution ?: 'N/A' }}</td>
                        <td class="text-white text-shadow p-2 text-center">{{ $ticket->technician ?: 'N/A' }}</td>
                        <td class="text-white text-shadow p-2 text-center">{{ $ticket->support}}</td>
                        <td class="text-white text-shadow p-2 text-center">{{ $ticket->shift }}</td>
                        @if($ticket->status == "Open")
                            <td class="d-flex justify-content-center p-2"><div class="btn-danger">{{ $ticket->status }}</div></td>
                        @elseif ($ticket->status == "Closed")
                            <td class="d-flex justify-content-center p-2"><div class="btn-success">{{ $ticket->status }}</div></td>
                        @endif
                        <td class="text-white text-shadow p-2 text-center">{{ $ticket->note ?: 'N/A'  }}</td>
                        <td class="text-white text-shadow p-2 text-center">{{ $ticket->created_at }}</td>
                        @if ($ticket->status == "Closed")
                            <td class="text-white text-shadow p-2 text-center">{{ $ticket->updated_at }}</td>
                        @else
                            <td class="text-white text-shadow p-2 text-center">N/A</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $tickets->links() }}
        </div>
    </div>
@endsection
