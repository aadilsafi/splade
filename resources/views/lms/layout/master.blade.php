<!DOCTYPE html>

<html class="loading" lang="en">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @yield('seo-breadcrumb')

    <title>@yield('page-title') - {{ config('app.name', '') }}</title>
    <link rel="apple-touch-icon" href="{{asset('lms/app-assets/images/ico/apple-icon-120.')}}html">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('lms/app-assets/images/ico/favicon.')}}ico">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500&display=swap" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
{{--    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/vendors/css/vendors.min.')}}css">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/vendors/css/extensions/toastr.min.')}}css">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/vendors/css/animate/animate.min.')}}css">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/vendors/css/extensions/sweetalert2.min.')}}css">--}}
   <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/vendors/css/forms/select/select2.min.css')}}">
   
   <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
   <link rel="stylesheet" type="text/css"  href="{{asset('lms/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">
    @yield('page-vendor')

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/css/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/css/components.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/css/themes/dark-layout.min.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/css/core/menu/menu-types/vertical-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/css/plugins/forms/pickers/form-pickadate.min.css')}}">
{{--    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/css/plugins/extensions/ext-component-sweet-alerts.min.css')}}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/css/plugins/extensions/ext-component-toastr.min.css')}}">--}}
    @yield('page-css')
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
{{--    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/vendors/css/bootstrap-icons/font/bootstrap-icons.css')}}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/extras/cup.min.css')}}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/css/app.min.css')}}">--}}
    <!-- END: Custom CSS-->

    <style>
        .select2-container--default .select2-results>.select2-results__options {
            max-height: 250px !important;
        }
        .card-title,.content-header-title{
            font-variant: small-caps;
        }
        .img_styling{
            object-fit:cover; height:27px
        }
    </style>

    <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/vendors/css/charts/apexcharts.css')}}">

    @yield('custom-css')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    @php
    $batches = [];
    @endphp


    {{ view('lms.layout.topbar') }}

    {{ view('lms.layout.leftbar') }}

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            {{ view('lms.layout.alerts') }}


            @if (!request()->routeIs('home'))
            <div class="content-header row">
                @yield('breadcrumbs')
            </div>
            @endif

            <div class="content-header row">

            </div>

            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    {{-- {{ view('app.layout.customizer') }} --}}

    @includeWhen(count($batches) > 0, 'app.layout.queueLoading', ['batches' => $batches])
    {{-- {{ view('app.layout.queueLoading', ['batches' => $batches]) }} --}}

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    {{ view('lms.layout.footer') }}

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('lms/app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('lms/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"></script>
    <script src="{{asset('lms/app-assets/js/scripts/components/components-tooltips.min.js')}}"></script>
    <script src="{{asset('lms/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('lms/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('lms/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
    
    <script src="{{asset('lms/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    
    @yield('vendor-js')

    <!-- END: Page Vendor JS-->


    <!-- BEGIN: Theme JS-->
    <script src="{{asset('lms/app-assets/js/core/app-menu.min.js')}}"></script>
    <script src="{{asset('lms/app-assets/js/core/app.min.js')}}"></script>
    <script src="{{asset('lms/app-assets/js/scripts/customizer.min.js')}}"></script>
    <script src="{{asset('lms/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('lms/app-assets/js/scripts/forms/form-select2.min.js')}}"></script>

    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    @yield('page-js')
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }

            @forelse ($batches as $key => $batch)
                startQueueInterval('{{ $batch->job_batch_id }}', '{{ $key }}');
            @empty
            @endforelse

            // toggleAccordian();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        function showBlockUI(element = null) {
            blockUIOptions = {
                message: '<div class="spinner-grow text-primary" role="status"></div>',
                css: {
                    backgroundColor: 'transparent',
                    border: '0'
                },
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8
                }
            };
            if (element) {
                $(element).block(blockUIOptions);
            } else {
                $.blockUI(blockUIOptions);
            }
        }

        function hideBlockUI(element = null) {
            if (element) {
                $(element).unblock();
            } else {
                $.unblockUI();
            }
        }

        function changeTableRowColor(element) {
            if ($(element).is(':checked'))
                $(element).closest('tr').addClass('table-primary');
            else {
                $(element).closest('tr').removeClass('table-primary');
            }
        }

        function changeAllTableRowColor() {
            $('.dt-checkboxes').trigger('change');
        }
        function deleteByID(url) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: '{{ __('lang.commons.are_you_sure') }}',
                showCancelButton: true,
                cancelButtonText: '{{ __('lang.commons.cancel') }}',
                confirmButtonText: '{{ __('lang.commons.yes_delete') }}',
                confirmButtonClass: 'btn-danger',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                       url: url,
                       method: 'DELETE',
                       success: (res) => {
                           location.href = res;
                       },
                    });
                }
            });
        }

        function saveAndShow(){
            let redirect_to_show = $('#redirect_to_show');
            if(redirect_to_show.length > 0 ){
                $(redirect_to_show).val(true);
                $(redirect_to_show).parents('form').submit();
            }
        }

        function move(ele,direction,position,id,reorder_url){
            let parentRow = $(ele).parents('.single-item')[0];
            let siblingRow = direction === 'down'? $(parentRow).next() : $(parentRow).prev();

            if(siblingRow.length > 0){
                direction === 'down'? $(siblingRow).after(parentRow) : $(siblingRow).before(parentRow);
                $(parentRow).css('border','1px dashed lightgray');
                setTimeout(()=>{
                    $(parentRow).css('border','none');
                },2000);

                if(reorder_url){
                    $.ajax({
                        url: reorder_url,
                        method:'get',
                        data:{
                            position:direction === 'down'? position+1 : position-1,
                            id:id,
                        },
                        success:(res)=>{
                            console.log('res',res);
                        }

                    });
                }
            }
        }
        function convertToSlug(text) {
            let slug = $('#slug');
            console.warn(slug)
            // slug.val(text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, ''));
            slug.val(
            text
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '')
            );
        }

    </script>

    @yield('custom-js')

</body>
<!-- END: Body-->

</html>
