<nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i> </a> </li>
            {{-- <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Home</a> </li>
            <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Contact</a> </li> --}}
        </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->




        <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->
            <li class="nav-item"> <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    {{-- <i class="bi bi-search"></i> --}}
                </a> </li>
            <!--end::Navbar Search-->
            <!--begin::Messages Dropdown Menu-->


            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <button class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center"
                        id="language-selector" type="button" aria-expanded="false" data-bs-toggle="dropdown"
                        data-bs-display="static">
                        <span class="language-icon-active">
                            @if (app()->getLocale() == 'en')
                                <img src="{{ asset('assets/images/en-flag.png') }}" width="24px" alt="English Flag">
                            @else
                                <img src="{{ asset('assets/images/ar-flag.png') }}" width="24px" alt="Arabic Flag">
                            @endif
                        </span>
                        <span class="d-lg-none ms-2" id="language-text">Select Language</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="language-text"
                        style="--bs-dropdown-min-width: 8rem;">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a class="dropdown-item d-flex align-items-center" rel="alternate"
                                    hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    <img src="{{ asset('assets/images/' . $localeCode . '-flag.png') }}" width="24px"
                                        alt="{{ $properties['native'] }} Flag" class="me-2">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>





            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <button class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center"
                        id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown"
                        data-bs-display="static">
                        <span class="theme-icon-active">
                            {{-- <i class="my-1"></i> --}}
                            {{-- "bi bi-moon-fill me-2" --}}
                            <i class="bi bi-moon-fill me-2"></i>
                        </span>
                        <span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text"
                        style="--bs-dropdown-min-width: 8rem;">
                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center active"
                                data-bs-theme-value="light" aria-pressed="false">
                                <i class="bi bi-sun-fill me-2"></i>
                                {{ __('dashboard.layout.light') }}
                                <i class="bi bi-check-lg ms-auto d-none"></i>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center"
                                data-bs-theme-value="dark" aria-pressed="false">
                                <i class="bi bi-moon-fill me-2"></i>
                                {{ __('dashboard.layout.dark') }}
                                <i class="bi bi-check-lg ms-auto d-none"></i>
                            </button>
                        </li>
                        {{-- <li>
                            <button type="button" class="dropdown-item d-flex align-items-center"
                                data-bs-theme-value="auto" aria-pressed="true">
                                <i class="bi bi-circle-fill-half-stroke me-2"></i>
                                Auto
                                <i class="bi bi-check-lg ms-auto d-none"></i>
                            </button>
                        </li> --}}
                    </ul>
                </li>
            </ul>





            {{-- <li class="nav-item dropdown"> <a class="nav-link" data-bs-toggle="dropdown" href="#"> <i
                        class="bi bi-chat-text"></i> <span class="navbar-badge badge text-bg-danger">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <a href="#"
                        class="dropdown-item"> <!--begin::Message-->
                        <div class="d-flex">
                            <div class="flex-shrink-0"> <img
                                    src="{{ asset('assets/dist/assets/img/user1-128x128.jpg') }}"
                                    alt="User Avatar" class="img-size-50 rounded-circle me-3"> </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-end fs-7 text-danger"><i
                                            class="bi bi-star-fill"></i></span>
                                </h3>
                                <p class="fs-7">Call me whenever you can...</p>
                                <p class="fs-7 text-secondary"> <i class="bi bi-clock-fill me-1"></i> 4 Hours
                                    Ago
                                </p>
                            </div>
                        </div> <!--end::Message-->
                    </a>
                    <div class="dropdown-divider"></div> <a href="#" class="dropdown-item">
                        <!--begin::Message-->
                        <div class="d-flex">
                            <div class="flex-shrink-0"> <img
                                    src="{{ asset('assets/dist/assets/img/user8-128x128.jpg') }}"
                                    alt="User Avatar" class="img-size-50 rounded-circle me-3"> </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-end fs-7 text-secondary"> <i
                                            class="bi bi-star-fill"></i>
                                    </span>
                                </h3>
                                <p class="fs-7">I got your message bro</p>
                                <p class="fs-7 text-secondary"> <i class="bi bi-clock-fill me-1"></i> 4 Hours
                                    Ago
                                </p>
                            </div>
                        </div> <!--end::Message-->
                    </a>
                    <div class="dropdown-divider"></div> <a href="#" class="dropdown-item">
                        <!--begin::Message-->
                        <div class="d-flex">
                            <div class="flex-shrink-0"> <img
                                    src="{{ asset('assets/dist/assets/img/user3-128x128.jpg') }}"
                                    alt="User Avatar" class="img-size-50 rounded-circle me-3"> </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-end fs-7 text-warning"> <i class="bi bi-star-fill"></i>
                                    </span>
                                </h3>
                                <p class="fs-7">The subject goes here</p>
                                <p class="fs-7 text-secondary"> <i class="bi bi-clock-fill me-1"></i> 4 Hours
                                    Ago
                                </p>
                            </div>
                        </div> <!--end::Message-->
                    </a>
                    <div class="dropdown-divider"></div> <a href="#"
                        class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li> <!--end::Messages Dropdown Menu--> --}}

            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown"> <a class="nav-link" data-bs-toggle="dropdown" href="#"> <i
                        class="bi bi-bell-fill"></i>
                    @if (auth()->user()->unreadNotifications->count() > 0)
                        <span class="navbar-badge badge text-bg-danger"><strong>{{ auth()->user()->unreadNotifications->count() }}</strong></span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end notification-container">
                    @if (auth()->user()->unreadNotifications->count() == 0)
                        <span class="dropdown-item dropdown-header">{{ __('dashboard.notification.no_notify') }}</span>
                    @else
                        <span class="dropdown-item dropdown-header">{{ auth()->user()->unreadNotifications->count() }}
                            {{ __('dashboard.notification.notification') }}</span>

                        @foreach (auth()->user()->unreadNotifications as $notification)
                            <div class="dropdown-divider"></div>
                            <a href="{{ $notification->data['url'] }}" class="dropdown-item">
                                <i class="{{ $notification->data['icon'] }} me-2"></i> {{ __($notification->data['message']) }}
                            </a>
                        @endforeach

                        <div class="dropdown-divider"></div> <a href="{{ route('markAsRead', auth()->user()->id) }}" class="dropdown-item dropdown-footer">
                            {{ __('dashboard.notification.mark_as_read') }}
                        </a>
                    @endif
                </div>
            </li> <!--end::Notifications Dropdown Menu--> <!--begin::Fullscreen Toggle-->
            <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i
                        data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize"
                        class="bi bi-fullscreen-exit" style="display: none;"></i>
                </a> </li> <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"> <img src="{{ Auth::user()->image }}"
                        class="user-image rounded-circle shadow" alt="User Image"> <span
                        class="d-none d-md-inline">{{ Auth::user()->name }}</span> </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                    <li class="user-header text-bg-success"> <img src="{{ Auth::user()->image }}"
                            class="rounded-circle shadow" alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>{{ Auth::user()->email }}</small>
                        </p>
                    </li> <!--end::User Image--> <!--begin::Menu Body-->
                    {{--    <li class="user-body"> <!--begin::Row-->
                         <div class="row">
                            <div class="col-4 text-center"> <a href="#">Followers</a> </div>
                            <div class="col-4 text-center"> <a href="#">Sales</a> </div>
                            <div class="col-4 text-center"> <a href="#">Friends</a> </div>
                        </div> <!--end::Row-->
                    </li> <!--end::Menu Body--> --}}
                    <!--begin::Menu Footer-->
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">{{ __('dashboard.layout.profile') }}</a>
                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-end"
                            onclick="event.preventDefault(); disableBackButton(); document.getElementById('logout-form').submit();">
                            {{ __('dashboard.layout.sign_out') }}
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                    <script>
                        function disableBackButton() {
                            // Disable back button by pushing a new state
                            window.history.pushState(null, "", window.location.href);
                            window.onpopstate = function() {
                                // Redirect to login page or another location after logout if the user presses the back button
                                window.location.href = "{{ route('login') }}";
                            };
                        }
                    </script>
                    <!--end::Menu Footer-->
                </ul>
            </li> <!--end::User Menu Dropdown-->
        </ul> <!--end::End Navbar Links-->
    </div> <!--end::Container-->
