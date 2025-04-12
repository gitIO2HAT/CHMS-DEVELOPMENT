<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Church Management System Dashboard')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"/>
    
    <!-- Google Fonts - Roboto & Poppins for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Bundle with JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F3F4F6;
            color: #4A5568;
        }

        /* Sidebar Styling */
        #sidebar {
            width: 280px;
            background: linear-gradient(145deg, #2D3748, #1A202C);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
            transition: width 0.3s ease-in-out;
            position: relative;
        }

        #sidebar.collapsed {
            width: 80px;
        }

        /* Sidebar Content Hiding */
        #sidebar.collapsed .sidebar-content {
            display: none;
        }

        #sidebar .logo-container {
            padding: 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        #sidebar .logo-container h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            color: #FBB6CE;
        }

        #sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            font-size: 16px;
            color: #E2E8F0;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        #sidebar a:hover {
            background-color: #4A5568;
            transform: translateX(5px);
        }

        #sidebar .active {
            background-color: #FBB6CE;
            color: #1A202C;
            font-weight: 600;
        }

        #sidebar.collapsed .logo-container {
            opacity: 0;
        }

        /* Sidebar Toggle Button */
        .sidebar-toggle-btn {
            position: absolute;
            bottom: 10px;
            right: -10px;
            transform: translateY(50%); /* Center vertically */
            background-color: #FBB6CE;
            color: #2D3748;
            border: none;
            padding: 10px;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            z-index: 10;
            transition: transform 0.2s ease;
        }

        .sidebar-toggle-btn:hover {
            transform: rotate(180deg);
            background-color: #2B6CB0;
        }

        /* Header Styling*/

        #header {
            background-color: transparent;
            padding: 15px 25px;
            border-bottom: 2px solid #EDF2F7;
            margin: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #header .profile-info h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #2D3748;
        }

        #header .profile-info p {
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
            color: #666;
        }

        /* Sidebar Link Styling */
        #sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            text-decoration: none;
            color: #E2E8F0;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }

        #sidebar a:hover {
            background-color: #4a5568;
        }

        /* Main Content */
        #main-content {
            padding: 20px;
            flex: 1;
            background-color: #F7FAFC;
            border-radius: 10px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        #main-content.w-full {
            width: 100%;
        }

        /* Buttons */
        button {
            background-color: #4299E1;
            color: #FFFFFF;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #3182CE;
            transform: scale(1.05);
        }

        /* Search Input */
        .search-input {
            padding-left: 35px;
            padding-right: 15px;
            padding-top: 8px;
            padding-bottom: 8px;
            background-color: #fff;
            border-radius: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 250px;
        }

        .search-input input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
            padding: 5px 0;
        }

        .search-input i {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #6b7280;
        }

        #searchResults {
             max-height: 200px;
             overflow-y: auto;
             border: 1px solid #ddd;
                border-radius: 4px;
                z-index: 10;
        }

        #resultsList li {
             padding: 8px;
            cursor: pointer;
        }

        #resultsList li:hover {
             background-color: #f0f0f0;
        }

        li.group:hover > ul {
             display: block;
        }

        li.group ul {
            display: none;
            position: absolute;
            top: 100%; /* This ensures the dropdown is directly below the parent */
            left: 0;
        }

        li.group ul a {
            display: block;
            padding: 8px 16px;
            text-decoration: none;
            color: white;
            white-space: nowrap;
        }

        li.group ul a:hover {
            background-color: #2563eb; /* Adjust hover color */
        }

    </style>

    @stack('head')
