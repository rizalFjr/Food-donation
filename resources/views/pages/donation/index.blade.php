@extends('layouts.default')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Donasi</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Donasi</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content-header -->
  
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Donasi</h3>
                    <div class="card-tools">
                        {{-- <a href="/donation/create" class="btn btn-tool pull-right">
                            <i class="fas fa-plus-square"></i> Tambah Data
                        </a> --}}
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-striped table-bordered table-hover table-datatable data-table">
                        <thead>
                            <tr>
                              <th class="text-center" style="width: 1%">#</th>
                              <th class="text-center">Tanggal Donasi</th>
                              <th class="text-center">Tanggal Pengambilan</th>
                              <th class="text-center">Member</th>
                              <th class="text-center">No Telp</th>
                              <th class="text-center">Email</th>
                              <th class="text-center">Status</th>
                              <th class="text-center" style="width: 20%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-data"></tbody>
                    </table>
                  </div>
              </div>
          </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection

@push('js')
    <script type="text/javascript">
        $(function () {
        
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('donation.index') }}",
                columns: [
                    {
                        data: "DT_RowIndex", 
                        name: "DT_RowIndex", 
                        class: "text-center", 
                        orderable: false, 
                        searchable: false,
                    },
                    {data: 'donation_date', name: 'donation_date'},
                    {data: 'pick_up_date', name: 'pick_up_date'},
                    {data: 'name', name: 'users.name'},
                    {data: 'no_telp', name: 'members.no_telp'},
                    {data: 'email', name: 'users.email'},
                    {data: 'status', name: 'donation_statuses.name'},
                    {
                        data: 'action', 
                        name: 'action',
                        class: 'text-center', 
                        orderable: false, 
                        searchable: false,
                    },
                ]
            });
        
        });
    </script>
@endpush

