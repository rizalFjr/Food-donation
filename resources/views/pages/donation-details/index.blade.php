@extends('layouts.default')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Detail Donasi</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/donation">Donasi</a></li>
            <li class="breadcrumb-item active">Detail Donasi</li>
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
                    <h3 class="card-title">Detail Donasi</h3>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Data Donasi</h3>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-12">
                                <p><strong>#{{ $item->id }}</strong></p>
                              </div>
                              <div class="col-6">
                                <div class="row">
                                  <p>
                                    <div class="col-3">
                                      <strong>Tanggal Donasi</strong>
                                    </div>
                                    <div class="col-9">
                                      <strong>: </strong>{{ $item->donation_date ? date('d M Y H:i:s', strtotime($item->donation_date)) : 'Tidak ada data' }}
                                    </div>
                                  </p>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="row">
                                  <p>
                                    <div class="col-3">
                                      <strong>Tannggal Pengambilan</strong>
                                    </div>
                                    <div class="col-9">
                                      <strong>: </strong>{{ $item->pick_up_date ? date('d M Y', strtotime($item->pick_up_date)) : 'Tidak ada data' }}
                                    </div>
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Data Member</h3>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-6">
                                <div class="row">
                                  <p>
                                    <div class="col-3">
                                      <strong>Nama</strong>
                                    </div>
                                    <div class="col-9">
                                      <strong>: </strong>{{ $item->name ?? 'Tidak ada data' }}
                                    </div>
                                  </p>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="row">
                                  <p>
                                    <div class="col-3">
                                      <strong>Email</strong>
                                    </div>
                                    <div class="col-9">
                                      <strong>: </strong>{{ $item->email ?? 'Tidak ada data' }}
                                    </div>
                                  </p>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="row">
                                  <p>
                                    <div class="col-3">
                                      <strong>Nomor Telpon</strong>
                                    </div>
                                    <div class="col-9">
                                      <strong>: </strong>{{ $item->no_telp ?? 'Tidak ada data' }}
                                    </div>
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Data Alamat</h3>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-6">
                                <div class="row">
                                  <p>
                                    <div class="col-3">
                                      <strong>Alamat</strong>
                                    </div>
                                    <div class="col-9">
                                      <strong>: </strong>{{ $item->alamat ?? 'Tidak ada data' }}
                                    </div>
                                  </p>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="row">
                                  <p>
                                    <div class="col-3">
                                      <strong>RT / RW</strong>
                                    </div>
                                    <div class="col-9">
                                      <strong>: </strong>{{ $item->rt ?? 'Tidak ada data' }} / {{ $item->rw ?? 'Tidak ada data' }}
                                    </div>
                                  </p>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="row">
                                  <p>
                                    <div class="col-3">
                                      <strong>Kelurahan</strong>
                                    </div>
                                    <div class="col-9">
                                      <strong>: </strong>{{ $item->nama_kelurahan ?? 'Tidak ada data' }}
                                    </div>
                                  </p>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="row">
                                  <p>
                                    <div class="col-3">
                                      <strong>Kecamatan</strong>
                                    </div>
                                    <div class="col-9">
                                      <strong>: </strong>{{ $item->nama_kecamatan ?? 'Tidak ada data' }}
                                    </div>
                                  </p>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="row">
                                  <p>
                                    <div class="col-3">
                                      <strong>Kota</strong>
                                    </div>
                                    <div class="col-9">
                                      <strong>: </strong>{{ $item->nama_kota ?? 'Tidak ada data' }}
                                    </div>
                                  </p>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="row">
                                  <p>
                                    <div class="col-3">
                                      <strong>Provinsi</strong>
                                    </div>
                                    <div class="col-9">
                                      <strong>: </strong>{{ $item->nama_provinsi ?? 'Tidak ada data' }}
                                    </div>
                                  </p>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="row">
                                  <p>
                                    <div class="col-3">
                                      <strong>Kode Pos</strong>
                                    </div>
                                    <div class="col-9">
                                      <strong>: </strong>{{ $item->kode_pos ?? 'Tidak ada data' }}
                                    </div>
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Makanan</h3>
                            <div class="card-tools">
                              {{-- <a href="{{ route('create-food', $item->id) }}" class="btn btn-primary pull-right">
                                  <i class="fas fa-plus-square"></i> Tambah Data
                              </a> --}}
                          </div>
                          </div>
                          <div class="card-body">
                            <table class="table table-striped table-bordered table-hover table-datatable data-table" id="table-food">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 1%">#</th>
                                        <th class="text-center">Kategori Donasi</th>
                                        <th class="text-center">Nama Makanan</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center" style="width: 20%" >Foto</th>
                                        {{-- <th class="text-center" >Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody id="table-data"></tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Riwayat</h3>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-12 p-4">
                                @foreach ($histories as $history )
                                    @if ($loop->index == 0)
                                    <div class="row border border-success bg-success rounded mb-2 p-2">
                                    @else
                                    <div class="row border border-secondary rounded mb-2 p-2">
                                    @endif
                                    <div class="col-1 align-self-center">
                                      <p class="text-xl-center"><i class="fas fa-check"></i></p>
                                    </div>
                                    <div class="col-11">
                                      <p class="text-xl-left font-weight-bold">{{ $history->status }}</p>
                                      <p class="text-sm-left font-weight-light">{{ date('d F Y H:i:s', strtotime($history->histories_date)) }} oleh <span class="text-capitalize">{{ $history->user }}</span></p>
                                    </div>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                </div>
                <div class="card-footer">
                    <a class="btn btn-warning" href="{{ route('donation.index') }}">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
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
        
            var table = $('#table-food').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('get-foods', $item->id) }}",
                columns: [
                    {
                        data: "DT_RowIndex", 
                        name: "DT_RowIndex", 
                        class: "text-center", 
                        orderable: false, 
                        searchable: false,
                    },
                    {data: 'category', name: 'donation_categories.name'},
                    {data: 'nama_barang', name: 'nama_barang'},
                    {data: 'jumlah', name: 'jumlah'},
                    {data: 'image', name: 'image', class: "text-center", },
                    // {
                    //     data: 'action', 
                    //     name: 'action',
                    //     class: 'text-center', 
                    //     orderable: false, 
                    //     searchable: false,
                    // },
                ]
            });
        
        });
    </script>
@endpush