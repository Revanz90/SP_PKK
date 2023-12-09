<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Data Bulanan</title>
</head>

<body>
    <div class="container" id="monthly-report">
        <div class="text-head text-center mt-3">
            <h3>Data Simpanan Bulanan Anda</h3>
            <h6>Simpan Pinjam Pemberdayaan Kesejahteraan Keluarga (PKK) Kelurahan Kalitirto, Berbah, Sleman</h6>
        </div>

        <div class="table-container mt-4">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Pilih Bulan
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Januari</a></li>
                    <li><a class="dropdown-item" href="#">Februari</a></li>
                    <li><a class="dropdown-item" href="#">Maret</a></li>
                    <li><a class="dropdown-item" href="#">April</a></li>
                    <li><a class="dropdown-item" href="#">Mei</a></li>
                    <li><a class="dropdown-item" href="#">Juni</a></li>
                    <li><a class="dropdown-item" href="#">Juli</a></li>
                    <li><a class="dropdown-item" href="#">Agustus</a></li>
                    <li><a class="dropdown-item" href="#">September</a></li>
                    <li><a class="dropdown-item" href="#">Oktober</a></li>
                    <li><a class="dropdown-item" href="#">November</a></li>
                    <li><a class="dropdown-item" href="#">Desember</a></li>
                </ul>
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
                    @foreach ($datas as $index => $data)
                        {{-- @dd($data) --}}
                        <tr>
                            <th>{{ $data->author_id }}</th>
                            <td>{{ $data->author_name }}</td>
                            <td>{{ $data->nominal_uang }}</td>
                            <td>{{ $data->created_at }}</td>
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
