@extends('app')

@section('title', 'New Users')

@section('content')
    <div class="vh-100-custom mt-15 container">
        <table class="glass-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Shortname</th>
                    <th>Service Name</th>
                    <th>Created Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($response as $item)
                    <tr>
                        <td>{{ $item['username'] }}</td>
                        <td>{{ $item['shortname'] }}</td>
                        <td>{{ $item['servicename'] }}</td>
                        <td>{{ $item['created_datetime'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
