@extends('lms.layout.master')
{{-- @dd(session()->getOldInput()) --}}
@section('seo-breadcrumb')
{{-- {{ Breadcrumbs::view('breadcrumbs::json-ld', 'sites.types.create', $site_id) }} --}}
@endsection

@section('page-title', __('lang.commons.create').' '.__('lang.fields.activity.singular'))

@section('page-vendor')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<link rel="stylesheet" type="text/css"
    href="{{ asset('app-assets') }}/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset('app-assets') }}/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset('app-assets') }}/vendors/css/tables/datatable/buttons.bootstrap5.min.css">

@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/plugins/forms/form-validation.css">

@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-start mb-0">{{__('lang.commons.create')}}
                {{__('lang.fields.activity.singular')}}</h2>
            <div class="breadcrumb-wrapper">
                {{ Breadcrumbs::render('activity.create', $topic) }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card">
<form class="form-vertical" id="activity-form" action="{{ route('topic.activity.store',$topic->slug)}}" method="POST" enctype="multipart/form-data">

        <div class="card-header">
          
            </div>
        <div class="card-body">
            @csrf
            <textarea style="display:none" name="body" id="body_field"></textarea>

            @include('lms.activities.form-fields')
        </div>


        <div class="card-body1" id="question_container">


        </div>
        

        <div class="card-footer d-flex align-items-center justify-content-end">
            <button type="button" id="add_question" onclick="addquestion()" class="btn btn-relief-outline-primary waves-effect waves-float waves-light me-1 d-none">Add Question</button>
               
            <button type="button" onclick="formSubmit()" class="btn btn-relief-outline-success waves-effect waves-float waves-light me-1">
                <i data-feather='save'></i>
                {{__('lang.commons.save')}} {{__('lang.fields.activity.singular')}}
            </button>
            <a href="{{ route('course.topic.show',[$topic->course->slug, $topic->slug])}}"
                class="btn btn-relief-outline-danger waves-effect waves-float waves-light">
                <i data-feather='x'></i>
                {{ __('lang.commons.cancel') }}
            </a>
        </div>

    </form>
</div>
@endsection
@section('vendor-js')
@endsection

@section('page-js')
@endsection
@section('custom-js')
<script src="../../../lms/app-assets/js/scripts/forms/form-number-input.min.js"></script>

<script src="../../../lms/app-assets/js/scripts/forms/pickers/form-pickers.min.js"></script>
 <script src="//cdn.quilljs.com/latest/quill.min.js"></script>

    <script>
        var banks = [];
        var selectedBankQuestions = ``;
        var questionrow = 1;
        bank_row_id = 1;

            function formSubmit(){
                let form = $('#activity-form');
                $('#body_field').val($('.ql-editor').html())
                form.submit();
                
            }

            var allcontent = ``
            $(document).ready(function(){
            
            
            //after validation fails
            @if(session()->getOldInput())
                let bank_ids = @json(old('bank_ids'));
                let question_ids = @json(old('question_ids'));
                let marks = @json(old('marks'));

                getAllBanks().then(() => {
                    console.log('renderQuestion');
                    
                    renderQuestion(bank_ids,question_ids,marks)
                });
                
                console.log(bank_ids,question_ids,marks);
            @endif
            //after validation fails

            
            $("#type").change(()=>{

                let wysiwig_editor = `
                <div class="col-12 additional-fields">
                    <div class="mb-2">
                    <label class="form-label">Content</label>
                    <div id="blog-editor-wrapper">
                        <div id="blog-editor-container">
                        <div class="editor" id='editor'>
                            
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                `;
            
                let form = $('.card-body');
                let selection = $("#type").val();
                    if(selection == 1){
                        $(".additional-fields").remove();
                        console.log('wysiwig')
                        // let input = `<div class='mb-1'>
                        //     <label class="form-label additional-fields" for="body">{{__('lang.commons.body')}}</label>
                        //     <input type="text" class="form-control additional-fields" id="body" name="body" placeholder ='{{__('lang.commons.body')}}'/>
                        //     </div>`;
                        form.append(wysiwig_editor)
                        var quill = new Quill('#editor', {
                                theme: 'snow'
                            });
                    }
                else if(selection == 2){
                    console.log('Resource')
                        $(".additional-fields").remove();
                        let input = `<div class='mb-1'>
                            <label class="form-label additional-fields" for="file">{{__('lang.commons.file')}}</label>
                            <input type="file" class="form-control additional-fields" id="file" name="file" placeholder ='{{__('lang.commons.file')}}'/>
                            </div>`;
                        form.append(input)
                    }

                    else if(selection == 3){    
                        console.log('Quiz')
                        $('#add_question').removeClass('d-none')
                        $('#add_question').addClass('d-block')

                        $(".additional-fields").remove();
                        let input = `<div class='mb-1' >
                            <label class="form-label additional-fields" for="name">{{__('lang.fields.quiz.name')}}</label>
                            <input type="text" class="form-control additional-fields" id="name" name="name" placeholder ='{{__('lang.fields.quiz.name')}}' value="{{old('name')}}"/>
                                                   
                            <label class="form-label additional-fields" for="duration">{{__('lang.fields.quiz.duration')}}</label>
                            <input type="text" class="form-control additional-fields" id="duration" name="duration" value="{{old('duration')}}" placeholder ='{{__('lang.fields.quiz.duration')}}'/>
                            
                            <label class="form-label additional-fields" for="start-date-time">Start Date time</label>
                            <input type="text" id="start-date-time" class="form-control flatpickr-date-time additional-fields" placeholder="YYYY-MM-DD HH:MM" name='start_date' value="{{old('start_date')}}"/>

                            <label class="form-label additional-fields" for="end-date-time">End Date time</label>
                            <input type="text" id="end-date-time" class="form-control flatpickr-date-time additional-fields" placeholder="YYYY-MM-DD HH:MM" name='end_date' value="{{old('end_date')}}"/>
          
                            <label class="form-label additional-fields" for="total_marks">{{__('lang.fields.quiz.total_marks')}}</label>
                            <input type="number" class="form-control additional-fields" id="total_marks" name="total_marks" value="{{old('total_marks')}}"  placeholder ='{{__('lang.fields.quiz.total_marks')}}'/>

                            <label class="form-label additional-fields" for="passing_marks">{{__('lang.fields.quiz.passing_marks')}}</label>
                            <input type="number" class="form-control additional-fields" id="passing_marks" name="passing_marks" value="{{old('passing_marks')}}"  placeholder ='{{__('lang.fields.quiz.passing_marks')}}'/>
                            <div class="divider my-2">
                                <div class="divider-text">Questions</div>
                                </div>

                            </div>`;
                            // ahmar script 
                        form.append(input)
                        // $('#fp-date-time').flatpickr()   
                        flatpickr('#start-date-time',{
                                    enableTime: true,
                                    dateFormat: "Y-m-d H:i",
                                    hour24: true,
                                    defaultDate: "{{old('start_date') ?? 'today'}}"
                                });
                        flatpickr('#end-date-time',{
                            enableTime: true,
                            hour24: true,
                            dateFormat: "Y-m-d H:i",
                            defaultDate: "{{old('end_date') ?? 'today'}}"
                        });

                        $.ajax({
                                    url: '/question-banks',
                                    method: "GET",
                                    success: (res) => {
                                        banks = res;
                                        res.forEach(element => {
                                        })
                                    }                            
                                })
                        

                    }
                    if(selection == 4){
                        console.log('Scorm')
                        $(".additional-fields").remove();
                        let input = `<div class='mb-1'>
                            <label class="form-label additional-fields" for="body">{{__('lang.fields.scorm.scorm')}}</label>
                            <input type="file" class="form-control additional-fields" id="file" name="zip"/>
                            </div>`;
                        form.append(input)
                    }
            }).change();
        });
        // function formSubmit(form){
        //     console.log('here we are submitting form')
        //     // this.submit();/
        // }

        
        function addquestion() {
            
                $('#question_container').append(questionTemplate());
                $(`#bank_${questionrow}`).select2();
                $(`#questions_${questionrow}`).select2();
                $(`#questions_${questionrow}`).select2();
                $(`#marks_${questionrow}`).TouchSpin();
                questionrow++;
                // bankChange()

            }
        
            
            function questionTemplate() {
                console.log('questionrow',questionrow)
                
                // let index = $(`#question_container input[type="radio"]`).length;
                let banksOptions = ``;
                banks.forEach(element => {
                    banksOptions += `<option value="${element.id}" name="bank_questions[]">${element.name}</option>`;                   
                });

            
                return `
                <div class="row single-answer d-flex align-items-center p-2" id='question_row_${questionrow}'>
                    <div class="form-group col-1">
                        <div class="mb-1">
                        <button type="button" onclick="deleteItem(this)" class="btn btn-relief-outline-danger waves-effect waves-float waves-light">X</button>
                    </div>
                    </div>
                    <div class="col-5">
                        <div class="mb-1">
                                <select name="bank_ids[]" onchange='bankChange(this)' value="{{old('banks')}}" id="bank_${questionrow}" class="select2-size-lg form-select">
                                ${banksOptions}
                                </select>
                            </div>
                    </div>
                <div class="col-4">
                    <div class="mb-1">
                    <select id="questions_bank_${questionrow}" class="select2-size-lg form-select" value="{{old('question_ids[]')}}" name='question_ids[]' filled>
                    </select> 
                    </div>   
                    </div>
                <div class="form-group col-2">
                        <div class="mb-1">
                            <div class="input-group">
                             <input type="number" id="marks_${questionrow}" class="touchspin" name="marks[]"  value="0" />
                            </div>
                        </div>
                    </div>
                
                </div>
                `;
                
            }
            function deleteItem(ele) {
                $(ele).parents('.single-answer').remove();
                $(`#question_container input[name="is_correct[]"]`).each((i, item)=>{
                    $(item).val(i);
                });

            }

            function bankChange(el){
                
                bank_id = $(el).val()
                let id = $(el).attr('id');
                console.log(id,'el id')
                console.log(`bank_${questionrow}`,'id ')
                $(`#questions_${id}`).empty()
                console.log(bank_id)
                            $.ajax({
                                    url: `/question-banks/${bank_id}/questions`,
                                    method: "GET",
                                    success: (res) => {
                                        let allbankquestions
                                    res.forEach(element => {                                            
                                                    allbankquestions += `
                                                <option value="${element.id}">${element.name}</option>;`                         
                                                });
                                                
                                                 $(`#questions_${id}`).select2();
                                                $(`#questions_${id}`).append(`${allbankquestions}`);                                
                                        }                                                               
                                  })

                                }
    

    async function getAllBanks()
    {
        await $.ajax({
                    url: '/question-banks',
                    method: "GET",
                    success: (res) => {
                        banks = res;
                        res.forEach(element => {
                        })
                    }                            
                })
                // $(`#bank_${questionrow}`).select2();
                // $(`#questions_${questionrow}`).select2();
                // $(`#questions_${questionrow}`).select2();
                // $(`#marks_${questionrow}`).TouchSpin();
                console.log('getAllBanks');
    }
    function renderQuestion(bank_ids,question_ids,marks)
    {
        bank_ids.forEach((bank_id,index)=>{

            let questionTemplate = renderQuestionTemplate(bank_id,question_ids[index],marks[index]);
            // console.log('questionTemplate');
            // console.log(questionTemplate);
            // $('#question_container').append(questionTemplate);
        });
    }
    function renderQuestionTemplate(bank_id,question_id,marks)
    {
        let banksOptions = ``;
      
        getAllAnswersOptions(bank_id,question_id).then(()=>{
            console.log('after getting answers');
            
            banks.forEach(element => {
                banksOptions += `<option value="${element.id}" name="bank_questions[]"`;
                if(bank_id == element.id)
                   banksOptions += ` selected`;
                banksOptions += `>${element.name}</option>`;                   
            });

        


        let template = `
                <div class="row single-answer d-flex align-items-center p-2" id='question_row_${questionrow}'>
                    <div class="form-group col-1">
                        <div class="mb-1">
                        <button type="button" onclick="deleteItem(this)" class="btn btn-relief-outline-danger waves-effect waves-float waves-light">X</button>
                    </div>
                    </div>
                    <div class="col-5">
                        <div class="mb-1">
                                <select name="bank_ids[]" onchange='bankChange(this)' value="${bank_id}" id="bank_${bank_row_id}" class="select2-size-lg form-select">
                                ${banksOptions}
                                </select>
                            </div>
                    </div>
                <div class="col-4">
                    <div class="mb-1">
                    <select id="questions_bank_${questionrow}" class="select2-size-lg form-select" value="${question_id}" name='question_ids[]' filled>
                        ${selectedBankQuestions}
                        <option>Hello</option>
                    </select> 
                    </div>   
                    </div>
                <div class="form-group col-2">
                        <div class="mb-1">
                            <div class="input-group">
                             <input type="number" id="marks_${questionrow}" class="touchspin" name="marks[]"  value="${marks}" />
                            </div>
                        </div>
                    </div>
                
                </div>
                `;
                
                
                $('#question_container').append(template);
                
                $(`#bank_${bank_row_id}`).select2();
                $(`#questions_bank_${questionrow}`).select2();
                $(`#marks_${questionrow}`).TouchSpin();
                
                questionrow++;
                bank_row_id++;

            });
        
    }
    async function getAllAnswersOptions(bank_id,question_id)
    {
        
        await $.ajax({
                        url: `/question-banks/${bank_id}/questions`,
                        method: "GET",
                        success: (res) => {
                            selectedBankQuestions = ``;
                            res.forEach(element => {                                            
                                 selectedBankQuestions += `<option value="${element.id}"`;   
                                 if(element.id == question_id)
                                    selectedBankQuestions += ` selected`;
                                 selectedBankQuestions += `>${element.name}</option>`;
                                });
                                console.log("select*********************",selectedBankQuestions);
                                // $(`#questions_${element.id}`).select2();
                                // $(`#questions_${element.id}`).append(`${options}`);                                
                                }                                                               
                    });
        return selectedBankQuestions;
    }
    </script>
    <style>
        #editor{
            height: 200px;
        }
    </style>
@endsection