@extends('layouts.default')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Members</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Members</li>
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
                    <h3 class="card-title">{{ $item->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control-plaintext" value="{{ $item->name ?? 'Tidak ada data' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control-plaintext"  value="{{ $item->email ?? 'Tidak ada data' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telp</label>
                        <input type="text" class="form-control-plaintext" value="{{ $item->no_telp ?? 'Tidak ada data' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control-plaintext" value="{{ $item->tempat_lahir ?? 'Tidak ada data' }}">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="text" class="form-control-plaintext" value="{{ $item->tanggal_lahir ? date('d M Y', strtotime($item->tanggal_lahir)) : 'Tidak ada data' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control-plaintext" value="{{ $item->alamat ?? 'Tidak ada data' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="rw">RW</label>
                        <input type="text" class="form-control-plaintext" value="{{ $item->rw ?? 'Tidak ada data' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="rt">RT</label>
                        <input type="text" class="form-control-plaintext" value="{{ $item->rt ?? 'Tidak ada data' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kelurahan">Kelurahan</label>
                        <input type="text" class="form-control-plaintext" value="{{ $item->kelurahan ?? 'Tidak ada data' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <input type="text" class="form-control-plaintext" value="{{ $item->kecamatan ?? 'Tidak ada data' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kota">Kota</label>
                        <input type="text" class="form-control-plaintext" value="{{ $item->kota ?? 'Tidak ada data' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" class="form-control-plaintext" value="{{ $item->provinsi ?? 'Tidak ada data' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kode_pos">Kode Pos</label>
                        <input type="text" class="form-control-plaintext" value="{{ $item->kode_pos ?? 'Tidak ada data' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <div class="row">
                            <a id="image-click">
                                <img class="rounded" id="image-resource" src="{{ $item->foto ? asset('/uploads/images/photo-profile/'.$item->foto) : asset('/uploads/images/photo-profile/blank-photo-profile.png') }}" width="250" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-warning" href="{{ route('members.index') }}">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <a class="btn btn-success" href="{{ route('members.edit', $item->id) }}">
                        <i class="fas fa-pencil-alt"></i> Update
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
  <script src="{{ asset('js/backend/member/member.js') }}"></script>
@endpush