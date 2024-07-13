@extends('layouts.coreui')

@section('content')
    <div class="body flex-grow-1">
        <div class="px-4 container-lg">

            <div class="mb-4 row g-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="text-white card bg-primary">
                        <div class="pb-0 card-body d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fs-3 fw-semibold">
                                    {{ $cardData->usersCount }}
                                </div>
                                <div>Users</div>
                            </div>
                        </div>
                        <div class="mx-3 mt-3 c-chart-wrapper" style="height: 70px">
                            <canvas class="chart" id="card-chart1" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-xl-3">
                    <div class="text-white card bg-info">
                        <div class="pb-0 card-body d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fs-3 fw-semibold">
                                    {{ $cardData->donationsCount }}
                                </div>
                                <div>Donations</div>
                            </div>
                        </div>
                        <div class="mx-3 mt-3 c-chart-wrapper" style="height: 70px">
                            <canvas class="chart" id="card-chart2" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-xl-3">
                    <div class="text-white card bg-warning">
                        <div class="pb-0 card-body d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fs-3 fw-semibold">
                                    {{ $cardData->groupsCount }}
                                </div>
                                <div>Groups</div>
                            </div>
                        </div>
                        <div class="mt-3 c-chart-wrapper" style="height: 70px">
                            <canvas class="chart" id="card-chart3" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-xl-3">
                    <div class="text-white card bg-danger">
                        <div class="pb-0 card-body d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fs-3 fw-semibold">
                                    {{ $cardData->postsCount }}
                                </div>
                                <div>Posts</div>
                            </div>
                        </div>
                        <div class="mx-3 mt-3 c-chart-wrapper" style="height: 70px">
                            <canvas class="chart" id="card-chart4" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="mb-4 card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0 card-title">Comments</h4>
                            <div class="small text-body-secondary">{{ date('F j, Y', strtotime(Carbon\Carbon::now())) }}
                            </div>
                        </div>
                        <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                            <div class="mx-3 btn-group btn-group-toggle" data-coreui-toggle="buttons">
                                {{-- <input class="btn-check" id="option1" type="radio" name="options" autocomplete="off" /> --}}
                                <button id="dayChartBtn" class="btn btn-outline-secondary chart-btn active"> Day</button>
                                {{-- <input class="btn-check" id="option2" type="radio" name="options" autocomplete="off" --}}
                                {{-- checked="" /> --}}
                                <button id="monthChartBtn" class="btn btn-outline-secondary chart-btn"> Month</button>
                                {{-- <input class="btn-check" id="option3" type="radio" name="options" autocomplete="off" /> --}}
                                <button id="yearChartBtn" class="btn btn-outline-secondary chart-btn"> Year</button>
                            </div>
                            {{-- <button class="btn btn-primary" type="button">
                                    <svg class="icon">
                                        <use
                                            xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-cloud-download') }}">
                                        </use>
                                    </svg>
                                </button> --}}
                        </div>
                    </div>
                    <div class="c-chart-wrapper" style="height: 300px; margin-top: 40px">
                        <canvas class="chart" id="main-chart" height="300"></canvas>
                    </div>
                </div>
                {{-- <div class="card-footer">
                        <div class="mb-2 text-center row row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 g-4">
                            <div class="col">
                                <div class="text-body-secondary">Visits</div>
                                <div class="fw-semibold text-truncate">29.703 Users (40%)</div>
                                <div class="mt-2 progress progress-thin">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 40%"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-body-secondary">Unique</div>
                                <div class="fw-semibold text-truncate">24.093 Users (20%)</div>
                                <div class="mt-2 progress progress-thin">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%"
                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-body-secondary">Pageviews</div>
                                <div class="fw-semibold text-truncate">78.706 Views (60%)</div>
                                <div class="mt-2 progress progress-thin">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 60%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-body-secondary">New Users</div>
                                <div class="fw-semibold text-truncate">22.123 Users (80%)</div>
                                <div class="mt-2 progress progress-thin">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 80%"
                                        aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col d-none d-xl-block">
                                <div class="text-body-secondary">Bounce Rate</div>
                                <div class="fw-semibold text-truncate">40.15%</div>
                                <div class="mt-2 progress progress-thin">
                                    <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
            </div>
            <!-- /.card-->
        </div>
    </div>
@endsection

@section('bottom-scripts')
    <!-- Plugins and scripts required by this view-->
    <script src="{{ asset('coreui/vendors/chart.js/js/chart.umd.js') }}"></script>
    <script src="{{ asset('coreui/vendors/@coreui/chartjs/js/coreui-chartjs.js') }}"></script>
    <script src="{{ asset('coreui/vendors/@coreui/utils/js/index.js') }}"></script>
    <script src="{{ asset('coreui/js/main.js') }}"></script>

    <script>
        const labels = @json($data->today->pluck('title'));
        const todayData = @json($data->today->pluck('total_comments'));
        const monthData = @json($data->month->pluck('total_comments'));
        const yearData = @json($data->year->pluck('total_comments'));
        let currentChart;

        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('main-chart').getContext('2d');

            // Initial chart creation
            currentChart = drawChart(ctx, labels, todayData);

            const dayChartBtn = document.getElementById('dayChartBtn');
            const monthChartBtn = document.getElementById('monthChartBtn');
            const yearChartBtn = document.getElementById('yearChartBtn');

            dayChartBtn.addEventListener('click', function() {
                if (currentChart) {
                    currentChart.destroy();
                }
                currentChart = drawChart(ctx, labels, todayData);
                setActiveButton(this);
            });

            monthChartBtn.addEventListener('click', function() {
                if (currentChart) {
                    currentChart.destroy();
                }
                currentChart = drawChart(ctx, labels, monthData);
                setActiveButton(this);
            });

            yearChartBtn.addEventListener('click', function() {
                if (currentChart) {
                    currentChart.destroy();
                }
                currentChart = drawChart(ctx, labels, yearData);
                setActiveButton(this);
            });

        });

        function setActiveButton(activeButton) {
            document.querySelectorAll('.chart-btn').forEach(button => {
                button.classList.remove('active');
            });
            activeButton.classList.add('active');
        }

        function drawChart(ctx, labels, data) {
            return mainChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [{
                            label: "Number of comments",
                            backgroundColor: `rgba(${coreui.Utils.getStyle("--cui-info-rgb")}, .1)`,
                            borderColor: coreui.Utils.getStyle("--cui-info"),
                            pointHoverBackgroundColor: "#fff",
                            borderWidth: 2,
                            data: data,
                            fill: true,
                        },
                        // {
                        //   label: "My Second dataset",
                        //   borderColor: coreui.Utils.getStyle("--cui-success"),
                        //   pointHoverBackgroundColor: "#fff",
                        //   borderWidth: 2,
                        //   data: [
                        //     random(50, 200),
                        //     random(50, 200),
                        //     random(50, 200),
                        //     random(50, 200),
                        //     random(50, 200),
                        //     random(50, 200),
                        //     random(50, 200),
                        //   ],
                        // },
                    ],
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        annotation: {
                            annotations: {
                                line1: {
                                    type: "line",
                                    yMin: 95,
                                    yMax: 95,
                                    borderColor: coreui.Utils.getStyle("--cui-danger"),
                                    borderWidth: 1,
                                    borderDash: [8, 5],
                                },
                            },
                        },
                        legend: {
                            display: false,
                        },
                    },
                    scales: {
                        x: {
                            grid: {
                                color: coreui.Utils.getStyle("--cui-border-color-translucent"),
                                drawOnChartArea: false,
                            },
                            ticks: {
                                color: coreui.Utils.getStyle("--cui-body-color"),
                            },
                        },
                        y: {
                            border: {
                                color: coreui.Utils.getStyle("--cui-border-color-translucent"),
                            },
                            grid: {
                                color: coreui.Utils.getStyle("--cui-border-color-translucent"),
                            },
                            ticks: {
                                beginAtZero: true,
                                color: coreui.Utils.getStyle("--cui-body-color"),
                                max: 250,
                                maxTicksLimit: 5,
                                stepSize: Math.ceil(250 / 5),
                            },
                        },
                    },
                    elements: {
                        line: {
                            tension: 0.4,
                        },
                        point: {
                            radius: 0,
                            hitRadius: 10,
                            hoverRadius: 4,
                            hoverBorderWidth: 3,
                        },
                    },
                },
            });
        }
    </script>
@endsection