</nav>

<script>
    // Color Mode Toggler
    (() => {
        "use strict";

        const storedTheme = localStorage.getItem("theme");

        const getPreferredTheme = () => {
            if (storedTheme) {
                return storedTheme;
            }

            return window.matchMedia("(prefers-color-scheme: dark)").matches ?
                "dark" :
                "light";
        };

        const setTheme = function(theme) {
            if (
                theme === "auto" &&
                window.matchMedia("(prefers-color-scheme: dark)").matches
            ) {
                document.documentElement.setAttribute("data-bs-theme", "dark");
            } else {
                document.documentElement.setAttribute("data-bs-theme", theme);
            }
        };

        setTheme(getPreferredTheme());

        const showActiveTheme = (theme, focus = false) => {
            const themeSwitcher = document.querySelector("#bd-theme");

            if (!themeSwitcher) {
                return;
            }

            const themeSwitcherText = document.querySelector("#bd-theme-text");
            const activeThemeIcon = document.querySelector(".theme-icon-active i");
            const btnToActive = document.querySelector(
                `[data-bs-theme-value="${theme}"]`
            );
            const svgOfActiveBtn = btnToActive.querySelector("i").getAttribute("class");

            for (const element of document.querySelectorAll("[data-bs-theme-value]")) {
                element.classList.remove("active");
                element.setAttribute("aria-pressed", "false");
            }

            btnToActive.classList.add("active");
            btnToActive.setAttribute("aria-pressed", "true");
            activeThemeIcon.setAttribute("class", svgOfActiveBtn);
            const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`;
            themeSwitcher.setAttribute("aria-label", themeSwitcherLabel);

            if (focus) {
                themeSwitcher.focus();
            }
        };

        window
            .matchMedia("(prefers-color-scheme: dark)")
            .addEventListener("change", () => {
                if (storedTheme !== "light" || storedTheme !== "dark") {
                    setTheme(getPreferredTheme());
                }
            });

        window.addEventListener("DOMContentLoaded", () => {
            showActiveTheme(getPreferredTheme());

            for (const toggle of document.querySelectorAll("[data-bs-theme-value]")) {
                toggle.addEventListener("click", () => {
                    const theme = toggle.getAttribute("data-bs-theme-value");
                    localStorage.setItem("theme", theme);
                    setTheme(theme);
                    showActiveTheme(theme, true);
                });
            }
        });
    })();
</script>
