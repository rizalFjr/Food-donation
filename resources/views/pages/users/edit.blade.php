@extends('layouts.default')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Users</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
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
                    <h3 class="card-title">Form Edit Users</h3>
                  </div>
                  <form action="{{ route('users.update', $item->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                      <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('name') ?? $item->name }}" class="form-control" id="name" name="name" placeholder="Enter name" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" value="{{ old('email') ?? $item->email }}" class="form-control" id="email" name="email" placeholder="Enter email" required>
                      </div>
                      <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" value="{{ old('password') }}" class="form-control" id="password" name="password" placeholder="(Biarkan kosong jika tidak ingin mengubah password.)">
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="row">
                        <p><span class="text-danger">*</span> Wajib diisi</p>
                      </div>
                      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                      <a class="btn btn-warning" href="{{ route('users.index') }}">
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