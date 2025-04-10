@php
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');

@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme"
    id="layout-navbar">
    @endif
    @if(isset($navbarDetached) && $navbarDetached == '')
    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="{{$containerNav}}">
            @endif

            <!--  Brand demo (display only for navbar-full and hide on below xl) -->
            @if(isset($navbarFull))
            <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
                <a href="{{url('/')}}" class="app-brand-link gap-2">
                    <span
                        class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
                    <span class="app-brand-text demo menu-text fw-bold">{{config('variables.templateName')}}</span>
                </a>
            </div>
            @endif

            <!-- ! Not required for layout-without-menu -->
            @if(!isset($navbarHideToggle))
            <div
                class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                    <i class="bx bx-menu bx-sm"></i>
                </a>
            </div>
            @endif

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                <!-- Search -->
                <div class="navbar-nav align-items-center">
                    <div class="nav-item d-flex align-items-center">
                        <i class="bx bx-happy fs-4 lh-0"></i>
                        <!-- Inside your Blade view -->
                        <span class="ms-1 fs-4">Welcome, <b>{{ Auth::user()->name }}</b></span>

                    </div>
                </div>
                <!-- /Search -->
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <!-- User -->
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                            data-bs-toggle="dropdown">
                            @php
                            $userImg = Auth::user()->img ? url('images/users/' . Auth::user()->img) :
                            url('images/users/no_image.png');
                            @endphp
                            <div class="avatar avatar-online">
                                <img src="{{ $userImg }}" alt="{{ Auth::user()->name }}"
                                    onerror="this.onerror=null;this.src='{{ url('images/users/no_image.png') }}';"
                                    class="w-px-40 h-auto rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                                <img src="{{ $userImg }}" alt="{{ Auth::user()->name }}"
                                                    onerror="this.onerror=null;this.src='{{ url('images/users/no_image.png') }}';"
                                                    class="w-px-40 h-auto rounded-circle">

                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <span class="fw-medium d-block">{{ Auth::user()->name }}</span>
                                            <small class="text-muted">
                                                @php
                                                $empType = Auth::user()->employeeType;
                                                if (!empty($empType)) {
                                                echo ($empType == 1) ? 'Admin' : 'User';
                                                }
                                                @endphp
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="logout()">
                                    <i class='bx bx-power-off me-2'></i>
                                    <span class="align-middle">Log Out</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!--/ User -->
                </ul>
            </div>
            <script>
            function logout() {
                // Create a hidden form element
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("logout") }}';
                form.style.display = 'none';

                // Add CSRF token
                var token = document.createElement('input');
                token.type = 'hidden';
                token.name = '_token';
                token.value = '{{ csrf_token() }}';
                form.appendChild(token);

                // Add form to document body and submit
                document.body.appendChild(form);
                form.submit();
            }
            </script>

            @if(!isset($navbarDetached))
        </div>
        @endif

        <script>
        // Check if there is a session flash message for success
        @if(session('success'))
        toastr.success('{{ session('
            success ') }}', 'Success', {
                timeOut: 5000,
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right'
            });
        @endif
        </script>

        <script>
        // Check if there is a session flash message for success
        @if(session('error'))
        toastr.error('{{ session('
            error ') }}', 'Error', {
                timeOut: 5000,
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right'
            });
        @endif
        </script>
    </nav>
    <!-- / Navbar -->