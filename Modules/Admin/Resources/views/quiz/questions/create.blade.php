@extends('admin::layouts.master')  
@section('content')  
    {!! Form::model($quiz_question, ['method' => 'POST', 'route' => ['quiz-questions.store'],'class'=>'form-valide','id'=>'quiz_questions_form','enctype'=>'multipart/form-data']) !!}    
    @include('admin::quiz.questions.form',compact($quiz_question)) 
    {!! Form::close() !!} 
@stop
 
             
  
