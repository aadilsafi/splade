@extends('lms.layout.master')

@section('seo-breadcrumb')
{{-- {{ Breadcrumbs::view('breadcrumbs::json-ld', 'sites.types.create', $site_id) }} --}}
@endsection

@section('page-title', $category->name)

@section('page-vendor')

@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/css/plugins/forms/form-validation.css">
<link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/vendors/nestable/nestable.css">
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-start mb-0">{{$category->name}}</h2>
            <div class="breadcrumb-wrapper">
                {{ Breadcrumbs::render('category.show', $category->slug) }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{__('lang.fields.category.sub_categories')}}</h2>
                </div>
                <div class="card-body">
                    <div class="dd nestableLists">
                        <ol class="dd-list">
                            @foreach($category->subCategories as $subcategory)
                                <li class="dd-item dd3-item shadow mb-1" data-id="{{$subcategory->id}}">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content d-flex justify-content-between">
                                        <h6 style="font-variant: small-caps">{{\Illuminate\Support\Str::title($subcategory->name)}}</h6>
                                        <a href="{{route('category.show',$subcategory->slug)}}">
                                            <i data-feather='eye'></i>
                                        </a>
                                    </div>
                                </li>
                             @endforeach
                        </ol>
                    </div>
                    <br>
                    <textarea name="" id="nestable-output" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{__('lang.fields.course.plural')}}</h2>
                </div>
                <div class="card-body">
                    <div class="dd nestableLists">
                        <ol class="dd-list">
                            @foreach($category->courses as $course)
                                <li class="dd-item dd3-item shadow mb-1 pl-2  pt-1 pb-1" data-id="{{$course->id}}">
                                    <div class="dd-handle dd3-handle mt-2"></div>
                                    <div class="dd3-content d-flex justify-content-between">
                                        <h6>{{$course->title}}</h6>
                                        <a href="{{route('category.course.show',[$category->slug,$course->slug])}}">
                                            <i data-feather='eye'></i>
                                        </a>
                                    </div>
                                </li>
                             @endforeach
                        </ol>
                    </div>
                    <br>
                </div>

                <div class="card-footer d-flex align-items-center justify-content-end">
                    {{-- button here --}}
                    <a href="{{ route('category.index') }}"
                        class="btn btn-relief-outline-danger waves-effect waves-float waves-light">
                        <i data-feather='x'></i>
                        {{ __('lang.commons.cancel') }}
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('vendor-js')
@endsection

@section('page-js')
@endsection

@section('custom-js')
<script>

    function itemMoved(e){
        let list   = e.length ? e : $(e.target);
        let output = list.data('output');
        console.log(list.nestable('serialize'));
        if (window.JSON) {
            $.ajax({
                url: "/nestable",
                method: "POST",
                data: {
                    __token : @json(csrf_token()),
                    data: window.JSON.stringify(list.nestable('serialize'))

                },
                success: (res) => {
                    console.log({res});
                }
            })
            // output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    }

    $('.nestableLists').nestable().on('change', itemMoved);
    // itemMoved($('.nestableLists').data('output', $('#nestable-output')));

        // var updateOutput = function(e)
        // {
        //     var list   = e.length ? e : $(e.target),
        //         output = list.data('output');
        //     if (window.JSON) {
        //         output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        //     } else {
        //         output.val('JSON browser support required for this demo.');
        //     }
        // };
        //
        // // activate Nestable for list 1
        // $('#subcategories_nest').nestable()
        // // .on('change', updateOutput);
        // $('#course_nestable').nestable()
        // // .on('change', updateOutput);
        //
        // // output initial serialised data
        // updateOutput($('#subcategories_nest').data('output', $('#nestable-output')));
        // updateOutput($('#course_nestable').data('output', $('#nestable-output')));
        //
        // $('#nestable3').nestable();

</script>
@endsection
