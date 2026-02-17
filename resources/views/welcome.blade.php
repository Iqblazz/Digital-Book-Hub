<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Digital Book Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        
        <div class="text-center">
            <div class="mb-6 flex justify-center text-blue-600">
                <i class="fas fa-book-open text-6xl"></i>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-bold mb-4 tracking-tight">
                Digital <span class="text-blue-600">Book</span> Hub
            </h1>
            
           <p class="text-gray-600 text-lg mb-10 max-w-2xl mx-auto leading-relaxed">
                Welcome <br>
                Manage your library collections, track active borrowings, and explore digital resources in one unified dashboard.
            </p>

            <div class="flex flex-col md:flex-row items-center justify-center gap-4">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="w-full md:w-auto px-10 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors shadow-sm">
                        Login
                    </a>
                @endif

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="w-full md:w-auto px-10 py-3 bg-white text-gray-700 border border-gray-300 rounded-lg font-semibold hover:bg-gray-50 transition-colors">
                        Register
                    </a>
                @endif
            </div>
        </div>
    </div>
</body>
</html>