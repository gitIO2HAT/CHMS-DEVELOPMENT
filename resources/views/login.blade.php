<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            height: 100vh; 
            margin: 0; 
            background-image: url('{{ asset('images/EXTRAVAGANZA.jpeg') }}'); 
            background-size: cover; 
            background-position: center; 
        }
        #eyeIcon{
            transition: color 0.2s ease;
        }
    </style>
</head>
<body class="bg-cover bg-center">
    <div class="flex items-center justify-start min-h-screen bg-opacity-30 bg-pink relative">
        <div class="bg-pink-900 bg-opacity-70 p-8 shadow-lg ml-0 relative w-full" style="width: 32.5rem; height: 40.3rem;"></div>

        <div class="absolute left-8">
            <div class="bg-pink-900 bg-opacity-90 p-8 rounded-lg shadow-lg ml-8 w-96">
                <div class="text-white text-3xl font-bold mb-2 flex items-center">
                    <i class="fas fa-crown mr-2"></i> CHMS
                </div>
                
                <div class="text-white text-xl mb-6">Welcome</div>     
                @if ($errors->any())
                    <div class="mb-4 text-red-500">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('login.submit') }}" method="POST"> <!-- Updated action -->
                    @csrf
                    <div class="mb-4">
                        <label class="block text-white text-sm mb-2" for="email">Email</label>
                        <input class="w-full px-3 py-2 text-gray-700 bg-white rounded-lg focus:outline-none" type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    
                    <div class="mb-4 relative">
                        <label class="block text-white text-sm mb-2" for="password">Password</label>
                        <input class="w-full px-3 py-2 text-gray-700 bg-white rounded-lg focus:outline-none" type="password" id="password" name="password" placeholder="Password" required>
                        <button type="button" id="togglePassword" class="absolute right-3 top-10 flex items-center" onclick="togglePasswordVisibility()">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="mr-2">
                        <label for="remember" class="text-white text-sm">Remember me</label>
                    </div>
                    
                    <button type="submit" class="w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800 focus:outline-none">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
