<!DOCTYPE html>
<html lang="en" @if (App::getLocale() == 'ar') dir="rtl" @endif>
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Green | @yield('page_title')</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Green | Dashboard">
    <meta name="author" content="ColorlibHQ">

    <!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">
    <!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css"
        integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css"
        integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">
    <!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    @if (App::getLocale() == 'en')
        <link href="{{ asset('assets/dist/css/adminlte.min.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('assets/dist/css/adminlte.rtl.min.css') }}" rel="stylesheet">
    @endif
    {{-- <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}"> --}}
    <!--end::Required Plugin(AdminLTE)--><!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Fullscreen background for the spinner */
        .spinner-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent black background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* Ensure it's on top of all other content */
            visibility: visible;
            opacity: 1;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        /* Hide spinner with transition */
        .spinner-hidden {
            visibility: hidden;
            opacity: 0;
        }

        /* Spinner size */
        .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        .table td {
            vertical-align: middle;
        }

        .actions-cell {
            /* min-height: 60px; */
            display: flex;
            align-items: center;
        }

        .invalid-feedback-req {
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: #ea868f;
        }

        .custom-pagination li.active span {
            background-color: #198754 !important;
            border-color: #198754 !important;
            color: #fff;
        }

        .custom-pagination .page-item a {
            color: #198754 !important;
            ;
        }

        .custom-pagination .page-link {
            border-radius: 0 !important;
        }


        .info-modal img {
            border-style: none;
        }

        .info-modal {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, auto));
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
            text-align: center;
        }

        .info-modal {
            padding: 1em;
            border-radius: 0.8em;
            /* background-color: #fefefe; */
            box-shadow: 0 2.8px 2.2px rgba(0, 0, 0, 0.02),
                0 6.7px 5.3px rgba(0, 0, 0, 0.028), 0 12.5px 10px rgba(0, 0, 0, 0.035),
                0 22.3px 17.9px rgba(0, 0, 0, 0.042), 0 41.8px 33.4px rgba(0, 0, 0, 0.05),
                0 100px 80px rgba(0, 0, 0, 0.07);
            position: relative;
        }

        .info-modal .card__info {
            margin: 1em 0;
            list-style-type: none;
            padding: 0;
        }

        .info-modal .card__info li {
            display: inline-block;
            text-align: center;
            padding: 0.5em;
        }

        .info-modal .card__info__stats {
            color: var(--main-accent-color);
            font-weight: bold;
            font-size: 1.2em;
            display: block;
        }

        .info-modal .card__info__stats+span {
            color: #969798;
            text-transform: uppercase;
            font-size: 0.8em;
            font-weight: bold;
        }

        .info-modal .card__text h2 {
            margin-bottom: 0.3em;
            font-size: 1.4em;
            color: #6f6f6f;
        }

        .info-modal .card__text p {
            margin: 0;
            color: #999;
            font-size: 0.95em;
        }


        @media (min-width: 425px) {
            .info-modal .card {
                padding: 3em;
            }

            .info-modal .card:after {
                top: 50px;
                right: 160px;
            }

            .info-modal .card__info li {
                padding: 1em;
            }

            .info-modal .card__action__button {
                padding: 0.9em 1.8em;
            }
        }
    </style>
</head> <!--end::Head--> <!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!-- Fullscreen Spinner Overlay -->
    <div id="spinner" class="spinner-overlay">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->

        @include('layouts.header')

        <!--end::Header-->

        <!--begin::Sidebar-->

        @include('layouts.sidebar')

        <!--end::Sidebar-->

        <!--begin::App Main-->


        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">@yield('page_title')</h3>
                        </div>
                        @if (!(trim($__env->yieldContent('page_title')) == __('dashboard.layout.home')))
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('dashboard') }}">{{ __('dashboard.layout.home') }}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        @yield('page_title')
                                    </li>
                                </ol>
                            </div>
                        @endif
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header-->
            @yield('content')

            <!-- Hidden form -->
            <form id="delete-form" action="" method="POST" style="display:none;">
                <!-- CSRF token for security (Laravel) -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- Spoofing the DELETE method -->
                <input type="hidden" name="_method" value="DELETE">
            </form>
        </main>

        <!--end::App Main-->

        <!--begin::Footer-->
        {{-- <footer class="app-footer"> <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">Anything you want</div> <!--end::To the end-->
            <!--begin::Copyright--> <strong>
                Copyright &copy; 2014-2024&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer> --}}
        <!--end::Footer-->

    </div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->

    <!-- Start JavaScript to change them color -->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!-- End JavaScript to change them color -->


    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
        integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous"></script> <!-- sortablejs -->

    <script>
        const connectedSortables =
            document.querySelectorAll(".connectedSortable");
        connectedSortables.forEach((connectedSortable) => {
            let sortable = new Sortable(connectedSortable, {
                group: "shared",
                handle: ".card-header",
            });
        });

        const cardHeaders = document.querySelectorAll(
            ".connectedSortable .card-header",
        );
        cardHeaders.forEach((cardHeader) => {
            cardHeader.style.cursor = "move";
        });
    </script>


    <!--begin::JavaScript-->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            "use strict";

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms =
                document.querySelectorAll(".needs-validation");

            // Loop over them and prevent submission
            Array.from(forms).forEach((form) => {
                form.addEventListener(
                    "submit",
                    (event) => {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add("was-validated");
                    },
                    false
                );
            });
        })();
    </script> <!--end::JavaScript-->
    <!-- JavaScript to hide spinner after page load -->
    <script>
        window.addEventListener('load', function() {
            var spinner = document.getElementById('spinner');
            spinner.classList.add('spinner-hidden'); // Hide the spinner with fade effect
        });
    </script>
    <script>
        const tooltipTriggerList = document.querySelectorAll(
            '[data-bs-toggle="tooltip"]',
        );
        const tooltipList = [...tooltipTriggerList].map(
            (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl),
        );
    </script>

    <!-- Start JavaScript to delete element from table -->
    <script>
        function deleteElement(elementId, rout) {
            Swal.fire({
                title: '{{ __('dashboard.layout.confirm_delete') }}',
                text: '{!! __('dashboard.layout.desc_delete') !!}',
                icon: 'warning',
                showCancelButton: true,
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-outline-success m-1 rounded-0 p-2',
                    cancelButton: 'btn btn-outline-danger m-1 rounded-0 p-2'
                },
                cancelButtonText: '{{ __('dashboard.layout.no_delete') }}',
                confirmButtonText: '{{ __('dashboard.layout.yes_delete') }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').setAttribute('action', `/${rout}/${elementId}`);
                    document.getElementById('delete-form').submit();
                }
            });
        }
    </script>
    <!-- End JavaScript to delete element from table -->

    @include('sweetalert::alert')

    <!-- Include SweetAlert2 CSS and JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body><!--end::Body-->

</html>
