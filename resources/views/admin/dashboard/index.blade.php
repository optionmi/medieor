@extends('layouts.coreui')

@section('content')
    <div class="body flex-grow-1">
        <div class="px-4 container-lg">
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
                            {{-- <div class="mx-3 btn-group btn-group-toggle" data-coreui-toggle="buttons">
                                    <input class="btn-check" id="option1" type="radio" name="options"
                                        autocomplete="off" />
                                    <label class="btn btn-outline-secondary"> Day</label>
                                    <input class="btn-check" id="option2" type="radio" name="options" autocomplete="off"
                                        checked="" />
                                    <label class="btn btn-outline-secondary active"> Month</label>
                                    <input class="btn-check" id="option3" type="radio" name="options"
                                        autocomplete="off" />
                                    <label class="btn btn-outline-secondary"> Year</label>
                                </div> --}}
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
        const labels = @json($data->pluck('title'));
        const data = @json($data->pluck('total'));
        document.addEventListener('DOMContentLoaded', function() {
            const mainChart = new Chart(document.getElementById("main-chart"), {
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
        });
    </script>
@endsection
