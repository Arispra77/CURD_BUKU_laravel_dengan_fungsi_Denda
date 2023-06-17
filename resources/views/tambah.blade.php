<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
     
    <title>Tambah Data</title>
</head>
<body style="background-color: darkgray">
  
    
<style>
 
    .center-div {
        background: linear-gradient(to bottom, #410ecc, #00ff00, #c3c3cf);
        margin: auto;
        height: 700px;
	    width: 550px;
        margin-top: 50px;
     }
     .dalam{
        margin: 20px;
        padding-top: 20px;
     }
</style>

   
 <div class="center-div">
    <form action="/simpan" method="POST">
    {{ csrf_field() }}


<div class="dalam">
    @include('sweetalert::alert')
    <h1>Tambah Data</h1>
    <div class="input-group mb-3">
        <span class="input-group-text" style="width: 170px;">NBI</span>
    <input type="text" class="form-control"name="nbi" id="nbi">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" style="width: 170px;">KODE BUKU</span>
        <input type="text" class="form-control"name="kode_buku" id="kode_buku"  readonly>
    </div> 

    <div class="input-group mb-3">
        <span class="input-group-text" style="width: 170px;">TANGGAL PINJAM</span>
        <input type="date" class="form-control" name="tgl_pinjam" id="tgl_pinjam">
    </div>
       
 
    <div class="input-group mb-3">
        <span class="input-group-text" style="width: 170px;">TANGGAL KEMBALI</span>
        <input type="date"class="form-control" name="tgl_kembali" id="tgl_kembali">
    </div>
       
    <div class="input-group mb-3">
        <span class="input-group-text" style="width: 170px;">KONDISI</span>
       
        <select class="form-select" aria-label="Default select example"name="kondisi" id="kondisi" >
            <option selected>pilih kondisi</option>
            <option value="BAIK" >Baik</option>
            <option value="RUSAK">Rusak</option>
        </select>
    </div>


        <input type="hidden" name="denda" id="denda"required="required">
        
        <div class="input-group mb-3">
            <span class="input-group-text" style="width: 170px;">ISBN</span>
            <input type="text" class="form-control" name="isbn" id="isbn">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" style="width: 170px;">PENGARANG</span>
            <input type="text" class="form-control" name="pengarang" id="pengarang">
        </div>
       
        <div class="input-group mb-3">
            <span class="input-group-text" style="width: 170px;">JUDUL</span>
            <input type="text" class="form-control" name="judul" id="judul">
        </div>
        
        
        <div class="input-group mb-3">
            <span class="input-group-text" style="width: 170px;">TAHUN</span>
            <input type="text" class="form-control" name="tahun" id="tahun">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" style="width: 170px;">JUMLAH HALAMAN</span>
            <input type="number" class="form-control" name="jml_halaman" id="jml_halaman">
        </div>

        <input type="submit" value="Simpan Data" class="btn btn-success">
        <a href="/perpus" class="btn btn-primary">Kembali</a>
</div>
    </form>
 </div>

</body>
</html>
