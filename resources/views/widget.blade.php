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
@endsection

@section('custom-css')
@endsection

@section('seo-breadcrumb')
{{--    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'home') }}--}}
@endsection

@section('content')
{{ Breadcrumbs::render('widget') }}
   <section id="dashboard-ecommerce">
        <div class="row match-height">
            <div class="col-xl-4 col-md-6 col-12">
                    <div class="card p-3">
                        {{-- basic input --}}
                        <div class="mb-1">
                            <label class="form-label" for="basicInput">Basic Input</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="Enter email" />
                        </div>
                        {{--  --}}
                            <div class="mb-1">
                                <label class="form-label" for="helpInputTop">Input text with help</label>
                                <small class="text-muted">eg.<i>someone@example.com</i></small>
                                <input type="text" class="form-control" id="helpInputTop" />
                            </div>

                            <p>uses bootstrap.min.css</p>
                    </div>
           </div>
          <!-- Statistics Card -->
          <div class="col-xl-4 col-md-6 col-12">
            <div class="card p-3">
                <div class="mb-1">
                    <label class="form-label" for="helperText">With Helper Text</label>
                    <input type="text" id="helperText" class="form-control" placeholder="Name" />
                    <p><small class="text-muted">Find helper text here for given textbox.</small></p>
                  </div>
                  <div class="mb-1">
                  <label class="form-label" for="disabledInput">Readonly Input</label>
                  <input
                    type="text"
                    class="form-control"
                    id="readonlyInput"
                    readonly="readonly"
                    value="You can't update me :P"
                  />
                  </div>
                  <p>uses bootstrap.min.css and bootstrap-extended.min.css</p>
                </div>
          </div>
          <div class="col-xl-4 col-md-6 col-12">
            <div class="card p-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floating-label1" placeholder="Label-placeholder" />
                    <label for="floating-label1">Label-placeholder</label>
                  </div>
                  <p>uses bootstrap.min.css</p>
            </div>
          </div>
        </div>

        <!-- Basic File Browser start -->
        <div id="input-file-browser">
            <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    <h4 class="card-title">File input</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-lg-6 col-md-12 mb-1 mb-sm-0">
                        <label for="formFile" class="form-label">Simple file input</label>
                        <input class="form-control" type="file" id="formFile" />
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label for="formFileMultiple" class="form-label">Multiple files input</label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple />
                    </div>
                    <p class="mt-2">Uses bootstrap.min.css and only component.css</p>
                    </div>
                </div>
                </div>
            </div>
            </div>
            </div>
            <!-- validations start -->
            <div class="validations" id="validation">
                <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Input Validation States</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                         <div class="col-sm-6 col-12">
                            <label class="form-label" for="valid-state">Valid State</label>
                            <input
                            type="text"
                            class="form-control is-valid"
                            id="valid-state"
                            placeholder="Valid"
                            value="Valid"
                            required
                            />
                            <div class="valid-feedback">This is valid state.</div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <label class="form-label" for="invalid-state">Invalid State</label>
                            <input
                            type="text"
                            class="form-control is-invalid"
                            id="invalid-state"
                            placeholder="Invalid"
                            value="Invalid"
                            required
                            />
                            <div class="invalid-feedback">This is invalid state.</div>
                        </div>
                        </div>
                        <p class="mt-2">Uses bootstrap.min.css and app.min.css and only check component.css</p>
                    </div>
                    </div>
                </div>
               </div>
            </div>

            <!-- Tooltip validations start -->
            <div class="tooltip-validations" id="tooltip-validation">
                <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Input Validation States with Tooltips</h4>
                    </div>
                    <div class="card-body">

                        <form class="needs-validation" novalidate>
                        <div class="row g-1">
                            <div class="col-md-4 col-12 mb-3 position-relative">
                            <label class="form-label" for="validationTooltip01">First name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="validationTooltip01"
                                placeholder="First name"
                                value="Mark"
                                required
                            />
                            <div class="valid-tooltip">Looks good!</div>
                            </div>
                            <div class="col-md-4 col-12 mb-3 position-relative">
                            <label class="form-label" for="validationTooltip02">Last name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="validationTooltip02"
                                placeholder="Last name"
                                value="Otto"
                                required
                            />
                            <div class="valid-tooltip">Looks good!</div>
                            </div>
                            <div class="col-md-4 col-12 mb-3 position-relative">
                            <label class="form-label" for="validationTooltip03">City</label>
                            <input type="text" class="form-control" id="validationTooltip03" placeholder="City" required />
                            <div class="invalid-tooltip">Please provide a valid city.</div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                        <p class="mt-2">uses bootstrap.min.css</p>
                    </div>

                    </div>
                </div>
                </div>
            </div>



        </section>

@endsection
