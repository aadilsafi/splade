@extends('lms.layout.master')
@section('seo-breadcrumb')
{{--    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'home') }}--}}
@endsection

@section('page-title', 'Dashboard')

@section('page-vendor')
    <link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/vendors/css/charts/apexcharts.css">
@endsection

@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/css/pages/dashboard-ecommerce.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/css/plugins/charts/chart-apex.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/vendors/nestable/nestable.css">
@endsection

@section('custom-css')
@endsection

@section('seo-breadcrumb')
{{--    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'home') }}--}}
@endsection

@section('breadcrumbs')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-start mb-0">{{ __('lang.commons.course') }}s List</h2>
            <div class="breadcrumb-wrapper">
            {{ Breadcrumbs::render('course.index',$category) }}
            </div>
        </div>
    </div>
</div>

@endsection
@section('content')
   <section id="editusers">
    <div class="d-flex justify-content-between mb-2">
        <h4>{{ __('lang.commons.course') }}s List</h4>
        <a href="/category/1/course/create" class="btn btn-relief-primary">+{{ __('lang.commons.course') }}</a>
        </div>

        <div class="card p-3">


            {{-- <div class="cf nestable-lists"> --}}

                <div class="dd" id="nestable">
                    <ol class="dd-list">
                        <li class="dd-item" data-id="1">
                            <div class="dd-handle">
                                <div class="card">
                                    <h1>ahmar</h1>
                                </div>
                            </div>
                        </li>
                        <li class="dd-item" data-id="2">
                            <div class="dd-handle">
                                <div class="card">
                                   <h1>ahmar</h1>
                                </div>
                            </div>
                            <ol class="dd-list">
                                <li class="dd-item" data-id="3">
                                    <div class="dd-handle">
                                        <div class="card">
                                           <h1>ahmar</h1>
                                         </div>
                                    </div>
                                </li>
                                <li class="dd-item" data-id="4">
                                    <div class="dd-handle">Item 4</div>
                                </li>
                                <li class="dd-item" data-id="5">
                                    <div class="dd-handle">Item 5</div>
                                    <ol class="dd-list">
                                        <li class="dd-item" data-id="6"><div class="dd-handle">Item 6</div></li>
                                        <li class="dd-item" data-id="7"><div class="dd-handle">Item 7</div></li>
                                        <li class="dd-item" data-id="8"><div class="dd-handle">Item 8</div></li>
                                    </ol>
                                </li>
                                <li class="dd-item" data-id="9"><div class="dd-handle">Item 9</div></li>
                                <li class="dd-item" data-id="10"><div class="dd-handle">Item 10</div></li>
                            </ol>
                        </li>
                        <li class="dd-item" data-id="11">
                            <div class="dd-handle">Item 11</div>
                        </li>
                        <li class="dd-item" data-id="12">
                            <div class="dd-handle">Item 12</div>
                        </li>
                    </ol>
                </div>



            {{-- </div> --}}

                <p><strong>Serialised Output (per list)</strong></p>

                <textarea id="nestable-output"></textarea>

                <p>&nbsp;</p>

        </div>


   </section>

@endsection
@section('custom-js')
<script>

    $(document).ready(function() {

        var updateOutput = function(e)
        {
            var list   = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };

        // activate Nestable for list 1
        $('#nestable').nestable({
            group: 1
        })
        .on('change', updateOutput);

        // activate Nestable for list 2
        $('#nestable2').nestable({
            group: 1
        })
        .on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable').data('output', $('#nestable-output')));
        updateOutput($('#nestable2').data('output', $('#nestable2-output')));

        $('#nestable-menu').on('click', function(e)
        {
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });

        $('#nestable3').nestable();

});
</script>
@endsection

