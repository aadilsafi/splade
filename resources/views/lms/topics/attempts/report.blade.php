{{-- @dd($quiz->duration) --}}
@extends('lms.layout.master')

@section('seo-breadcrumb')
@endsection

@section('page-title', 'Report')


@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/plugins/forms/form-validation.css">
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-11">
            <h2 class="content-header-title float-start mb-0" title="Quiz Report">Quiz Report</h2>
            <div class="breadcrumb-wrapper">
                 {{-- {{ Breadcrumbs::render('topic.show', $course, $topic) }} --}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="container">
    <!-- Earnings Card For Admin User-->
   @if(auth()->user()->isAdmin)
   <div class="col-lg-12 col-md-6 col-12">
    <div class="card earnings-card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h4 class="card-title mb-1">Result</h4>
            <div class="font-small-2">This Week</div>
            <h5 class="mb-1">Fail</h5>
            <p class="card-text text-muted font-small-1">
              <span class="fw-bolder">{{($report->score/$report->total_marks)* 100 }} %</span><span> marks Acheived</span>
            </p>
          </div>
          <div class="col-6">
            <div id="result-chart"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @else
  <!-- Earnings Card For Admin User-->
   <!-- Earnings Card For Normal User-->
   <div class="col-lg-12 col-md-6 col-12">
    <div class="card earnings-card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h4 class="card-title mb-1">Result</h4>
            <div class="font-small-2">This Week</div>
            <h5 class="mb-1">{{$report->status ?? 'Not Attempted'}}</h5>
            <p class="card-text text-muted font-small-1">
              <span class="fw-bolder">{{$report ? ($report->score/$report->total_marks)* 100 : 0 }} %</span><span> marks Acheived</span>
            </p>
          </div>
          <div class="col-6">
            <div id="result-chart"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
  <!-- Earnings Card For Normal User-->
</div>
@endsection

@section('vendor-js')
@endsection

@section('page-js')
<script src="{{asset('lms/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('lms/app-assets/js/scripts/pages/dashboard-ecommerce.min.js')}}"></script>


@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/vendors/css/charts/apexcharts.css')}}">
@endsection

@section('custom-js')
<script>
    var options = {
          series: [{{$report ? $report->score : 0}},{{$report ? $report->total_marks : 100}}],
          chart: {
          width: 380,
          type: 'donut',
        },
        dataLabels: {
          enabled: false
        },
        labels: ['Score', 'Total Marks'],
        colors: ['#00E396', '#FF0000']
        };
        var chart = new ApexCharts(document.querySelector("#result-chart"), options);
        chart.render();
</script>
@endsection
