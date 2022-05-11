@extends('admin::layouts.master')   
@section('content')  
    {!! Form::model($quiz_question, ['method' => 'PATCH', 'route' => ['quiz-questions.update', $quiz_question->id],'class'=>'steps-validation','id'=>'quiz_questions_form','enctype'=>'multipart/form-data']) !!}     
    @include('admin::quiz.questions.form', compact('quiz_question'))
    {!! Form::close() !!} 
@stop
 
             
  
