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
                    <h3 class="card-title">Form Tambah Donasi </h3>
                  </div>
                  <form action="{{ route('donation.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label for="donation_date">Tanggal Donasi <span class="text-danger">*</span></label>
                        <div class="input-group date" id="donation_date" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#donation_date" id="donation_date" name="donation_date" value="{{ old('donation_date') }}" placeholder="Enter Tanggal Donation">
                          <div class="input-group-append" data-target="#donation_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="pick_up_date">Tanggal Pengambilan <span class="text-danger">*</span></label>
                        <div class="input-group date" id="pick_up_date" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#pick_up_date" id="pick_up_date" name="pick_up_date" value="{{ old('pick_up_date') }}" placeholder="Enter Tanggal Pengambilan">
                          <div class="input-group-append" data-target="#pick_up_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="members_id">Member <span class="text-danger">*</span></label>
                        <select class="form-control" id="members_id" name="members_id" placeholder="Enter member" value="{{ old('members_id') }}">
                          <option value="">-- Pilih Member --</option>
                          @foreach ($members as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="same_address">
                        <label class="form-check-label" for="same_address">Alamat sama</label>
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
                        <label for="Kode pos">Kode Pos</label>
                        <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Enter kode pos" value="{{ old('kode_pos') }}">
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="row">
                        <p><span class="text-danger">*</span> Wajib diisi</p>
                      </div>
                      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                      <a class="btn btn-warning" href="{{ route('donation.index') }}">
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
  <script src="{{ asset('js/backend/donation/add_donation.js') }}"></script>
@endpush