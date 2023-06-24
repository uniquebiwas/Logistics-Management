<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-capitalize">partition By Integrator</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="myChart"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-capitalize">partition By Integrator</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="barChart"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-capitalize">Partition By Agents</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="polarChart"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-capitalize">Partition By Status</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="latestChart"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/chart.js') }}"></script>
    <script>
        let labels = <?php echo $labels; ?>;
        let datas = {{ $datas }};
        let total = datas.reduce((first, last) => first + last, 0);
        let percentageData = datas.map(x => parseFloat((x / total) * 100).toPrecision(4));
        let color = ['#690B0C', '#FF7800', '#DD4A48', '#FAEEE7', '#612897', '#F2789F', '#D3DEDC', '#570530', '#FFC900',
            '#D6E5FA',

        ];
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: percentageData,
                    backgroundColor: color.slice(0, datas.length)

                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        let countryLabels = <?php echo $countryLabels; ?>;
        let countryDatas = {{ $countryDatas }};
        const ctxw = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(ctxw, {
            type: 'bar',
            data: {
                labels: countryLabels,
                datasets: [{
                    label: 'Top 10  Destinations',
                    data: countryDatas,
                    backgroundColor: ['#690B0C', '#FF7800', '#DD4A48', '#FAEEE7', '#612897', '#F2789F',
                        '#D3DEDC', '#570530', '#FFC900', '#D6E5FA'
                    ],
                    borderColor: ['#690B0C', '#FF7800', '#DD4A48', '#FAEEE7', '#612897', '#F2789F',
                        '#D3DEDC', '#570530', '#FFC900', '#D6E5FA'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },

            }
        });
    </script>

    <script>
        let agentLabels = <?php echo $agentLabels; ?>;
        let agentDatas = {{ $agentDatas }};
        const polar = document.getElementById('polarChart').getContext('2d');
        const polarChart = new Chart(polar, {
            type: 'bar',
            data: {
                labels: agentLabels,
                datasets: [{
                    label: ['Total Shipment'],
                    data: agentDatas,
                    backgroundColor: ['#690B0C', '#FF7800', '#DD4A48', '#FAEEE7', '#612897', '#F2789F',
                        '#D3DEDC', '#570530', '#FFC900', '#D6E5FA'
                    ],
                    borderColor: ['#690B0C', '#FF7800', '#DD4A48', '#FAEEE7', '#612897', '#F2789F',
                        '#D3DEDC', '#570530', '#FFC900', '#D6E5FA'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },

            }
        });
    </script>


    <script>
        let statusLabels = <?php echo $statusLabels; ?>;
        let statusDatas = {{ $statusDatas }};
        const latest = document.getElementById('latestChart').getContext('2d');
        const latestChart = new Chart(latest, {
            type: 'pie',
            data: {
                labels: statusLabels,
                datasets: [{
                    label: ['Shipment Status'],
                    data: statusDatas,
                    backgroundColor: ['#690B0C', '#FF7800', '#DD4A48', '#FAEEE7', '#612897', '#F2789F',
                        '#D3DEDC', '#570530', '#FFC900', '#D6E5FA'
                    ],
                    borderColor: ['#690B0C', '#FF7800', '#DD4A48', '#FAEEE7', '#612897', '#F2789F',
                        '#D3DEDC', '#570530', '#FFC900', '#D6E5FA'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },

            }
        });
    </script>

@endpush
