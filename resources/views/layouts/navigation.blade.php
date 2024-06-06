<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');


        :root{
            --header-height: 3rem;
            --nav-width: 68px;
            --first-color: #2ea345;
            --first-color-light: hsl(110, 100%, 81%);
            --white-color: #ffffff;
            --body-font: 'Nunito', sans-serif;
            --normal-font-size: 1rem;
            --z-fixed: 100
        }

        *,::before,::after {
            box-sizing: border-box
        }

        body {
            position: relative;
            margin: var(--header-height) 0 0 0;
            padding: 0 1rem;
            font-family: var(--body-font);
            font-size: var(--normal-font-size);
            transition: .5s
        }

        a {
            text-decoration: none
        }

        .header {
            width: 100%;
            height: var(--header-height);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1rem;
            background-color: var(--white-color);
            transition: .5s
        }

        .header_toggle {
            color: var(--white-color);
            font-size: 1.5rem;
            padding: .3rem 0 .5rem 1.5rem;
            cursor: pointer
        }

        .header_img {
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden
        }

        .header_img img {
            width: 100%
        }

        .l-navbar {
            position: fixed;
            top: 0;
            left: -30%;
            width: var(--nav-width);
            height: 100vh;
            background-color: var(--first-color);
            padding: .5rem 1rem 0 0;
            transition: .5s;
            z-index: var(--z-fixed)
        }

        .nav {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden
        }

        .nav_logo, .nav_link {
            display: grid;
            grid-template-columns: max-content max-content;
            align-items: center;
            column-gap: 1rem;
            padding: .5rem 0 .5rem 1.5rem
        }

        .nav_logo {
            margin-bottom: 2rem
        }

        .nav_logo-icon {
            font-size: 1.25rem;
            color: var(--white-color)
        }

        .nav_logo-name {
            color: var(--white-color);
            font-weight: 700
        }

        .nav_link {
            position: relative;
            color: var(--first-color-light);
            margin-bottom: 1.5rem;
            transition: .3s
        }

        .nav_link:hover {
            color: var(--white-color)
        }

        .nav_icon {
            font-size: 1.25rem
        }

        .show {
            left: 0
        }

        .body-pd {
            padding-left: calc(var(--nav-width) + 1rem)
        }

        .active {
            color: var(--white-color)
        }

        .active::before {
            content: '';
            position: absolute;
            left: 0;
            width: 2px;
            height: 32px;
            background-color: var(--white-color)
        }

        .height-100 {
            height: 100vh
        }

        @media screen and (min-width: 768px) {
            body {
                margin: calc(var(--header-height) + 1rem) 0 0 0;
                padding-left: calc(var(--nav-width) + 2rem)
            }

            .header {
                height: calc(var(--header-height) + 1rem);
                padding: 0 2rem 0 calc(var(--nav-width) + 2rem)
            }

            .header_img {
                width: 40px;
                height: 40px
            }

            .header_img img {
                width: 45px
            }

            .l-navbar {
                left: 0;
                padding: 1rem 1rem 0 0
            }

            .show {
                width: calc(var(--nav-width) + 156px)
            }

            .body-pd {
                padding-left: calc(var(--nav-width) + 188px)
            }
        }

        .header-profile {
            display: flex;
            align-items: center;
        }

        .profile-info {
            display: flex;
            flex-direction: row;
            margin-right: 1rem;
        }

        .profile-name {
            font-family: var(--body-font);
            font-size: var(--normal-font-size);
            position: relative;
            margin-bottom: 0.5rem;
        }

        .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            justify-content: end;
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .profile-dropdown:hover .dropdown-content {
            display: block;
        }

        .nav_logo .img {
            width: 20px;
            height: 10px;
        }
    </style>