</head>
<body>
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-gray-900 text-white shadow-xl">
            <div class="flex items-center mb-10 logo-container">
                <i class="fas fa-crown text-4xl mr-3 text-pink-500"></i>
                <div class="pt-7">
                    <h1 class="text-4xl font-bold ">CHMS</h1>
                    <p class="text-sm text-gray-400 mt-1">User Dashboard</p>
                </div>
            </div>
            <nav class="sidebar-content space-y-6 px-3">
                <a href="{{ route('user.dashboard') }}" class="block p-2 rounded hover:bg-blue-600 {{ request()->routeIs('user.dashboard')}}">
                    Dashboard
                </a>
                <!-- Events Dropdown -->
                <li class="mb-2 mt-1 relative group">
                    <a class="block p-2 rounded hover:bg-blue-600">Events</a>
                    <ul class="absolute hidden group-hover:block bg-blue-600 text-white mt-0 p-2 rounded shadow-lg">
                        <li><a href="{{ route('user.event-user') }}" class="block p-2 hover:bg-blue-500 rounded">All Events</a></li>
                        <li><a href="{{ route('user.history') }}" class="block p-2 hover:bg-blue-500 rounded">Participation History</a></li>
                    </ul>
                </li>

                <a href="{{ route('user.notifications') }}" class="block p-2 rounded hover:bg-blue-600 {{ request()->routeIs('user.notifications') ? 'bg-blue-600' : '' }}">
                            Notifications
                </a>
                <!-- Logout Form -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="flex items-center text-lg w-full text-left mt-2 hover:bg-red-500">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            </nav>
            <!-- Sidebar Toggle Button -->
            <button id="sidebar-toggle" class="sidebar-toggle-btn">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="w-full bg-gray-50 p-6 flex flex-col">
            <!-- Header Section -->
            <div id="header" class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <img src="https://storage.googleapis.com/a1aa/image/FSebN6hk4hQxV6vR5lGTJKdTOb6EREsEe1n3cNUyFkNxyePnA.jpg" alt="Profile picture" class="rounded-full w-12 h-12"/>
                    <div class="profile-info">
                        @if(Auth::check())
                            <h2 class="text-xl font-semibold">{{ Auth::user()->name }}</h2>
                            <p class="text-sm font-medium">{{ ucfirst(Auth::user()->role) }}</p>
                        @else
                            <h2 class="text-xl font-semibold">Guest</h2>
                            <p class="text-sm font-medium">Guest</p>
                        @endif
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('user.event-user') }}">
                    <i class="fas fa-comments text-2xl text-gray-700 hover:text-blue-500 cursor-pointer"></i>
                    </a>
                    <a href="{{ route('user.notifications') }}">
                        <i class="fas fa-bell text-2xl text-gray-700 hover:text-blue-500 cursor-pointer"></i>
                    </a>
                    <div class="relative">
                        <div class="search-input relative">
                            <input id="searchInput" class="outline-none" placeholder="Search..." type="text"/>
                            <i class="fas fa-search absolute top-2 left-2 text-gray-500"></i>
                        </div>

                        <div id="searchResults" class="hidden absolute mt-2 bg-white shadow-lg w-full">
                             <ul id="resultsList"></ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="py-6">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const sidebarToggleBtn = document.getElementById('sidebar-toggle');

        sidebarToggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('w-full');
        });
        // JavaScript for interactive 5-star rating system
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('#rating .star');

            stars.forEach((star, index) => {
                star.addEventListener('mouseover', () => {
                    highlightStars(index);
                });

                star.addEventListener('mouseout', () => {
                    resetStars();
                });

                star.addEventListener('click', () => {
                    selectStars(index);
                });
            });

            function highlightStars(index) {
                stars.forEach((star, i) => {
                    if (i <= index) {
                        star.classList.add('text-yellow-400');
                        star.classList.remove('text-gray-400');
                    } else {
                        star.classList.add('text-gray-400');
                        star.classList.remove('text-yellow-400');
                    }
                });
            }

            function resetStars() {
                stars.forEach((star) => {
                    if (!star.classList.contains('selected')) {
                        star.classList.add('text-gray-400');
                        star.classList.remove('text-yellow-400');
                    }
                });
            }

            function selectStars(index) {
                stars.forEach((star, i) => {
                    if (i <= index) {
                        star.classList.add('text-yellow-400', 'selected');
                        star.classList.remove('text-gray-400');
                    } else {
                        star.classList.remove('text-yellow-400', 'selected');
                        star.classList.add('text-gray-400');
                    }
                });
                alert(`You rated ${index + 1} star(s)`); // Add custom action here
            }
        });
    </script>
    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-1">
        <p>&copy; {{ date('Y') }} Church Management System. All Rights Reserved.</p>
    </footer>
    @stack('scripts')
</body>
</html>
