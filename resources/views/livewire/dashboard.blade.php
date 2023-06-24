<div class="card">
    <div class="card-header border-0">
        <h3 class="card-title">Agent Balance Overview</h3>
        <div class="card-tools">

            <a href="#" class="btn btn-sm btn-tool">
                <i class="fas fa-bars">
                </i>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
            <p class="text-success text-xl"><i class="fas fa-money-bill    "></i>

            </p>
            <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                    <i class="fa fa-money text-success"></i> RS. {{ $wallet }}
                </span>
                <span class="text-muted">Total Credit</span>
            </p>
        </div>
        <!-- /.d-flex -->
        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
            <p class="text-warning text-xl">
                <i class="fas fa-box    "></i>
            </p>
            <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                    <i class="ion ion-android-arrow-up text-warning"></i> {{ $package }}
                </span>
                <span class="text-muted">Package</span>
            </p>
        </div>
        <!-- /.d-flex -->
        <div class="d-flex justify-content-between align-items-center mb-0">
            <p class="text-danger text-xl">
                <i class="ion ion-ios-people-outline"></i>
            </p>
            <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                    <i class="ion ion-android-arrow-up text-danger"></i> {{ $agents }}
                </span>
                <span class="text-muted">Agents</span>
            </p>
        </div>
        <!-- /.d-flex -->
    </div>
</div>
