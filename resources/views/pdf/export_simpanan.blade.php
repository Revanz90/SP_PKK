<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Data Simpanan</title>
</head>

<body>
    <div class="container" id="monthly-report">
        <div class="text-head text-center mt-3">
            <h3>Laporan Data Simpanan</h3>
            <h6>Simpan Pinjam Pemberdayaan Kesejahteraan Keluarga (PKK) Kelurahan Kalitirto, Berbah, Sleman</h6>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Anggota</th>
                <th>Nama Anggota</th>
                <th>Nominal</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($savings as $saving)
                <tr>
                    <th>{{ $saving->author_id }}</th>
                    <td>{{ $saving->author_name }}</td>
                    <td>{{ $saving->nominal_uang }}</td>
                    <td>{{ $saving->tanggal_transfer }}</td>
                    <td>Diterima</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
