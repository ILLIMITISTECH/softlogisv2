<!doctype html>
<html lang="fr">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png"/>
	<!--plugins-->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>

	<link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
	<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet"/>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>



    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
	{{-- <!-- loader-->
	<link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet"/>
	<script src="{{ asset('assets/js/pace.min.js') }}"></script> --}}
	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/css/header-colors.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/step.css') }}">
    <link href="{{ asset('assets/plugins/bs-stepper/css/bs-stepper.css') }}" rel="stylesheet" />

    {{-- pdf --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.9.2/viewer.min.css">

	<title>SoftLogis - Tableau de bord Admin</title>
</head>

<body>

	<!--wrapper-->
	<div class="wrapper">

        <!--sidebar wrapper -->
		@include('admin.layouts.sideBar')
        <!--end sidebar wrapper -->

		<!--start header -->
		@include('admin.layouts.header')
		<!--end header -->

        <div class="page-wrapper" style="margin-bottom: 80px">
            @yield('section')
        </div>

        <!--start overlay-->
		<div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
           <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
         <!--End Back To Top Button-->
         <footer class="page-footer">
             <p class="mb-0">Copyright © 2023. ILLIMITIS group.</p>
         </footer>
    </div>
    <!--end wrapper-->

	<!-- Bootstrap JS -->

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


	{{-- <script src="{{ asset('assets/js/jquery.min.js') }}"></script> --}}

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>


	<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

	<script src="{{ asset('assets/js/index.js') }}" ></script>
	<script src="{{ asset('assets/plugins/chartjs/js/chart.js') }}" ></script>
	
	
	
	<script src="{{ asset('assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
	<script src="{{ asset('assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/index3.js') }}" ></script>
	<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apex-custom.js')}}"></script>

	<script src="{{ asset('assets/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/bs-stepper/js/main.js') }}"></script>

    {{-- <script src="{{ asset('pdfjs/build/pdf.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.min.js"></script>

	<!--app JS-->
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/raphael/raphael-min.js')}}"></script>
	<script src="{{ asset('assets/plugins/morris/js/morris.js')}}"></script>
	<script src="{{ asset('assets/js/index2.js') }}" ></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/rowgroup/1.1.3/js/dataTables.rowGroup.min.js"></script>

	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: true,
				buttons: [ 'copy', 'excel', 'pdf', 'print'],
                language: {
                search: "Recherche :",
            },
			} );

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.9.2/viewer.min.js"></script>
	<script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="{{ asset('js/scripts.js') }}" defer></script>
	<script>
        new PerfectScrollbar(".app-container")
        new PerfectScrollbar('.email-navigation');
		new PerfectScrollbar('.email-read-box');
    </script>

</html>

</body>
