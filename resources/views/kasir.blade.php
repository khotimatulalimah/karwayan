<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Transaksi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e9ecef;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 0 0 20px 20px;
            margin-bottom: 30px;
        }
        .container {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            padding: 12px 20px;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .table {
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .table td {
            background-color: #f8f9fa;
        }
        .modal-content {
            border-radius: 20px;
        }
        .modal-header {
            border-bottom: none;
        }
        .modal-title {
            color: #007bff;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Detail Data Transaksi</h1>
</div>

<div class="container">
    <div class="d-flex justify-content-between">
        <button id="addDataButton" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Tambah Transaksi
        </button>
        <button id="viewRevenueButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#revenueModal">
            <i class="fas fa-chart-line"></i> Lihat Pendapatan
        </button>
    </div>
    
    <!-- Modal for Form -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/create-post') }}" method="POST" id="dataForm">
                        @csrf
                        <input type="text" class="form-control mb-3" name="nama_karyawan" placeholder="Nama Karyawan" required>
                        <input type="text" class="form-control mb-3" name="nama_barang" placeholder="Nama Barang" required>
                        <input type="date" class="form-control mb-3" name="tanggal" required>
                        <input type="text" class="form-control mb-3" name="harga" placeholder="Harga" required inputmode="numeric" id="harga" oninput="calculateSubtotal()">
                        <input type="number" class="form-control mb-3" name="jumlah" placeholder="Jumlah" required id="jumlah" oninput="calculateSubtotal()">
                        <select name="metode_pembayaran" class="form-control mb-3" required>
                            <option value="" disabled selected hidden>Metode Pembayaran</option>
                            <option value="Cash">Cash</option>
                            <option value="Transfer">Transfer</option>
                        </select>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal for Revenue Calculation -->
    <div id="revenueModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pendapatan Berdasarkan Rentang Tanggal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="date" class="form-control mb-3" id="startDate" placeholder="Pilih Tanggal Awal" required>
                    <input type="date" class="form-control mb-3" id="endDate" placeholder="Pilih Tanggal Akhir" required>
                    <div class="d-flex justify-content-center">
                        <button id="calculateRevenueButton" class="btn btn-primary mt-3">Hitung Pendapatan</button>
                    </div>
                    <h5 id="revenueResult" class="mt-3"></h5>
                </div>
            </div>
        </div>
    </div>
    
    <table class="table table-bordered text-center mt-4">
        <thead>
            <tr>
                <th>Nama Karyawan</th>
                <th>Nama Barang</th>
                <th>Tanggal</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Metode Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->nama_karyawan }}</td>
                <td>{{ $post->nama_barang }}</td>
                <td>{{ $post->tanggal }}</td>
                <td>Rp. {{ number_format($post->harga, 0, ',', '.') }}</td>
                <td>{{ $post->jumlah }}</td>
                <td>Rp. {{ number_format($post->subtotal, 0, ',', '.') }}</td>
                <td>{{ $post->metode_pembayaran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    const addDataButton = document.getElementById('addDataButton');
    const modal = document.getElementById('myModal');

    addDataButton.addEventListener('click', () => {
        $(modal).modal('show');
    });

    const calculateRevenueButton = document.getElementById('calculateRevenueButton');
    calculateRevenueButton.addEventListener('click', calculateRevenue);

    function calculateRevenue() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        $.ajax({
            url: '/calculate-revenue',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                start_date: startDate,
                end_date: endDate
            },
            success: function(response) {
                document.getElementById('revenueResult').innerText = 'Total Pendapatan: Rp. ' + response.total.toLocaleString('id-ID');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghitung pendapatan.');
            }
        });
    }

    function calculateSubtotal() {
        const harga = parseFloat(document.getElementById('harga').value) || 0;
        const jumlah = parseFloat(document.getElementById('jumlah').value) || 0;
        const subtotal = harga * jumlah;
        // Assume there's an input field with id 'subtotal' to display the calculated subtotal
        document.getElementById('subtotal').value = subtotal; // Uncomment this if you have the subtotal input field
    }
</script>

</body>
</html>
