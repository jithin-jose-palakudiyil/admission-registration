@extends('admin::layouts.master')  
@section('content')  
    {!! Form::model($quiz, ['method' => 'POST', 'route' => ['quiz.store'],'class'=>'form-valide','id'=>'quiz_form','enctype'=>'multipart/form-data']) !!}    
    @include('admin::quiz.form',compact($quiz)) 
    {!! Form::close() !!} 
@stop
 
             
  
