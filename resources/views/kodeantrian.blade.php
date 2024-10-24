<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kode Antrian</title>
  @vite('resources/css/app.css')
  <!-- STYLE BUAT ANIMASI BACKGROUND -->
  <style>
    /* Background SVG animation */
    svg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      box-sizing: border-box;
      display: block;
      background-color: #0e4166;
      background-image: linear-gradient(to bottom, rgba(14, 65, 102, 0.86), #0e4166);
      z-index: -1; /* Make sure SVG is behind content */
    }
  </style>
  <!-- END STYLE BUAT ANIMASI BACKGROUND-->
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center relative">

  <!-- Background SVG animation -->
  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1600 900"
    preserveAspectRatio="xMidYMax slice">
    <defs>
      <linearGradient id="bg">
        <stop offset="0%" style="stop-color:rgba(130, 158, 249, 0.06)"></stop>
        <stop offset="50%" style="stop-color:rgba(76, 190, 255, 0.6)"></stop>
        <stop offset="100%" style="stop-color:rgba(115, 209, 72, 0.2)"></stop>
      </linearGradient>
      <path id="wave" fill="url(#bg)" d="M-363.852,502.589c0,0,236.988-41.997,505.475,0
      s371.981,38.998,575.971,0s293.985-39.278,505.474,5.859s493.475,48.368,716.963-4.995v560.106H-363.852V502.589z" />
    </defs>
    <g>
      <use xlink:href='#wave' opacity=".3">
        <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="10s" calcMode="spline"
          values="270 230; -334 180; 270 230" keyTimes="0; .5; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
          repeatCount="indefinite" />
      </use>
      <use xlink:href='#wave' opacity=".6">
        <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="8s" calcMode="spline"
          values="-270 230;243 220;-270 230" keyTimes="0; .6; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
          repeatCount="indefinite" />
      </use>
      <use xlink:href='#wave' opacity=".9">
        <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="6s" calcMode="spline"
          values="0 230;-140 200;0 230" keyTimes="0; .4; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
          repeatCount="indefinite" />
      </use>
    </g>
  </svg>

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
            <a href="/" class="px-3 py-2 text-sm font-medium text-white border border-white rounded-lg hover:bg-slate-100 hover:text-black block md:flex sm:block">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div class="flex flex-col items-center space-y-4 mt-10">
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg mb-10 text-center max-w-xs">
      <strong class="font-bold">Catatan: </strong>
      <span class="block sm:inline">Mohon Screenshot atau Catat Kode antrian Anda!! untuk Cek Status Laporan Anda.</span>
    </div>

    <!-- card menampilkan kode antrian -->
    <div class="bg-white shadow-md rounded-2xl p-6 max-w-xs text-center">
      <h1 class="text-2xl font-bold text-gray-800">Nomor Antrian</h1>
      <p class="text-gray-500 mt-2">Silakan menunggu giliran Anda.</p>

      <div class="mt-4">
        <span class="text-6xl font-extrabold text-blue-600">{{ $kode }}</span>
      </div>

      <div class="flex space-x-2 mt-3">
        <a href="/ceksts" class="px-3 py-2 bg-blue-600 text-white rounded-lg m-20 hover:bg-blue-700 transition">
          Cek Status Antrian
        </a>
      </div>
    </div>
  </div>

</body>
</html>
