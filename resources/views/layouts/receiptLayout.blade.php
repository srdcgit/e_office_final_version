@php
use App\Facades\UtilityFacades;
$logo = asset(Storage::url('uploads/logo/'));
$company_favicon = UtilityFacades::getValByName('company_favicon');
$settings = UtilityFacades::settings();
if(isset($settings['color']))
{
$primary_color = $settings['color'];
if ($primary_color!="") {
$color = $primary_color;
} else {
$color = 'theme-1';
}
}
else{
$color = 'theme-1';
}
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>eFile Inbox with Sidebar</title> -->
    <title> @yield('file_title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/new_style.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="icon" href="{{ $logo . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') }}" type="image" sizes="16x16">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    @include('layouts.includes.datatable_css')
    @stack('style')
    @yield('css')
</head>
</head>

<body>
    <div class="page-header">
        <nav>
            <div class="logo">
                <a href="{{ route('home') }}"><img src="{{ asset('assets/images/efile-logo.png') }}" alt="logo" /></a>
            </div>

            <div class="d-flex justify-content-center align-items-center gap-3">
                <i class="bi bi-bell-fill text-white"></i>
                <i class="bi bi-question-circle text-white"></i>
                <div class="dropdown page-pro-drop">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://via.placeholder.com/100" alt="User" class="rounded-circle mb-2" />
                        <div>
                            <h6>{{Auth::user()->name}}</h6>
                            <p>prog(AS)</p>
                        </div>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                        <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>

    </div>
    <!-- Sidebar -->

    <div id="sidebar" class="collapsed">
        <button id="toggle-btn" class="collapsed"><i class="bi bi-list"></i></button>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <span class="sidebar-icon">🖥️</span>
                    <span class="sidebar-text">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('receipt.index') }}" class="nav-link">
                    <span class="sidebar-icon">🏠</span>
                    <span class="sidebar-text">Index</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('receipt.inbox') }}" class="nav-link">
                    <span class="sidebar-icon">📧</span>
                    <span class="sidebar-text">Inbox</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('receipt.sent') }}" class="nav-link">
                    <span class="sidebar-icon">📤</span>
                    <span class="sidebar-text">Sent</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <span class="sidebar-icon">🔍</span>
                    <span class="sidebar-text">Search</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Content Area -->
    <div id="content" class="collapsed">
        <div class="tabbed-head">
            <button id="toggle-btn" class="collapsed"><i class="bi bi-list"></i></button>

            <div class="button-group">
                <div class="arrow-btns">
                    <p>ESIGN</p>
                    <button>Registration</button>
                </div>
                <div class="arrow-btns">
                    <p>dashboard</p>
                    <button>view</button>
                </div>
                <div class="arrow-btns">
                    <p>recepit</p>
                    <button>Create</button>
                    <a href="">Inbox</a>
                    <a href="">Sent</a>
                    <a href="">Advance Search</a>
                </div>
                <div class="arrow-btns">
                    <p>File</p>
                    <button onclick="window.location.href=`{{ route('file.create') }}`">Create</button>
                    <a href="">Sent</a>
                    <a href="">Returned</a>
                    <a href="">Advance Search</a>
                </div>
                <div class="arrow-btns">
                    <p>Issue</p>
                    <a href="">Sent</a>
                    <a href="">Returned</a>
                    <a href="">Advance Search</a>
                </div>
            </div>
        </div>

        <!-- Toolbar -->
        <div class="toolbar">
            <div>
                <button class="btn btn-light btn-sm" onclick="window.location.href=`{{ route('receipt.create') }}`">Create</button>
                <button class="btn btn-light btn-sm">Receive</button>
                <button class="btn btn-light btn-sm">Send</button>
                <button class="btn btn-light btn-sm">Send Back</button>
                <button class="btn btn-light btn-sm">Move To</button>
                <button class="btn btn-light btn-sm">Create Volume</button>
                <button class="btn btn-light btn-sm">Create Part</button>
                <button class="btn btn-light btn-sm">Park</button>
                <button class="btn btn-light btn-sm">Close</button>
            </div>

            <div class="search-bar">
                <select class="form-select w-auto">
                    <option selected>File View (SELF)</option>
                    <option value="1">File View (Dept)</option>
                    <option value="2">File View (All)</option>
                </select>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="container-fluid">
            <!-- Table -->
            @yield('receipt_content')
        </div>
    </div>


    <!-- Footer -->
    <div class="footer">
        <p>Copyright © 2022, Designed and Developed by ITI Limites</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Sidebar Toggle Script -->
    <script>

    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    @include('layouts.includes.datatable_js')
    @stack('scripts')
</body>

</html>