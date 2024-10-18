<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> Edit Laporan </title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Custom CSS -->
        <style>
            body {
                background-color: #f8f9fa;
                font-family: 'Arial', sans-serif;
            }
            .container {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                max-width: 600px;
                margin: 40px auto;
            }
            h1 {
                text-align: center;
                color: #343a40;
                margin-bottom: 30px;
                font-size: 28px;
            }
            label {
                font-weight: bold;
            }
            input, button {
                border-radius: 5px;
            }
            button {
                background-color: #007bff;
                border: none;
                font-size: 16px;
                padding: 10px 20px;
                cursor: pointer;
            }
            button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">
            <h1>Edit Laporan</h1>
            <form action="{{ route('post.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_karyawan" class="form-label">Nama Karyawan:</label>
                    <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" value="{{ $post->nama_karyawan }}" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal:</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $post->tanggal }}" required>
                </div>
                <div class="mb-3">
                    <label for="pendapatan" class="form-label">Pendapatan:</label>
                    <input type="number" name="pendapatan" id="pendapatan" class="form-control" value="{{ $post->pendapatan }}" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
