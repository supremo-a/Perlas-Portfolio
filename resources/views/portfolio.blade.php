<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile['name'] }} | Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen font-sans">
    <div class="max-w-4xl mx-auto px-4 py-10">
        
        <!-- Header / Profile -->
        <div class="flex flex-col md:flex-row items-center gap-6 bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-700">
            <img src="{{ asset($profile['avatar']) }}" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover border-4 border-indigo-500">
            <div>
                <h1 class="text-3xl font-bold text-indigo-400">{{ $profile['name'] }}</h1>
                <p class="text-gray-400 text-lg">{{ $profile['title'] }}</p>
                <div class="mt-3 flex flex-wrap gap-4 text-sm text-gray-300">
                    <p>📧 {{ $profile['email'] }}</p>
                    <p>📞 {{ $profile['phone'] }}</p>
                    <a href="{{ $profile['github'] }}" class="text-indigo-400 hover:underline">GitHub</a>
                </div>
            </div>
        </div>

        <!-- Education -->
        <div class="mt-8 bg-gray-800 p-6 rounded-2xl border border-gray-700">
            <h2 class="text-xl font-bold text-indigo-400 border-b border-gray-700 pb-2 mb-4">Education</h2>
            <h3 class="font-semibold text-lg">{{ $profile['school'] }}</h3>
            <p class="text-gray-400">{{ $profile['program'] }}</p>
            <p class="text-xs text-indigo-300 mt-1">{{ $profile['graduation'] }}</p>
        </div>

        <!-- Skills -->
        <div class="mt-8 bg-gray-800 p-6 rounded-2xl border border-gray-700">
            <h2 class="text-xl font-bold text-indigo-400 border-b border-gray-700 pb-2 mb-4">Technical Skills</h2>
            <div class="flex flex-wrap gap-2">
                @foreach($skills as $skill)
                    <span class="bg-indigo-900 text-indigo-200 text-sm px-3 py-1 rounded-full border border-indigo-700">{{ $skill }}</span>
                @endforeach
            </div>
        </div>

        <!-- Certifications -->
        <div class="mt-8 bg-gray-800 p-6 rounded-2xl border border-gray-700">
            <h2 class="text-xl font-bold text-indigo-400 border-b border-gray-700 pb-2 mb-4">Certifications & Training</h2>
            <ul class="space-y-3">
                @foreach($certifications as $cert)
                    <li class="flex justify-between items-center bg-gray-700/50 p-3 rounded-lg">
                        <span class="font-medium">{{ $cert['title'] }}</span>
                        <span class="text-sm text-gray-400 bg-gray-800 px-2 py-1 rounded">{{ $cert['year'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</body>
</html>