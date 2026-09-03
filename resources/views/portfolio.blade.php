<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile['name'] }} | Developer Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen font-sans antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 backdrop-blur-md bg-gray-950/80 border-b border-gray-800">
        <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">
            
            <!-- Brand Logo & Name -->
            <a href="#about" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-cyan-500 flex items-center justify-center text-white font-extrabold shadow-lg shadow-indigo-500/20 group-hover:scale-105 transition duration-300 border border-indigo-400/30">
                    <i class="fa-solid fa-code text-lg"></i>
                </div>
                <span class="text-xl font-bold bg-gradient-to-r from-indigo-400 via-cyan-400 to-white bg-clip-text text-transparent">
                    LP<span class="text-indigo-500">.</span>dev
                </span>
            </a>

            <div class="hidden md:flex space-x-8 text-sm font-medium text-gray-300">
                <a href="#about" class="hover:text-indigo-400 transition">About</a>
                <a href="#education" class="hover:text-indigo-400 transition">Education</a>
                <a href="#skills" class="hover:text-indigo-400 transition">Skills</a>
                <a href="#certifications" class="hover:text-indigo-400 transition">Certifications</a>
            </div>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-6 py-12 space-y-16">

        <!-- Hero / Profile Section -->
        <section id="about" class="relative bg-gray-900/60 border border-gray-800/80 rounded-3xl p-8 md:p-12 backdrop-blur-xl shadow-2xl overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 to-cyan-500 rounded-full blur opacity-75 group-hover:opacity-100 transition duration-500"></div>
                    <img src="{{ asset($profile['avatar']) }}" alt="Profile Picture" class="relative w-40 h-40 rounded-full object-cover border-2 border-gray-900 shadow-xl">
                </div>
                
                <div class="text-center md:text-left space-y-4 flex-1">
                    <div>
                        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight text-white">
                            {{ $profile['name'] }}
                        </h1>
                        <p class="text-lg md:text-xl font-medium text-indigo-400 mt-1">
                            {{ $profile['title'] }}
                        </p>
                    </div>

                    <div class="flex flex-wrap justify-center md:justify-start gap-4 text-sm text-gray-300 pt-2">
                        <a href="mailto:{{ $profile['email'] }}" class="flex items-center gap-2 bg-gray-800/80 hover:bg-gray-800 border border-gray-700/60 px-4 py-2 rounded-xl transition">
                            <i class="fa-solid fa-envelope text-indigo-400"></i> {{ $profile['email'] }}
                        </a>
                        <a href="tel:{{ $profile['phone'] }}" class="flex items-center gap-2 bg-gray-800/80 hover:bg-gray-800 border border-gray-700/60 px-4 py-2 rounded-xl transition">
                            <i class="fa-solid fa-phone text-indigo-400"></i> {{ $profile['phone'] }}
                        </a>
                        <a href="{{ $profile['github'] }}" target="_blank" class="flex items-center gap-2 bg-gray-800/80 hover:bg-gray-800 border border-gray-700/60 px-4 py-2 rounded-xl transition">
                            <i class="fa-brands fa-github text-indigo-400"></i> GitHub
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Education Section -->
        <section id="education" class="space-y-6">
            <div class="flex items-center gap-3 border-b border-gray-800 pb-4">
                <i class="fa-solid fa-graduation-cap text-indigo-400 text-2xl"></i>
                <h2 class="text-2xl font-bold tracking-tight text-white">Education Timeline</h2>
            </div>
            
            <div class="grid gap-6 md:grid-cols-3">
                @foreach($education as $edu)
                    <div class="bg-gray-900/40 border border-gray-800 p-6 rounded-2xl relative overflow-hidden group hover:border-indigo-500/50 transition duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-cyan-400 bg-cyan-950/60 px-3 py-1 rounded-full border border-cyan-800/50">
                                {{ $edu['level'] }}
                            </span>
                        </div>
                        <h3 class="font-bold text-lg text-white group-hover:text-indigo-300 transition">{{ $edu['school'] }}</h3>
                        <p class="text-gray-400 text-sm mt-2">{{ $edu['program'] }}</p>
                        <p class="text-xs text-indigo-400 font-semibold mt-4 flex items-center gap-1">
                            <i class="fa-regular fa-calendar text-xs"></i> {{ $edu['year'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Technical Skills Section -->
        <section id="skills" class="space-y-6">
            <div class="flex items-center gap-3 border-b border-gray-800 pb-4">
                <i class="fa-solid fa-code text-indigo-400 text-2xl"></i>
                <h2 class="text-2xl font-bold tracking-tight text-white">Tech Stack & Tools</h2>
            </div>
            
            <div class="flex flex-wrap gap-3">
                @foreach($skills as $skill)
                    <div class="flex items-center gap-2 bg-gray-900/80 border border-gray-800 hover:border-indigo-500 px-4 py-2.5 rounded-xl transition duration-200 group">
                        <span class="w-2 h-2 rounded-full bg-indigo-500 group-hover:animate-ping"></span>
                        <span class="text-sm font-medium text-gray-200 group-hover:text-white">{{ $skill }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Certifications Section -->
        <section id="certifications" class="space-y-6">
            <div class="flex items-center gap-3 border-b border-gray-800 pb-4">
                <i class="fa-solid fa-certificate text-indigo-400 text-2xl"></i>
                <h2 class="text-2xl font-bold tracking-tight text-white">Certifications & Seminars</h2>
            </div>

            <div class="space-y-4">
                @foreach($certifications as $cert)
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-gray-900/40 border border-gray-800/80 p-5 rounded-2xl hover:border-indigo-500/40 transition">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-indigo-950/60 border border-indigo-800/50 rounded-xl text-indigo-400">
                                <i class="fa-solid fa-award text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-white">{{ $cert['title'] }}</h3>
                                <p class="text-xs text-gray-400 mt-0.5">Verified Completion Certificate</p>
                            </div>
                        </div>
                        <span class="mt-3 sm:mt-0 text-xs font-medium text-indigo-300 bg-indigo-950/80 border border-indigo-800/60 px-3 py-1.5 rounded-lg">
                            {{ $cert['year'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </section>

    </div>

    <!-- Footer -->
    <footer class="border-t border-gray-900 py-8 text-center text-xs text-gray-500">
        <p>&copy; {{ date('Y') }} {{ $profile['name'] }}. Built with Laravel 11 & Tailwind CSS.</p>
    </footer>

</body>
</html>