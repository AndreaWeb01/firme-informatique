<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

    <head>
        <meta charset="utf-8" />
        <title>Dashboard | Firme de l'informatique</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="Firme de l'informatique" name="author" />

        <!-- App favicon -->
        <link rel="icon" type="image/png" sizes="48x48" href="{{ url('assets/frontend/image/favicon.ico') }}">

        <link href="{{ url('assets/backend/libs/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />

        <!-- Plugins css -->
        <link href="{{ url('assets/backend/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/backend/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/backend/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />

        <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>

        <!-- App css -->
        <link href="{{ url('/assets/backend/css/style.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('/assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ url('/assets/backend/js/config.js') }}"></script>
    </head>

    <body>

        <!-- Begin page -->
        <div class="layout-wrapper">

            <!-- ========== Left Sidebar ========== -->
            @include('layouts.back.sidebar')

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <!-- Start Page Content here -->
            <div class="page-content">

                <!-- ========== Topbar Start ========== -->
                <div class="navbar-custom">
                    @include("layouts.back.topbar")
                </div>
                <!-- ========== Topbar End ========== -->

                <div class="px-3">

                    @yield('contenu')

                </div> <!-- content -->

                <!-- Footer Start -->
                @include('layouts.back.footer')
                <!-- end Footer -->
        
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- App js -->
        <script src="{{ url('assets/backend/js/vendor.min.js') }}"></script>
        <script src="{{ url('assets/backend/js/app.js') }}"></script>

        <!-- Knob charts js -->
        <script src="{{ url('assets/backend/libs/jquery-knob/jquery.knob.min.js') }}"></script>

        <!-- Sparkline Js-->
        <script src="{{ url('assets/backend/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

        <script src="{{ url('assets/backend/libs/morris.js/morris.min.js') }}"></script>

        <script src="{{ url('assets/backend/libs/raphael/raphael.min.js') }}"></script>

        <!-- Dashboard init-->
        <script src="{{ url('assets/backend/js/pages/dashboard.js') }}"></script>

        <!-- Plugins js -->
        <script src="{{ url('assets/backend/libs/quill/quill.min.js') }}"></script>

        <!-- Demo js-->
        <script src="{{ url('assets/backend/js/pages/form-quilljs.js') }}"></script>

        {{-- <script>
            document.addEventListener('DOMContentLoaded', function () {
                var quill = new Quill('#editor', {
                    theme: 'snow'
                });
        
                // Synchroniser le contenu Quill avec le champ caché
                var contentInput = document.getElementById('content');
                quill.on('text-change', function () {
                    contentInput.value = quill.root.innerHTML;
                });
            });
        </script> --}}

        {{-- <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        </script> --}}

    </body>

</html>