<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Posts - SantriKoding.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: rgb(250, 246, 246)">
    
<div style="width: 100%; padding: 50px;">
    <a href="/tambah" class="btn btn-outline-dark" style="margin-bottom: 5px">Tambah</a>
   
    <table class="table table-bordered table table table-dark table-striped" style="width: 100%;margin-bottom: 40px;">
   
    <thead >
        <tr>
            <th style="text-align: center">Kode Buku</th>
            <th style="text-align: center">Judul</th>
            <th style="text-align: center">Tanggal Pinjam</th>
            <th style="text-align: center">Tanggal Kembali</th>
            <th style="text-align: center">Kondisi</th>
            <th style="text-align: center">Jumlah Denda</th>
            <th style="text-align: center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($result as $data)
            <tr>
                <td style="text-align: center">{{ $data->kode_buku }}</td>
                <td>{{ $data->judul }}</td>
                <td style="text-align: center">{{ $data->tgl_pinjam }}</td>
                <td style="text-align: center">{{ $data->tgl_kembali }}</td>
                <td style="text-align: center">{{ $data->kondisi }}</td>
                
                <td style="text-align: center">{{ $data->denda }}</td>
                
                <td >
                    <div style="display: flex;
                    justify-content: center;
                    align-items: center;">
                        <a href="{{ route('edit', $data->kode_buku) }}" class="btn btn-warning me-2" style="margin-right: 5px">Edit</a>
                
                        <form action="{{ route('hapus', $data->kode_buku) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </td>
                
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<br>
{{ $result->links() }}
</div>


                         
             
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

 

</body>
</html>