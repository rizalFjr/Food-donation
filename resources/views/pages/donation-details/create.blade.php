@extends('layouts.default')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Makanan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/donation">Donasi</a></li>
            <li class="breadcrumb-item active">Makanan</li>
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
                    <h3 class="card-title">Form Tambah Makanan</h3>
                  </div>
                  <form action="{{ route('store-food') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <input type="hidden" class="form-control" id="donations_id" name="donations_id" placeholder="Enter name"  value="{{ $donation_id }}" required>
                      <input type="hidden" class="form-control" id="members_id" name="members_id" placeholder="Enter name"  value="{{ $members_id }}" required>
                      <div class="form-group">
                        <label for="donation_categories_id">Kategori</label>
                        <select class="form-control" id="donation_categories_id" name="donation_categories_id" value="{{ old('donation_categories_id') }}">
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="nama_barang">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Enter name"  value="{{ old('nama_barang') }}" required>
                      </div>
                      <div class="form-group">
                        <label for="jumlah">Jumlah <span class="text-danger">*</span></label>
                        <div class="row">
                          <div class="col-9">
                            <input type="number" class="form-control" min="1" id="jumlah" name="jumlah" placeholder="Enter jumlah"  value="{{ old('jumlah') }}" required>
                          </div>
                          <div class="col-3">
                            <select class="form-control" id="quantities_id" name="quantities_id" value="{{ old('quantities_id') }}">
                              @foreach ($quantities as $quantity)
                                <option value="{{ $quantity->id }}">{{ $quantity->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
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
                      <a class="btn btn-warning" href="{{ route('donation-details', $donation_id) }}">
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