<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forum Mahasiswa</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 font-sans">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-10">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <span class="text-2xl font-bold text-blue-700">Forum Mahasiswa</span>
            <ul class="flex space-x-6">
                <li><a href="#home" class="text-gray-700 hover:text-blue-600 font-medium">Home</a></li>
                <li><a href="#about" class="text-gray-700 hover:text-blue-600 font-medium">About</a></li>
                <li><a href="#contact" class="text-gray-700 hover:text-blue-600 font-medium">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Home Section -->
    <section id="home" class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-300">
        <div class="text-center px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold text-blue-800 mb-4">Selamat Datang di Forum Diskusi Mahasiswa</h1>
            <p class="text-lg md:text-xl text-blue-900 mb-8">Tempat terbaik untuk berdiskusi, berbagi ilmu, dan mengakses materi pelajaran kampus secara mudah dan interaktif.</p>
            <a href="#about" class="inline-block bg-blue-700 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-800 transition">Pelajari Lebih Lanjut</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-4 max-w-4xl">
            <h2 class="text-3xl font-bold text-blue-700 mb-6 text-center">Tentang Kami</h2>
            <p class="text-gray-700 text-lg mb-4 text-center">Forum Mahasiswa adalah platform yang didedikasikan untuk mendukung proses belajar mengajar di lingkungan kampus. Kami menyediakan ruang diskusi, tanya jawab, serta akses ke berbagai materi pelajaran yang dapat membantu mahasiswa dalam memahami materi perkuliahan.</p>
            <div class="flex flex-col md:flex-row gap-8 mt-10">
                <div class="flex-1 bg-blue-50 p-6 rounded-lg shadow text-center">
                    <h3 class="text-xl font-semibold text-blue-600 mb-2">Diskusi Interaktif</h3>
                    <p class="text-gray-600">Bertanya, berdiskusi, dan berbagi solusi bersama mahasiswa lain dari berbagai jurusan.</p>
                </div>
                <div class="flex-1 bg-blue-50 p-6 rounded-lg shadow text-center">
                    <h3 class="text-xl font-semibold text-blue-600 mb-2">Akses Materi</h3>
                    <p class="text-gray-600">Download dan upload materi kuliah, catatan, serta referensi belajar dengan mudah.</p>
                </div>
                <div class="flex-1 bg-blue-50 p-6 rounded-lg shadow text-center">
                    <h3 class="text-xl font-semibold text-blue-600 mb-2">Komunitas Mahasiswa</h3>
                    <p class="text-gray-600">Bangun relasi dan jaringan dengan mahasiswa dari seluruh Indonesia.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gradient-to-br from-blue-100 to-blue-200">
        <div class="container mx-auto px-4 max-w-2xl">
            <h2 class="text-3xl font-bold text-blue-700 mb-6 text-center">Hubungi Kami</h2>
            <form class="bg-white p-8 rounded-lg shadow-md space-y-6">
                <div>
                    <label class="block text-gray-700 mb-2" for="name">Nama</label>
                    <input class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" id="name" name="name" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2" for="email">Email</label>
                    <input class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" type="email" id="email" name="email" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2" for="message">Pesan</label>
                    <textarea class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-700 text-white py-3 rounded-lg font-semibold hover:bg-blue-800 transition">Kirim Pesan</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-6 mt-10 shadow-inner">
        <div class="container mx-auto px-4 text-center text-gray-500">
            &copy; {{ date('Y') }} Forum Mahasiswa. All rights reserved.
        </div>
    </footer>
</body>
</html>