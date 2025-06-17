@php
    use App\Facades\UtilityFacades;
    use App\Models\Category;
    use App\Models\Vip;
    $logo = asset(Storage::url('uploads/logo/'));
    $userAvatarPath = asset('assets/images/user/');
    $company_favicon = UtilityFacades::getValByName('company_favicon');
    $settings = UtilityFacades::settings();
    if (isset($settings['color'])) {
        $primary_color = $settings['color'];
        if ($primary_color != '') {
            $color = $primary_color;
        } else {
            $color = 'theme-1';
        }
    } else {
        $color = 'theme-1';
    }
    $vips = Vip::all();
    $categories = Category::all();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>eFile Inbox with Sidebar</title> -->
    <title> @yield('file_title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/new_style.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="icon"
        href="{{ $logo . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') }}"
        type="image" sizes="16x16" />

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


    @include('layouts.includes.datatable_css')
    @stack('style')
    @yield('css')
    <style>
        .dropdown-item:hover {
            background-color: #0085dc;
            color: white;
        }

        .flat-button {
            background: none;
            /* Or transparent */
            border: none;
            box-shadow: none;
            height: 35px;
            border-right: 1px solid rgb(156, 156, 156);
            margin-top: -1px;

            /* Add other styles as needed */
        }

        .dropdown-menu {
            background: #236eaa;
            /* Or transparent */
            border: none;
            box-shadow: none;

            margin-top: 2px;
            align-content: center;
        }
    </style>
</head>

<body>
    <div class="page-header">
        <nav>
            <div class="logo">
                <a href=""><img src="{{ $logo }}/light_logo.png" alt="logo" /></a>
            </div>

            <div class="d-flex justify-content-center align-items-center gap-3">
                <i class="bi bi-bell-fill text-white"></i>
                <i class="bi bi-question-circle text-white"></i>
                <div class="dropdown page-pro-drop">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ $userAvatarPath }}/{{ Auth::user()->avatar }}" alt="User"
                            class="rounded-circle mb-2" />
                        <div>
                            <h6>{{ Auth::user()->name }}</h6>
                            <p>{{ Auth::user()->departments->name }}</p>
                        </div>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                        <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>

    </div>


    <div class="tabbed-head">
        <button id="toggle-btn" class="collapsed"><i class="bi bi-list"></i></button>

        <div class="button-group">
            <!-- <div class="arrow-btns">
                <p>ESIGN</p>
                <button>Registration</button>
            </div> -->
            <div id="arrow-btns-dashboard" class="arrow-btns" data-url="{{ route('home') }}">
                <p>dashboard</p>
                <a href="{{ route('home') }}">View</a>
            </div>
            <div class="arrow-btns">
                <p id="arrow-btns-receipts" data-url="{{ route('receipt.index') }}">recepit</p>
                <div class="arrow-btns">
                    <button class="flat-button btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"
                        style="margin-left:-10px !important;font-size: 12px;">
                        Create
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('user.receipt.create') }}?type=physical">Physical</a>
                        <a href="{{ route('user.receipt.create') }}?type=electronics"
                            style="border:none!important;">Electronics</a>
                    </div>
                </div>
                <a href="{{ route('receipt.inbox') }}">Inbox</a>
                <a href="{{ route('receipt.sent') }}">Sent</a>
                <a href="">Advance Search</a>
            </div>
            <div class="arrow-btns">
                <p id="arrow-btns-files" data-url="{{ route('file.index') }}">File</p>
                <a href="{{ route('file.create') }}">Create</a>
                <a href="{{ route('file.inbox') }}">Inbox</a>
                <a href="{{ route('file.sent') }}">Sent</a>
                <a href="">Advance Search</a>
            </div>

            <div class="arrow-btns">
                <p id="arrow-btns-receipts" data-url="{{ route('receipt.index') }}">Issue</p>
                <a href="#">Sent</a>
                <a href="#">Returned</a>
                <a href="">Advance Search</a>
            </div>


        </div>

    </div>


    <!-- Sidebar -->
    <div id="sidebar" class="collapsed">
        <ul class="nav flex-column">
    
            <!-- Home Link -->
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <span class="sidebar-icon">🖥️</span>
                    <span class="sidebar-text">Home</span>
                </a>
            </li>
    
            <!-- Receipts Dropdown -->
            <div class="btn-group dropend w-100">
                <button type="button" class=" w-100 text-start d-flex align-items-center border-0  bg-transparent text-white" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="sidebar-icon ms-1">📂</span>
                    <span class="sidebar-text ms-2">Receipts</span>
                </button>
                
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item text-white" href="{{ route($url . '.index') }}">
                            🏠 Created
                        </a>
                    </li>
                    @if (Route::has($url . '.inbox'))
                        <li>
                            <a class="dropdown-item text-white" href="{{ route($url . '.inbox') }}">
                                📧 Inbox
                            </a>
                        </li>
                    @endif
                    @if (Route::has($url . '.sent'))
                        <li>
                            <a class="dropdown-item text-white" href="{{ route($url . '.sent') }}">
                                📤 Sent
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            
            

            {{-- drop down end  --}}
    
            <!-- Search -->
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

        <!-- Search Bar -->
        <div class="container-fluid">
            <!-- Table -->
            @yield('file_content')
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('toggle-btn').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const toggleBtn = document.getElementById('toggle-btn');

            // Toggle collapsed class
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
            toggleBtn.classList.toggle('collapsed');
        });
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#contactInput').select2({
                placeholder: 'Search by name or email',
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route('contact.suggestions') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term // search term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id, // what will be filled when selected
                                    text: item.name + " (" + item.email +
                                        ")" // what will be shown in dropdown
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#ccInput').select2({
                placeholder: 'Add CC recipients',
                minimumInputLength: 2,
                tags: true, // allow typing custom email addresses if needed
                tokenSeparators: [',', ' '], // allow separation by comma or space
                ajax: {
                    url: '{{ route('contact.suggestions') }}', // Same search route as To
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name + ' (' + item.email + ')'
                                };
                            })
                        };
                    },
                    cache: true
                },
                createTag: function(params) {
                    var term = $.trim(params.term);
                    if (term === '') {
                        return null;
                    }
                    return {
                        id: term,
                        text: term,
                        newTag: true // add custom typed email as new tag
                    };
                }
            });
        });
    </script>



    @include('layouts.includes.datatable_js')
    @stack('scripts')
    <script>
        document.getElementById('arrow-btns-dashboard').addEventListener('click', function() {
            window.location.href = this.dataset.url;
        });
        document.getElementById('arrow-btns-files').addEventListener('click', function() {
            window.location.href = this.dataset.url;
        });
        document.getElementById('arrow-btns-receipts').addEventListener('click', function() {
            window.location.href = this.dataset.url;
        });
        document.getElementById('arrow-btns-documents').addEventListener('click', function() {
            window.location.href = this.dataset.url;
        });
    </script>
</body>

</html>
