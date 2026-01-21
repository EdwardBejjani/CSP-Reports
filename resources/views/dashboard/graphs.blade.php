@extends('app')

@section('title', 'Graphs')

@section('content')
    <div class="vh-100-custom mt-15 mx-3">
        @include('dashboard.graph_ticket_filter')
        <div class="row">
            <div class="col-md-6">
                <div class="glass-table">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="glass-table">
                    <canvas id="technicianChart"></canvas>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="glass-table">
                    <canvas id="supportChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="glass-table">
                    <canvas id="problemChart"></canvas>
                </div>
            </div>
        </div>
        <div class="row mt-4 justify-content-center">
            <div class="col-md-6">
                <div class="glass-table">
                    <canvas id="dateChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tickets = @json($tickets);

            // Status Pie Chart
            const statusCounts = tickets.reduce((acc, ticket) => {
                acc[ticket.status] = (acc[ticket.status] || 0) + 1;
                return acc;
            }, {});

            const statusChartCtx = document.getElementById('statusChart').getContext('2d');
            new Chart(statusChartCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(statusCounts),
                    datasets: [{
                        label: 'Tickets by Status',
                        data: Object.values(statusCounts),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: 'white'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Tickets by Status',
                            color: 'white'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'white'
                            }
                        },
                        x: {
                            ticks: {
                                color: 'white'
                            }
                        }
                    }
                }
            });

            // Technician Bar Chart
            const technicianCounts = tickets.reduce((acc, ticket) => {
                acc[ticket.technician] = (acc[ticket.technician] || 0) + 1;
                return acc;
            }, {});

            const technicianChartCtx = document.getElementById('technicianChart').getContext('2d');
            new Chart(technicianChartCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(technicianCounts),
                    datasets: [{
                        label: '# of Tickets',
                        data: Object.values(technicianCounts),
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'white'
                            }
                        },
                        x: {
                            ticks: {
                                color: 'white'
                            }
                        }
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: 'white'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Tickets per Technician',
                            color: 'white'
                        }
                    }
                }
            });

            // Support Bar Chart
            const supportCounts = tickets.reduce((acc, ticket) => {
                acc[ticket.support] = (acc[ticket.support] || 0) + 1;
                return acc;
            }, {});

            const supportChartCtx = document.getElementById('supportChart').getContext('2d');
            new Chart(supportChartCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(supportCounts),
                    datasets: [{
                        label: 'Tickets by Support',
                        data: Object.values(supportCounts),
                        backgroundColor: 'rgba(153, 102, 255, 0.7)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'white'
                            }
                        },
                        x: {
                            ticks: {
                                color: 'white'
                            }
                        }
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: 'white'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Tickets by Support',
                            color: 'white'
                        }
                    }
                }
            });

            // Problem Pie Chart
            const problemCounts = tickets.reduce((acc, ticket) => {
                acc[ticket.problem] = (acc[ticket.problem] || 0) + 1;
                return acc;
            }, {});

            const problemChartCtx = document.getElementById('problemChart').getContext('2d');
            new Chart(problemChartCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(problemCounts),
                    datasets: [{
                        label: 'Tickets by Problem',
                        data: Object.values(problemCounts),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                            'rgba(255, 159, 64, 0.7)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: 'white'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Tickets by Problem',
                            color: 'white'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'white'
                            }
                        },
                        x: {
                            ticks: {
                                color: 'white'
                            }
                        }
                    }
                }
            });

            // Date Line Chart
            const dateCounts = tickets.reduce((acc, ticket) => {
                const date = new Date(ticket.created_at).toLocaleDateString();
                acc[date] = (acc[date] || 0) + 1;
                return acc;
            }, {});

            const sortedDates = Object.keys(dateCounts).sort((a, b) => new Date(a) - new Date(b));
            const sortedCounts = sortedDates.map(date => dateCounts[date]);

            const dateChartCtx = document.getElementById('dateChart').getContext('2d');
            new Chart(dateChartCtx, {
                type: 'line',
                data: {
                    labels: sortedDates,
                    datasets: [{
                        label: 'Tickets by Date',
                        data: sortedCounts,
                        backgroundColor: 'rgba(255, 159, 64, 0.7)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'white'
                            }
                        },
                        x: {
                            ticks: {
                                color: 'white'
                            }
                        }
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: 'white'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Tickets by Date',
                            color: 'white'
                        }
                    }
                }
            });
        });
    </script>
@endpush