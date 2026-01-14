@extends('app')

@section('title', 'Payments')

@section('content')
    <div class="vh-100-custom mt-15 mx-3">
        <div class="d-flex align-items-center justify-content-center mb-4">
            <div class="btn-glass px-4 py-3">
                <h5 class="text-white text-shadow text-center mb-2"><span class="fw-bold">Total Payments Collected by
                        {{ $collector }} in {{ $date }}:</span> {{ count($allPayments) }}</h5>
                <h5 class="text-white text-center text-shadow mb-0"><span class="fw-bold">Total Amount:</span>
                    ${{ array_sum(array_column($allPayments, 'amount')) }}</h5>
            </div>
        </div>
        <div class="row row-cols-2">
            <div class="col">
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
                        @foreach ($payments as $item)
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
                <div class="mt-4">
                    {{ $payments->links() }}
                </div>
            </div>
            <div class="col">
                <canvas id="paymentsChart"></canvas>
                <canvas id="amountChart" class="mt-5"></canvas>
            </div>
        </div>
    </div>

    @php
        $carbonDate = \Carbon\Carbon::parse($date);
        $daysInMonth = $carbonDate->daysInMonth;

        $days = range(1, $daysInMonth);
        $counts = array_fill(0, $daysInMonth, 0);
        $amounts = array_fill(0, $daysInMonth, 0);

        foreach ($allPayments as $item) {
            $dayIndex = \Carbon\Carbon::parse($item['payment_date'])->format('j') - 1;
            $counts[$dayIndex]++;
            $amounts[$dayIndex] += $item['amount'];
        }
    @endphp
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('paymentsChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($days),
                        datasets: [{
                            label: '# of Payments',
                            data: @json($counts),
                            backgroundColor: 'rgba(255, 255, 255, 0.2)',
                            borderColor: 'rgba(255, 255, 255, 1)',
                            borderWidth: 1,
                            tension: 0.3
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                    color: 'white'
                                },
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)'
                                }
                            },
                            x: {
                                ticks: {
                                    color: 'white'
                                },
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    color: 'white'
                                }
                            }
                        }
                    }
                });
            }

            const amountCtx = document.getElementById('amountChart');
            if (amountCtx) {
                new Chart(amountCtx, {
                    type: 'line',
                    data: {
                        labels: @json($days),
                        datasets: [{
                            label: 'Amount Collected',
                            data: @json($amounts),
                            backgroundColor: 'rgba(255, 255, 255, 0.2)',
                            borderColor: 'rgba(255, 255, 255, 1)',
                            borderWidth: 1,
                            tension: 0.3
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: 'white'
                                },
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)'
                                }
                            },
                            x: {
                                ticks: {
                                    color: 'white'
                                },
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    color: 'white'
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
