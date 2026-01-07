@extends('app')

@section('title', 'Payments')

@section('content')
    <div class="vh-100-custom mt-15 container">
        <div class="d-flex align-items-center justify-content-center mb-4">
            <div class="btn-glass px-4 py-3">
                <h5 class="text-white text-shadow text-center mb-2"><span class="fw-bold">Total Payments Collected by {{ $collector }} in {{ $date }}:</span> {{ count($response) }}</h5>
                <h5 class="text-white text-center text-shadow mb-0"><span class="fw-bold">Total Amount:</span> ${{ array_sum(array_column($response, 'amount')) }}</h5>
            </div>
        </div>
        <table class="glass-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Amount</th>
                    <th>Collector</th>
                    <th>Date Collected</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($response as $item)
                    <tr>
                        <td>{{ $item['username'] }}</td>
                        <td>{{ $item['fullname'] }}</td>
                        <td>{{ $item['amount'] }}</td>
                        <td>{{ $item['collected_by'] }}</td>
                        <td>{{ $item['payment_date'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
