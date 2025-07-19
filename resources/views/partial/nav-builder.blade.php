@php
$users = \Auth::user();
$currantLang = $users->currentLanguage();
$logo = asset(Storage::url('uploads/logo/'));
$settings = Utility::settings();
@endphp
<!-- [ navigation menu ] start -->
<nav class="dash-sidebar light-sidebar transprent-bg">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('home') }}" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                {{-- @if (setting('app_logo'))
                    <img src="{{ Storage::url(setting('app_logo')) ? Storage::url('uploads/appLogo/app-logo.png') : '' }}"
                alt="logo" class="custom-logo">
                @else
                <a href="{{ route('home') }}">{{ setting('app_name') }}</a>
                @endif --}}
                @if (isset($settings['dark_mode']))
                @if ($settings['dark_mode'] == 'on')
                <img class="c-sidebar-brand-full pt-3 mt-2 mb-1"
                    src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'light_logo.png') }}"
                    height="46" class="navbar-brand-img">
                @else
                <img class="c-sidebar-brand-full pt-3 mt-2 mb-1"
                    src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'dark_logo.png') }}"
                    height="46" class="navbar-brand-img">
                @endif
                @else
                <img class="c-sidebar-brand-full pt-3 mt-2 mb-1"
                    src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'dark_logo.png') }}"
                    height="46" class="navbar-brand-img">
                @endif
                {{-- <img class="c-sidebar-brand-minimized"
                    src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'small_logo.png') }}"
                height="46" class="navbar-brand-img"> --}}
            </a>
        </div>
        <div class="navbar-content active-trigger ps ps--active-y">
            <ul class="dash-navbar" style="display: block;">
                <li class="dash-item dash-hasmenu {{ request()->is('/') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ url('/') }}">
                        <span class="dash-micon"><i class="ti ti-home"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Dashboard') }}</span>
                    </a>
                </li>


                @can('manage-user')
                <li class="dash-item dash-hasmenu {{ request()->is('users*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('users.index') }}">
                        <span class="dash-micon"><i class="ti ti-user"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Users') }}</span>
                    </a>
                </li>
                @endcan
                @can('manage-role')
                <li class="dash-item dash-hasmenu {{ request()->is('roles*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('roles.index') }}">
                        <span class="dash-micon"><i class="ti ti-key"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Roles') }}</span>
                    </a>
                </li>
                @endcan
                @can('manage-permission')
                <li class="dash-item dash-hasmenu {{ request()->is('permission*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('permission.index') }}">
                        <span class="dash-micon"><i class="ti ti-package"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Permissions') }}</span>
                    </a>
                </li>
                @endcan
                @can('manage-department')
                <li class="dash-item dash-hasmenu {{ request()->is('department*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('department.index') }}">
                        <span class="dash-micon"><i class="ti ti-lock"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Department') }}</span>
                    </a>
                </li>
                @endcan
                @can('manage-section')
                <li class="dash-item dash-hasmenu {{ request()->is('section*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('section.index') }}">
                        <span class="dash-micon"><i class="ti-bookmark"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Sections') }}</span>
                    </a>
                </li>
                @endcan
                @can('manage-category')
                <li class="dash-item dash-hasmenu {{ request()->is('category*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('category.index') }}">
                        <span class="dash-micon"><i class="ti ti-lock"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Category') }}</span>
                    </a>
                </li>
                @endcan
                @can('manage-subcategory')
                <li class="dash-item dash-hasmenu {{ request()->is('subcategory*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('subcategory.index') }}">
                        <span class="dash-micon"><i class="ti ti-lock"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('SubCategory') }}</span>
                    </a>
                </li>
                @endcan

                @can('manage-document')
                <li class="dash-item dash-hasmenu {{ request()->is('document*') ? 'active' : '' }}">
                    <a class="dash-link">
                        <span class="dash-micon"><i class="ti ti-lock"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Document') }}</span>
                        <span class="dash-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg></span>
                    </a>
                    <ul class="dash-submenu">
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('document.index') }}">Index</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('document.create') }}">Create</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('document.inbox') }}">Inbox</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('document.sent') }}">Sent</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('document.search') }}">Search</a></li>

                    </ul>
                </li>
                @endcan
                @can('manage-receipt')
                <li class="dash-item dash-hasmenu {{ request()->is('receipt*') ? 'active' : '' }}">
                    <a class="dash-link">
                        <span class="dash-micon"><i class="ti ti-lock"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Receipt') }}</span>
                        <span class="dash-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg></span>
                    </a>
                    <ul class="dash-submenu">
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('receipt.index') }}">Index</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('receipt.create') }}">Create</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('receipt.inbox') }}">Inbox</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('receipt.sent') }}">Sent</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('receipt.search') }}">Search</a></li>

                    </ul>
                </li>
                @endcan
                @can('manage-file')
                <li class="dash-item dash-hasmenu {{ request()->is('file*') ? 'active' : '' }}">
                    <a class="dash-link">
                        <span class="dash-micon"><i class="ti ti-lock"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('File') }}</span>
                        <span class="dash-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg></span>
                    </a>
                    <ul class="dash-submenu">
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('file.index') }}">Index</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('file.create') }}">Create</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('file.inbox') }}">inbox</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('file.sent') }}">Sent</a>
                        </li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('file.search') }}">Search</a></li>

                    </ul>
                </li>
                @endcan
                @can('manage-notes')
                <li class="dash-item dash-hasmenu {{ request()->is('file_greennotes*') ? 'active' : '' }}">
                    <a class="dash-link">
                        <span class="dash-micon"><i class="ti ti-notes"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Notes') }}</span>
                        <span class="dash-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg></span>
                    </a>
                    <ul class="dash-submenu">
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('file.greennotes') }}">Green Notes</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('file.yellownontes') }}">Yellow Notes</a></li>
                    </ul>
                </li>
                @endcan

                @role('admin')
                <li class="dash-item dash-hasmenu {{ request()->is('department*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('department.index') }}">
                        <span class="dash-micon"><i class="ti ti-lock"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Department') }}</span>
                    </a>
                </li>

                <li class="dash-item dash-hasmenu {{ request()->is('section*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('section.index') }}">
                        <span class="dash-micon"><i class="ti-bookmark"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Sections') }}</span>
                    </a>
                </li>

                <li class="dash-item dash-hasmenu {{ request()->is('category*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('category.index') }}">
                        <span class="dash-micon"><i class="ti ti-server"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Category') }}</span>
                    </a>
                </li>

                <li class="dash-item dash-hasmenu {{ request()->is('subcategory*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('subcategory.index') }}">
                        <span class="dash-micon"><i class="ti ti-archive"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('SubCategory') }}</span>
                    </a>
                </li>

                <li class="dash-item dash-hasmenu {{ request()->is('file*') ? 'active' : '' }}">
                    <a class="dash-link">
                        <span class="dash-micon"><i class="ti ti-files"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('File') }}</span>
                        <span class="dash-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg></span>
                    </a>
                    <ul class="dash-submenu">
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('file.index') }}">Index</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('file.create') }}">Create</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('file.inbox') }}">Inbox</a></li>

                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('file.sent') }}">Sent</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('file.index') }}">Search</a></li>

                    </ul>
                </li>
                <li class="dash-item dash-hasmenu {{ request()->is('file_greennotes*') ? 'active' : '' }}">
                    <a class="dash-link">
                        <span class="dash-micon"><i class="ti ti-notes"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Notes') }}</span>
                        <span class="dash-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg></span>
                    </a>
                    <ul class="dash-submenu">
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('file.greennotes') }}">Green Notes</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('file.yellownontes') }}">Yellow Notes</a></li>
                    </ul>
                </li>


                <li class="dash-item dash-hasmenu {{ request()->is('document*') ? 'active' : '' }}">
                    <a class="dash-link">
                        <span class="dash-micon"><i class="ti-book"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Document') }}</span>
                        <span class="dash-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg></span>
                    </a>
                    <ul class="dash-submenu">
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('document.index') }}">Index</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('document.create') }}">Create</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('document.inbox') }}">Inbox</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('document.sent') }}">Sent</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('document.index') }}">Search</a></li>

                    </ul>
                </li>
                <li class="dash-item dash-hasmenu {{ request()->is('receipt*') ? 'active' : '' }}">
                    <a class="dash-link">
                        <span class="dash-micon"><i class="ti ti-receipt"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Receipt') }}</span>
                        <span class="dash-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg></span>
                    </a>
                    <ul class="dash-submenu">
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('receipt.index') }}">Index</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('receipt.create') }}">Create</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('receipt.inbox') }}">Inbox</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('receipt.sent') }}">Sent</a></li>
                        <li class="dash-item dash-hasmenu"><a class="dash-link"
                                href="{{ route('receipt.search') }}">Search</a></li>

                    </ul>
                </li>
                <li class="dash-item dash-hasmenu {{ request()->is('deliverymode*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('deliverymode.index') }}">
                        <span class="dash-micon"><i class="ti ti-archive"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Delivery mode') }}</span>
                    </a>
                </li>
                <li class="dash-item dash-hasmenu {{ request()->is('vip*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('vip.index') }}">
                        <span class="dash-micon"><i class="ti ti-target"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('VIP') }}</span>
                    </a>
                </li>
                <li class="dash-item dash-hasmenu {{ request()->is('sendertype*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('sendertype.index') }}">
                        <span class="dash-micon"><i class=" ti ti-target"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('SenderType') }}</span>
                    </a>
                </li>
                <li class="dash-item dash-hasmenu {{ request()->is('communication*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('communication.index') }}">
                        <span class="dash-micon"><i class="ti ti-target"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Communication') }}</span>
                    </a>
                </li>
                <li class="dash-item dash-hasmenu {{ request()->is('template*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('template.index') }}">
                        <span class="dash-micon"><i class="ti ti-target"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Template') }}</span>
                    </a>
                </li>
                <li class="dash-item dash-hasmenu {{ request()->is('ministry*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('ministry.index') }}">
                        <span class="dash-micon"><i class="ti ti-target"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Ministry') }}</span>
                    </a>
                </li>
                <li class="dash-item dash-hasmenu {{ request()->is('notice*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('notice.index') }}">
                        <span class="dash-micon"><i class="ti ti-target"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Notice') }}</span>
                    </a>
                </li>
                @endrole
                <!-- @can('manage-langauge')
    <li class="dash-item dash-hasmenu {{ request()->is('index') ? 'active' : '' }}">
                                                                                                                                                                                                                                                                            <a class="dash-link" href="{{ route('index') }}">
                                                                                                                                                                                                                                                                                <span class="dash-micon"><i class="ti ti-world"></i></span>
                                                                                                                                                                                                                                                                                <span class="dash-mtext custom-weight">{{ __('Language') }}</span>
                                                                                                                                                                                                                                                                            </a>
                                                                                                                                                                                                                                                                        </li>
@endcan -->
                <!-- @role('admin')
    <li class="dash-item dash-hasmenu {{ request()->is('home*') ? 'active' : '' }}">
                                                                                                                                                                                                                                                                            <a class="dash-link" href="{{ route('io_generator_builder') }}">
                                                                                                                                                                                                                                                                                <span class="dash-micon"><i class="ti ti-3d-cube-sphere"></i></span>
                                                                                                                                                                                                                                                                                 <span class="dash-mtext custom-weight">{{ __('Crud') }}</span>
                                                                                                                                                                                                                                                                             </a>
                                                                                                                                                                                                                                                                          </li>
@endrole -->
                @include('layouts.menu')
            </ul>

        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->