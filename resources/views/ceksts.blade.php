<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Antrian</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <!-- STYLE FOR ANIMATED BACKGROUND -->
    <style>
        .banner {
            position: relative;
            height: 64vh;
            overflow: hidden;
            background-color: #1d3557;
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            transition: transform 0.3s ease-in-out;
            font-family: 'Poppins', sans-serif;
        }

        .navbar-hidden {
            transform: translateY(-100%);
        }

        * {
            padding: 0;
            margin: 0;
        }

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
        }
    </style>
    <!-- END STYLE FOR ANIMATED BACKGROUND-->
</head>

<body class="bg-white font-[Poppins] h-screen flex flex-col justify-center">
    <!-- SVG Background -->
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        width="100%" height="100%" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMax slice">
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
                <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="10s"
                    calcMode="spline" values="270 230; -334 180; 270 230" keyTimes="0; .5; 1"
                    keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0" repeatCount="indefinite" />
            </use>
            <use xlink:href='#wave' opacity=".6">
                <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="8s"
                    calcMode="spline" values="-270 230;243 220;-270 230" keyTimes="0; .6; 1"
                    keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0" repeatCount="indefinite" />
            </use>
            <use xlink:href='#wave' opacity=".9">
                <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="6s"
                    calcMode="spline" values="0 230;-140 200;0 230" keyTimes="0; .4; 1"
                    keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0" repeatCount="indefinite" />
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

    <form action="{{ route('ceksts') }}" method="post">
    @csrf
    <div class="flex items-center justify-center h-full mt-20 md:mt-0 relative z-10">
        <div class="container mx-auto p-10 max-w-md rounded-xl bg-white shadow-black">
            <h1 class="text-2xl font-bold mb-4 text-center">Cek Status Antrian</h1>
            <div class="flex justify-center mb-6">
                <input type="text" name="kode" id="kodeInput" class="border border-black p-2 w-2/3 rounded-md" placeholder="Kode Antrian" required>
                <button type="submit" class="bg-white border border-black hover:border-black p-2 ml-2 rounded-md">CEK</button>
            </div>

            @if (session('error'))
                <div class="text-red-500 text-center mb-4">
                    {{ session('error') }}
                </div>
            @elseif(isset($pengaduan))
                <div id="timeline" class="bg-white p-4 rounded-md shadow-xl">
                    <h2 class="text-xl font-semibold mb-3">Status Antrian</h2>
                    @if($pelapors && count($pelapors) > 0)
                        <ul class="timeline">
                            @foreach($pelapors as $ceksts)
                                <li class="mb-3">
                                    <div class="flex items-center mb-1">
                                        <span class="bg-blue-500 text-white rounded-full h-6 w-6 flex items-center justify-center text-sm">1</span>
                                        <h3 class="ml-3 text-base font-medium">{{ $ceksts->pengaduan->status->name }}</h3>
                                    </div>
                                    <p class="ml-9 text-gray-600 text-sm"> {{ $ceksts->pengaduan->keterangan ?? 'Mohon tunggu konfirmasi dari Petugas' }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-600 text-sm">Tidak ada status untuk kode ini.</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</form>

</body>

</html>
