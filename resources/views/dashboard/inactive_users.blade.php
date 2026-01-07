@extends('app')

@section('title', 'Inactive Users')

@section('content')
    <div class="vh-100-custom mt-15 container">
        <table class="glass-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Shortname</th>
                    <th>Service Name</th>
                    <th>Deactivated on</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($response as $item)
                    <tr>
                        <td>{{ $item['username'] }}</td>
                        <td>{{ $item['shortname'] }}</td>
                        <td>{{ $item['servicename'] }}</td>
                        <td>{{ $item['last_act'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
