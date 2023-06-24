<div class="card">
    <div class="card-header border-transparent">
      <h3 class="card-title">Today's Shipment</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table m-0">
          <thead>
          <tr>
            <th>AWB</th>
            <th>Reference Number</th>
            <th>Total Weight</th>
          </tr>
          </thead>
          <tbody>
              @foreach ($shipment as $item)
              <tr>
                <td><a href="">#{{ $item['barcode'] }}</a></td>
                <td>{{ $item['package_name'] }}</td>
                <td><span class="badge badge-success">{{  $item['package_status']}}</span></td>
                <td>
                  <div class="sparkbar" data-color="#00a65a" data-height="20">{{ $item['total_weight'] }}</div>
                </td>
              </tr>
              @endforeach

          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
    <!-- /.card-body -->
    <!-- <div class="card-footer clearfix">
      <a href="{{ route('shipmentpackage.create') }}" class="global-btn">Create AWB</a>
    </div> -->
    <!-- /.card-footer -->
  </div>
