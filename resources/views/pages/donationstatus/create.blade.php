@extends('layouts.default')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Status Donasi</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Status Donasi</li>
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
                    <h3 class="card-title">Form Tambah Status Donasi</h3>
                  </div>
                  <form action="{{ route('donationstatus.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label for="name">Nama Status Donasi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Nama Status Donasi"  value="{{ old('name') }}" required>
                      </div>
                      <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Enter Deskripsi" value="{{ old('description') }}">
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="row">
                        <p><span class="text-danger">*</span> Wajib diisi</p>
                      </div>
                      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                      <a class="btn btn-warning" href="{{ route('donationstatus.index') }}">
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