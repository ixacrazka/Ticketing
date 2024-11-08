<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pengaduan</title>
  @vite('resources/css/app.css')
  <!-- STYLE BUAT BANNER -->
  <style>
    /* Custom styles for blue navbar */
    .navbar {
        transition: transform 0.3s ease-in-out;
        font-family: 'Poppins', sans-serif; /* Apply Poppins font */
    }

    .navbar-hidden {
        transform: translateY(-100%);
    }

    /* Banner styling */
    .banner {
        position: relative;
        height: 64vh; /* Adjust height as needed */
        overflow: hidden; /* Ensure no overflow */
        background-color: #1d3557; /* Blue background for the banner *
        color: #ffffff; /* White text color */
        font-family: 'Poppins', sans-serif; /* Apply Poppins font */
    }

    #banner-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.7; /* 70% opacity */
    }

    /* Other custom styles */
    .form-container {
        position: relative;
        top: -40px;
        z-index: 10;
        font-family: 'Poppins', sans-serif; /* Apply Poppins font */
    }


    /* Button styling */
    .btn-submit {
        color: #ffffff; /* Button text color */
        font-family: 'Poppins', sans-serif; /* Apply Poppins font */
    }
</style>
<!-- END STYLE BUAT BANNER-->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen bg-gray-100 font-Poopins">

  <nav id="navbar" class="fixed top-0 left-0 right-0 z-20 bg-blue-800 shadow-md navbar">
    <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="flex items-center flex-1 sm:items-stretch sm:justify-start">
          <div class="flex-shrink-0">
          <span class="text-2xl text-yellow-400">Ticket</span><span class="text-xl text-white">ing</span>
          </div>
        </div>
        <div class="sm:block sm:ml-6">
          <div class="flex justify-end space-x-4">
            <a href="/ceksts" class="px-3 py-2 text-sm font-medium text-white border border-white rounded-lg hover:bg-slate-100 hover:text-black">Cek Status Laporan</a>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div id="banner" class="flex items-center justify-center banner">
  <div class="relative z-10 flex flex-col items-center justify-center w-full h-full text-center bg-blue-600 bg-opacity-50">
    <h1 class="mb-4 text-2xl font-bold text-white sm:text-3xl md:text-4xl">Layanan Pemerintah</h1>
    <p class="text-base text-white sm:text-lg md:text-xl">Layanan untuk melaporkan keluhan kerusakan atau error terkait website Kota Bogor.</p>
  </div>
  </div>
  <div class="w-full max-w-4xl mx-auto form-container">
    <div class="p-8 bg-white rounded-lg shadow-lg">
      <h1 class="mb-6 text-2xl font-bold text-center text-gray-800">Form Pengaduan Laporan</h1>


      <form action="{{route ('tambah.store')}}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <div>
            <label for="npelapor" class="block text-sm font-medium text-gray-700">Nama Pelapor</label>
            <input type="text" id="npelapor" name="npelapor" required
              class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              @error('npelapor')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
          </div>
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" required
              class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              @error('email')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
          </div>
          <div>
            <label for="nohp" class="block text-sm font-medium text-gray-700">No HP</label>
            <input type="text" id="nohp" name="nohp" required
              class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              @error('nohp')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
          </div>
          <div>
            <label for="naplikasi" class="block text-sm font-medium text-gray-700">Nama Aplikasi</label>
            <input type="text" id="naplikasi" name="naplikasi" required
              class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              @error('naplikasi')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <!-- FORM instasi dan jenis pengaduan -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div>
        <label for="instansi" class="block text-sm font-medium text-gray-700">Pilih Unit Kerja</label>
        <select id="instansi" name="instansi_id" required
            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="" disabled selected>Pilih Instansi</option>
            @foreach($instansis as $unit)
                <option value="{{ $unit->kode }}">{{ $unit->nama_instansi }}</option>
            @endforeach
        </select>
       </div>
       <div>
        <label for="jenis" class="block text-sm font-medium text-gray-700">Pilih Jenis Pengaduan</label>
        <select id="jenis" name="jenis_id" required
            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="" disabled selected>Pilih Jenis</option>
            @foreach($jenis as $jns)
                <option value="{{ $jns->id }}">{{ $jns->jenis_pengaduan }}</option>
            @endforeach
          </select>
         </div>
        </div>

          <!-- laporan  -->
          <div>
            <label for="laporan" class="block text-sm font-medium text-gray-700">Isi Laporan Anda</label>
            <textarea id="laporan" name="laporan" rows="6" required
              class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
              @error('email')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
          </div>

          <!-- masukan foto -->
          <div>
            <label for="file_foto" class="block text-sm font-medium text-gray-700">Lampiran Laporan</label>
            <input type="file" id="file_foto" name="file_foto"
              class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
          <!-- tombol kiri -->
          <div>
            <button type="submit"
              class="w-full px-4 py-2 rounded-md btn-submit bg-blue-800 hover:bg-blue-700 hover:border border-black focus:outline-none focus:ring-2 focus:ring-blue-600 bg-blu focus:ring-opacity-50">
              Kirim Pengaduan
            </button>
          </div>
      </form>
    </div>
  </div>
  <div class="container p-5 mx-auto">
    <div class="container p-5 mx-auto">
      <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
          <!-- Card 1 -->
          <div class="p-6 text-center bg-white border-2 border-blue-300 rounded-lg shadow-lg hover:-translate-y-3 hover:shadow-xl hover:shadow-blue-400 transition-all duration-[550ms]">
              <i class="mb-3 text-3xl text-blue-800 fas fa-pencil-alt"></i>
              <h3 class="text-lg font-semibold text-blue-800">Tulis Laporan</h3>
              <p class="text-sm text-gray-600">Laporkan pengaduan Anda dengan jelas dan lengkap</p>
          </div>

          <!-- Card 2 -->
          <div class="p-6 text-center bg-white border-2 border-blue-300 rounded-lg shadow-lg hover:-translate-y-3 hover:shadow-xl hover:shadow-blue-400 transition-all duration-[550ms]">
              <i class="mb-3 text-3xl text-blue-800 fas fa-undo"></i>
              <h3 class="text-lg font-semibold text-blue-800">Proses Verifikasi</h3>
              <p class="text-sm text-gray-600">Pengaduan Anda akan diverifikasi sebelum ditindaklanjuti</p>
          </div>

          <!-- Card 3 -->
          <div class="p-6 text-center bg-white border-2 border-blue-300 rounded-lg shadow-lg hover:-translate-y-3 hover:shadow-xl hover:shadow-blue-400 transition-all duration-[550ms]">
              <i class="mb-3 text-3xl text-blue-800 fas fa-comments"></i>
              <h3 class="text-lg font-semibold text-blue-800">Proses Tindak Lanjut</h3>
              <p class="text-sm text-gray-600">Instansi akan menindaklanjuti laporan pengaduan Anda</p>
          </div>

         <!-- Card 4 -->
      <div class="p-6 text-center bg-white border-2 border-blue-300 rounded-lg shadow-lg hover:-translate-y-3 hover:shadow-xl hover:shadow-blue-400 transition-all duration-[550ms]">
         <i class="mb-3 text-3xl text-blue-800 fas fa-eye"></i> <!-- Ikon diubah menjadi melihat -->
         <h3 class="text-lg font-semibold text-blue-800">Pantau Laporan Anda</h3> <!-- Teks diubah -->
         <p class="text-sm text-gray-600">Ketahui perkembangan pengaduan yang telah Anda ajukan.</p> <!-- Teks diubah menjadi lebih baku -->
        </div>

        <!-- Card 5 -->
          <div class="p-6 text-center bg-white border-2 border-blue-300 rounded-lg shadow-lg hover:-translate-y-3 hover:shadow-xl hover:shadow-blue-400 transition-all duration-[550ms]">
              <i class="mb-3 text-3xl text-blue-800 fas fa-check"></i>
              <h3 class="text-lg font-semibold text-blue-800">Selesai</h3>
              <p class="text-sm text-gray-600">Laporan pengaduan Anda telah selesai diproses</p>
          </div>
      </div>
  </div>
</div>

  <footer class="py-20 mt-auto footer bg-blue-800 text-white">
    <div class="text-center">
      <p>&copy; 2024 Pemerintah Kota Bogor. All Rights Reserved.</p>
    </div>
  </footer>

</body>

</html>