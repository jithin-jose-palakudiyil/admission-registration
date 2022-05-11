@extends('admin::layouts.master')  
@section('content')  
    {!! Form::model($course, ['method' => 'POST', 'route' => ['courses.store'],'class'=>'form-valide','id'=>'course_form','enctype'=>'multipart/form-data']) !!}    
    @include('admin::courses.form',compact($course)) 
    {!! Form::close() !!} 
@stop
 
             
  
