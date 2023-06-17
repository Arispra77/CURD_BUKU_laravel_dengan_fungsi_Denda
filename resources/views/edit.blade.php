<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Edit Data</title>
</head>
<body>
    @include('sweetalert::alert')
<style>
    .center-div {
        background-color: rgb(197, 178, 178);
        margin: auto;
        height: 500px;
	    width: 500px;
        margin-top: 50px;
     }
     .dalam{
        margin: 20px;
        padding-top: 20px;
     }
</style>

    <div class="center-div">
    <form action="{{ route('update', $buku->kode_buku) }}" method="POST">
    {{ csrf_field() }}

    <div class="dalam">

   
    <div class="input-group mb-3" >
    <h1>Edit Data</h1>
    </div>

 
    <div class="input-group mb-3">
    <span class="input-group-text" style="width: 170px;">KODE BUKU</span>
        <input type="text" class="form-control" name="kode_buku" id="kode_buku" value="{{ $buku->kode_buku }}" readonly>
        
    </div>
    @if ($errors->has('judul'))
    <span class="text-danger">{{ $errors->first('judul') }}</span>
@endif
        <div class="input-group mb-3">
        <span class="input-group-text" style="width: 170px;">JUDUL</span>
        <input type="text" class="form-control" name="judul" id="judul" value="{{ $buku->judul }}">
        </div>
      
    
        @if ($errors->has('tgl_pinjam'))
        <span class="text-danger">{{ $errors->first('tgl_pinjam') }}</span>
    @endif
        <div class="input-group mb-3">
        <span class="input-group-text" style="width: 170px;">TANGGAL PINJAM</span>
        <input type="date" name="tgl_pinjam" id="tgl_pinjam" value="{{ $sirkulasi->tgl_pinjam }}">
        
        </div>

        @if ($errors->has('tgl_kembali'))
        <span class="text-danger">{{ $errors->first('tgl_kembali') }}</span>
    @endif
        <div class="input-group mb-3">
        <span class="input-group-text" style="width: 170px;">TANGGAL KEMBALI</span>
       <input type="date" name="tgl_kembali" id="tgl_kembali" value="{{ $sirkulasi->tgl_kembali }}">
       
        </div>

        @if ($errors->has('kondisi'))
            <span class="text-danger">{{ $errors->first('kondisi') }}</span>
        @endif
        <div class="input-group mb-3">
        <span class="input-group-text" style="width: 170px;">KONDISI</span>

        <select name="kondisi" id="kondisi">
            
            <option value="BAIK" {{ $sirkulasi->kondisi === 'BAIK' ? 'selected' : '' }}>Baik</option>
            <option value="RUSAK" {{ $sirkulasi->kondisi === 'RUSAK' ? 'selected' : '' }}>Rusak</option>
        </select>
        
        </div>
        <!-- Form lainnya -->
        <input type="submit" value="Update Data" class="btn btn-success">
        
        <a href="{{ route('index') }}" class="btn btn-primary">Kembali</a>
      
    </form>
</div>
    </div>
</body>
</html>
