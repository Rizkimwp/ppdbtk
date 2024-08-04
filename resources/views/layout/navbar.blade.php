<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo font-bold " href="{{ route('dashboard') }}"> <i
                class="mdi mdi-school text-primary" style="font-size: 3rem"></i> <span
                style="font-size: 3rem; color: purple;" class="text-primary">PPDB</span>
            <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}"><i class="mdi mdi-school text-primary"
                    style="font-size: 3rem"></i></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <div class="search-field d-none d-md-block">
            {{-- <form class="d-flex align-items-center h-100" action="#">
                <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                        <i class="input-group-text border-0 mdi mdi-magnify"></i>
                    </div>
                    <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
                </div>
            </form> --}}
        </div>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    {{-- <div class="nav-profile-img">
                        <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="image">
                        <span class="availability-status online"></span>
                    </div> --}}
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">{{ $username }}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    {{-- <a class="dropdown-item" href="#">
                        <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a> --}}
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item" type="submit">
                            <i class="mdi mdi-logout me-2 text-primary"></i> Signout
                        </button>
                    </form>

                </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>
            {{-- <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-email-outline"></i>
                    <span class="count-symbol bg-warning"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                    aria-labelledby="messageDropdown">
                    <h6 class="p-3 mb-0">Messages</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="{{ asset('assets/images/faces/face4.jpg') }}" alt="image" class="profile-pic">
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a
                                message</h6>
                            <p class="text-gray mb-0"> 1 Minutes ago </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="{{ asset('assets/images/faces/face2.jpg') }}" alt="image" class="profile-pic">
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a
                                message</h6>
                            <p class="text-gray mb-0"> 15 Minutes ago </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="{{ asset('assets/images/faces/face3.jpg') }}" alt="image" class="profile-pic">
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture
                                updated</h6>
                            <p class="text-gray mb-0"> 18 Minutes ago </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <h6 class="p-3 mb-0 text-center">4 new messages</h6>
                </div>
            </li> --}}

            <!-- Notification Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-bs-toggle="dropdown">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="rounded-circle bg-danger fw-bold"
                        style="
        position: absolute;
        top: 15px; /* Adjust position */
        right: -15px; /* Adjust position */
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 20px; /* Adjust size as needed */
        height: 20px; /* Adjust size as needed */
        border-radius: 50%;
        background-color: #dc3545; /* Danger color */
        color: #fff;
        font-family: 'Inter', sans-serif;
        font-weight: bold;
        font-size: 14px; /* Adjust size as needed */
        line-height: 1; /* Adjusts alignment of text inside circle */
        "
                        id="notificationCount">{{ $unreadNotificationsCount }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown" id="notificationDropdownMenu">
                    <h6 class="p-3 mb-0">Notifications</h6>
                    <div class="dropdown-divider"></div>
                    @if ($notifications->isNotEmpty())
                        @foreach ($notifications as $notification)
                            <a class="dropdown-item preview-item "
                                href="{{ route('notifications.read', ['id' => $notification->id]) }}">
                                <div class="preview-thumbnail">
                                    <div
                                        class="preview-icon {{ $notification->data['status'] === 'valid' ? 'bg-success' : 'bg-danger' }}">
                                        <i class="mdi mdi-bell"></i> <!-- Replace with appropriate icon -->
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">
                                        {{ $notification->data['title'] }} - {{ $notification->data['nama_berkas'] }}
                                    </h6>
                                    <p class="text-gray ellipsis mb-0">{{ $notification->data['message'] }}</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                        <h6 class="p-3 mb-0 text-center">See all notifications</h6>
                    @else
                        <p class="text-center p-3">No new notifications</p>
                    @endif
                </div>
            </li>



        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