</head>
<body id="body-pd">
    <header class="header drop-shadow-lg" id="header">
        <div class="w-20">
            <img src="/assets/img/elitery-logo.png" alt="Elitery Logo">
        </div>
        
        <div class="header-profile">
            <div class="group flex items-center">
                @auth
                    @php
                        $user = Auth::user();
                        $alumni = $user->alumni;
                    @endphp
                    @if(!$alumni || $alumni->status == 'not verified')
                        <div class="profile-dropdown">
                            <button class="header_img">
                                <img src="/assets/profile_pic/profile.png" alt="user-profile" class="flex-shrink-0 object-cover aspect-square">
                            </button>
                            <div class="dropdown-content">
                                <div class="px-4 py-2">
                                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                </div>
                                <a href="{{ route('profile.edit') }}">
                                    <div class="pb-1 border-t border-green-200 dark:border-green-600">
                                        <div class="mt-3 space-y-1">
                                            <x-responsive-nav-link :href="route('profile.edit')">
                                                {{ __('Profile') }}
                                            </x-responsive-nav-link>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ route('logout') }}">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-responsive-nav-link>
                                    </form>
                                </a>
                            </div>
                        </div>
                        <div class="profile-name ml-3 justify-items-center">
                            {{ Auth::user()->name }}
                        </div>
                    @endif
                    @if($alumni && $alumni->status == 'verified')
                        <div class="profile-dropdown">
                            <button class="header_img">
                                <img src="{{asset('/storage/photos/'.$alumni->photo)}}" alt="user-profile" class="flex-shrink-0 object-cover aspect-square">
                            </button>
                            <div class="dropdown-content">
                                <div class="px-4 py-2">
                                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ $alumni->first_name }} {{ $alumni->last_name }}</div>
                                    <div class="font-medium text-sm text-gray-500">{{ $user->email }}</div>
                                </div>
                                <a href="{{ route('profile.edit') }}">
                                    <div class="pb-1 border-t border-green-200 dark:border-green-600">
                                        <div class="mt-3 space-y-1">
                                            <x-responsive-nav-link :href="route('profile.edit')">
                                                {{ __('Profile') }}
                                            </x-responsive-nav-link>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ route('logout') }}">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-responsive-nav-link>
                                    </form>
                                </a>
                            </div>
                        </div>
                        {{-- <div class="profile-name ml-3 justify-items-center">
                            {{ $alumni->first_name }} {{ $alumni->last_name }}
                        </div> --}}
                    @endif
                @endauth
            </div>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <div class="nav_list">
                    <div class="header_toggle mb-4">
                        <i class='bx bx-menu' id="header-toggle"></i>
                    </div>
                    <a href="{{ route('alumni.dashboard') }}" class="nav_link">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Homepage</span>
                    </a>
                    <a href="{{ route('alumni.list') }}" class="nav_link">
                        <i class='bx bx-group nav_icon'></i>
                        <span class="nav_name">Alumni List</span>
                    </a>
                    <a href="{{ route('alumni.stories') }}" class="nav_link">
                        <i class='bx bx-message-square-detail nav_icon'></i>
                        <span class="nav_name">Stories</span>
                    </a>
                    <a href="{{ route('referral.create') }}" class="nav_link">
                        <i class='bx bx-gift nav_icon'></i>
                        <span class="nav_name">Referrals</span>
                    </a>
                    <a href="{{ route('alumni.edit', Auth::user()->id) }}" class="nav_link">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Edit Profile</span>
                    </a>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav_link" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class='bx bx-log-out nav_icon'></i>
                    <span class="nav_name">Log Out</span>
                </a>
            </form>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="">
        @yield('content')
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId)

                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        nav.classList.toggle('show');
                        toggle.classList.toggle('bx-x');
                        bodypd.classList.toggle('body-pd');
                        headerpd.classList.toggle('body-pd');
                    });
                }
            }

            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header');

            const linkColor = document.querySelectorAll('.nav_link');

            function colorLink() {
                linkColor.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            }

            linkColor.forEach(l => l.addEventListener('click', colorLink));
        });
    </script>
</body>
</html>
