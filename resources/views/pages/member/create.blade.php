@extends('layouts.default')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Member</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Member</li>
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
                    <h3 class="card-title">Form Tambah Member</h3>
                  </div>
                  <form action="{{ route('members.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label for="name">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"  value="{{ old('name') }}" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"  value="{{ old('email') }}" required>
                      </div>
                      <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password"  value="{{ old('password') }}" required>
                      </div>
                      <div class="form-group">
                        <label for="no_telp">No Telp <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Enter no telp" value="{{ old('no_telp') }}" required>
                      </div>
                      <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Enter tempat lahir" value="{{ old('tempat_lahir') }}">
                      </div>
                      <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <div class="input-group date" id="tanggal_lahir" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#tanggal_lahir" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" placeholder="Enter tanggal lahir">
                          <div class="input-group-append" data-target="#tanggal_lahir" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter alamat" value="{{ old('alamat') }}">
                      </div>
                      <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <select class="form-control" id="provinsi" name="provinsi" placeholder="Enter provinsi" value="{{ old('provinsi') }}">
                          <!-- Generate on javascript -->
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="kota">Kota</label>
                        <select class="form-control" id="kota" name="kota" placeholder="Enter kota" value="{{ old('kota') }}" disabled>
                          <!-- Generate on javascript -->
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <select class="form-control" id="kecamatan" name="kecamatan" placeholder="Enter kecamatan" value="{{ old('kecamatan') }}" disabled>
                          <!-- Generate on javascript -->
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="kelurahan">Kelurahan</label>
                        <select class="form-control" id="kelurahan" name="kelurahan" placeholder="Enter kelurahan" value="{{ old('kelurahan') }}" disabled>
                          <!-- Generate on javascript -->
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="rw">RW</label>
                        <input type="text" class="form-control" id="rw" name="rw" placeholder="Enter rw" value="{{ old('rw') }}">
                      </div>
                      <div class="form-group">
                        <label for="rt">RT</label>
                        <input type="text" class="form-control" id="rt" name="rt" placeholder="Enter rt" value="{{ old('rt') }}">
                      </div>
                      <div class="form-group">
                        <label for="kode_pos">Kode Pos</label>
                        <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Enter kode pos" value="{{ old('kode_pos') }}">
                      </div>
                      <div class="form-group">
                        <label for="foto">Foto</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="foto" name="foto" placeholder="Enter foto" value="{{ old('foto') }}" accept="image/*">
                          <label class="custom-file-label" for="foto">Choose file</label>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="row">
                        <p><span class="text-danger">*</span> Wajib diisi</p>
                      </div>
                      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                      <a class="btn btn-warning" href="{{ route('members.index') }}">
                          <i class="fas fa-arrow-left"></i> Kembali
                      </a>
                    </div>
                  </form>
              </div>
          </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection

@push('js')
  <script src="{{ asset('js/backend/member/add_member.js') }}"></script>
@endpush