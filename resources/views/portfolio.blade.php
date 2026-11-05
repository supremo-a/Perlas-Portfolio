<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile['name'] }} | Developer Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Figtree', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        .section-title::after {
            content: '';
            display: block;
            width: 6px;
            height: 24px;
            border-radius: 2px;
            background: linear-gradient(to bottom, #4f46e5, #22d3ee);
            margin-left: 0.75rem;
        }
        .glass-card {
            background: linear-gradient(145deg, rgba(31, 41, 55, 0.6), rgba(17, 24, 39, 0.6));
            border: 1px solid rgba(55, 65, 81, 0.8);
            backdrop-filter: blur(12px);
            transition: all 0.3s ease;
        }
        .glass-card:hover {
            border-color: rgba(99, 102, 241, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 8px 10px -6px rgba(0, 0, 0, 0.3);
        }
        .skill-pill {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(34, 211, 238, 0.1));
            border: 1px solid rgba(99, 102, 241, 0.2);
            transition: all 0.25s ease;
        }
        .skill-pill:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.25), rgba(34, 211, 238, 0.15));
            border-color: rgba(99, 102, 241, 0.4);
            color: #fff;
        }
        .cert-badge {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(34, 211, 238, 0.1));
            border: 1px solid rgba(99, 102, 241, 0.25);
        }
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(to right, #4f46e5, #22d3ee);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .avatar-ring {
            position: relative;
        }
        .avatar-ring::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: linear-gradient(to right, #4f46e5, #22d3ee);
            z-index: -1;
            filter: blur(8px);
            opacity: 0.6;
            transition: opacity 0.4s ease;
        }
        .avatar-ring:hover::before {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 backdrop-blur-md bg-gray-950/80 border-b border-gray-800/80">
        <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">
            
            <!-- Brand Logo & Name -->
            <a href="#about" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-cyan-500 flex items-center justify-center text-white font-extrabold shadow-lg shadow-indigo-500/30 group-hover:scale-105 transition duration-300 border border-indigo-400/30">
                    <i class="fa-solid fa-code text-lg"></i>
                </div>
                <span class="text-xl font-bold tracking-tight bg-gradient-to-r from-indigo-400 via-cyan-400 to-white bg-clip-text text-transparent">
                    LP<span class="text-indigo-500">.</span>dev
                </span>
            </a>

            <div class="hidden md:flex space-x-8 text-sm font-medium text-gray-300">
                <a href="#about" class="nav-link hover:text-white transition">About</a>
                <a href="#education" class="nav-link hover:text-white transition">Education</a>
                <a href="#skills" class="nav-link hover:text-white transition">Skills</a>
                <a href="#certifications" class="nav-link hover:text-white transition">Certifications</a>
                <a href="#projects" class="nav-link hover:text-white transition">Projects</a>
            </div>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-6 py-12 space-y-16">

        <!-- Hero / Profile Section -->
        <section id="about" class="relative bg-gray-900/60 border border-gray-800/80 rounded-[2rem] p-8 md:p-12 backdrop-blur-xl shadow-2xl overflow-hidden">
            <div class="absolute -top-20 -right-20 w-[20rem] h-[20rem] bg-indigo-500/10 rounded-full blur-[96px] pointer-events-none"></div>
            <div class="absolute -bottom-20 -left-20 w-[20rem] h-[20rem] bg-cyan-500/10 rounded-full blur-[96px] pointer-events-none"></div>

            <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
                <div class="relative group avatar-ring">
                    <img src="{{ asset($profile['avatar']) }}" alt="Profile Picture" class="relative w-40 h-40 object-cover rounded-full border-2 border-gray-900 shadow-2xl ring-1 ring-white/10">
                </div>
                
                <div class="text-center md:text-left space-y-4 flex-1">
                    <div>
                        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight text-white">
                            {{ $profile['name'] }}
                        </h1>
                        <p class="text-lg md:text-xl font-medium text-indigo-400 mt-1 tracking-wide">
                            {{ $profile['title'] }}
                        </p>
                    </div>

                    <div class="flex flex-wrap justify-center md:justify-start gap-3 text-sm text-gray-300 pt-2">
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
                <h2 class="text-2xl font-bold tracking-tight text-white flex items-center">Education<span class="section-title"></span></h2>
            </div>
            
            <div class="grid gap-6 md:grid-cols-3">
                @foreach($education as $edu)
                    <div class="glass-card p-6 rounded-2xl relative overflow-hidden group">
                        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition duration-500">
                            <i class="fa-solid fa-graduation-cap text-4xl text-gray-700"></i>
                        </div>
                        <div class="flex justify-between items-start mb-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-cyan-400 bg-cyan-950/60 px-3 py-1 rounded-full border border-cyan-800/50">
                                {{ $edu['level'] }}
                            </span>
                        </div>
                        <h3 class="font-bold text-lg text-white group-hover:text-indigo-300 transition">{{ $edu['school'] }}</h3>
                        <p class="text-gray-400 text-sm mt-2 leading-relaxed">{{ $edu['program'] }}</p>
                        <div class="mt-6 pt-4 border-t border-gray-800/50 flex items-center gap-1">
                            <i class="fa-regular fa-calendar text-xs text-indigo-500"></i>
                            <p class="text-xs text-indigo-400 font-semibold">{{ $edu['year'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Technical Skills Section -->
        <section id="skills" class="space-y-6">
            <div class="flex items-center gap-3 border-b border-gray-800 pb-4">
                <i class="fa-solid fa-code text-indigo-400 text-2xl"></i>
                <h2 class="text-2xl font-bold tracking-tight text-white flex items-center">Technical Skills<span class="section-title"></span></h2>
            </div>
            
            <div class="flex flex-wrap gap-3">
                @foreach($skills as $skill)
                    <div class="skill-pill flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium text-gray-200 group">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 group-hover:animate-ping"></span>
                        <span>{{ $skill }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Certifications Section -->
        <section id="certifications" class="space-y-6">
            <div class="flex items-center gap-3 border-b border-gray-800 pb-4">
                <i class="fa-solid fa-certificate text-indigo-400 text-2xl"></i>
                <h2 class="text-2xl font-bold tracking-tight text-white flex items-center">Certifications &amp; Seminars<span class="section-title"></span></h2>
            </div>

            <div class="space-y-4">
                @foreach($certifications as $cert)
                        <div class="relative group p-10 md:p-12 rounded-[2.5rem] border-2 border-transparent bg-gradient-to-b from-gray-900/60 to-gray-950/80 via-gray-900/70 shadow-2xl hover:shadow-indigo-500/25 transition-all duration-300">
                            <div class="absolute inset-0 rounded-[2.5rem] bg-gradient-to-tr from-indigo-500/20 to-cyan-500/20 blur-[30px] opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                            <div class="relative z-10 flex flex-col items-center gap-6 text-center">
                                @if(!empty($cert['image']))
                                    <div class="relative w-64 h-64 rounded-[2.5rem] border-8 border-white/10 bg-white/5 shadow-2xl overflow-hidden group relative">
                                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-400/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                        <object data="{{ asset($cert['image']) }}" type="application/pdf" class="w-full h-full object-contain relative z-10" alt="Certificate"></object>
                                        <div class="absolute -inset-px rounded-[2.5rem] bg-gradient-to-r from-indigo-500 to-cyan-400 mask mask-[linear-gradient(#000_0_0,#000_0_75%,#000_100%)] -webkit-mask-[linear-gradient(#000_0_0,#000_0_75%,#000_100%)] -webkit-mask-composite xor mask-composite xor pointer-events-none"></div>
                                        <div class="absolute bottom-2 right-2 bg-indigo-900 text-indigo-100 px-3 py-1 rounded-xl text-[10px] font-bold tracking-wider shadow-lg border border-indigo-500/40">
                                            VIEW PDF
                                        </div>
                                        <div class="absolute top-2 left-2 bg-indigo-600 text-white p-3 rounded-2xl shadow-lg border border-indigo-400/50">
                                            <i class="fa-solid fa-file-pdf text-4xl"></i>
                                        </div>
                                    </div>
                                @else
                                    <div class="w-64 h-64 rounded-[2.5rem] border-8 border-white/10 bg-white/5 shadow-2xl flex items-center justify-center">
                                        <i class="fa-solid fa-award text-6xl text-indigo-400 drop-shadow-2xl"></i>
                                    </div>
                                @endif
                                <div class="flex flex-col items-center gap-1">
                                    <h3 class="font-bold text-white text-xl leading-tight">{{ $cert['title'] }}</h3>
                                    <p class="text-xs text-gray-400">Verified Completion Certificate</p>
                                    <div class="mt-2 flex items-center justify-center gap-2 text-indigo-400/60">
                                        <i class="fa-regular fa-clock text-xs"></i>
                                        <span class="text-xs font-medium">{{ $cert['year'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </section>

        <!-- Projects Section -->
        <section id="projects" class="space-y-6">
            <div class="flex items-center gap-3 border-b border-gray-800 pb-4">
                <i class="fa-solid fa-briefcase text-indigo-400 text-2xl"></i>
                <h2 class="text-2xl font-bold tracking-tight text-white flex items-center">Projects<span class="section-title"></span></h2>
            </div>

            <div class="space-y-4">
                @foreach($projects as $project)
                    <div class="relative group p-10 md:p-12 rounded-[2.5rem] border-2 border-transparent bg-gradient-to-b from-gray-900/60 to-gray-950/80 via-gray-900/70 shadow-2xl hover:shadow-indigo-500/25 transition-all duration-300">
                        <div class="absolute inset-0 rounded-[2.5rem] bg-gradient-to-tr from-indigo-500/20 to-cyan-500/20 blur-[30px] opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                        <div class="relative z-10 flex flex-col items-center gap-6 text-center">
                            @if(!empty($project['images']))
                                <div class="flex flex-wrap gap-3 justify-center">
                                    @foreach($project['images'] as $img)
                                        <div class="relative w-64 h-48 rounded-[2rem] border-8 border-white/10 bg-white/5 shadow-xl overflow-hidden group relative">
                                            <img src="{{ asset($img) }}" alt="{{ $project['title'] }}" class="w-full h-full object-contain relative z-10">
                                            <div class="absolute -inset-px rounded-[2rem] bg-gradient-to-r from-indigo-500 to-cyan-400 mask mask-[linear-gradient(#000_0_0,#000_0_75%,#000_100%)] -webkit-mask-[linear-gradient(#000_0_0,#000_0_75%,#000_100%)] -webkit-mask-composite xor mask-composite xor pointer-events-none"></div>
                                        </div>
                                    @endforeach
                                </div>
                            @elseif(!empty($project['image']))
                                <div class="relative w-80 h-48 rounded-[2rem] border-8 border-white/10 bg-white/5 shadow-xl overflow-hidden group relative">
                                    <img src="{{ asset($project['image']) }}" alt="{{ $project['title'] }}" class="w-full h-full object-contain relative z-10">
                                    <div class="absolute -inset-px rounded-[2rem] bg-gradient-to-r from-indigo-500 to-cyan-400 mask mask-[linear-gradient(#000_0_0,#000_0_75%,#000_100%)] -webkit-mask-[linear-gradient(#000_0_0,#000_0_75%,#000_100%)] -webkit-mask-composite xor mask-composite xor pointer-events-none"></div>
                                </div>
                            @endif
                            <div class="flex flex-col items-center gap-1">
                                <h3 class="font-bold text-white text-xl leading-tight">{{ $project['title'] }}</h3>
                                @if(!empty($project['url']))
                                    <a href="{{ $project['url'] }}" target="_blank" class="text-xs text-indigo-300 hover:text-indigo-400 underline font-medium break-all">
                                        {{ $project['url'] }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    </div>

    <!-- Footer -->
    <footer class="border-t border-gray-900/50 py-8 text-center text-xs text-gray-500 mt-8">
        <p class="bg-gradient-to-r from-indigo-500 via-cyan-400 to-indigo-500 bg-clip-text text-transparent font-semibold">&copy; {{ date('Y') }} {{ $profile['name'] }}</p>
        <p class="text-[10px] text-gray-600 mt-1">Built with Laravel 11 &amp; Tailwind CSS</p>
    </footer>

</body>
</html>
