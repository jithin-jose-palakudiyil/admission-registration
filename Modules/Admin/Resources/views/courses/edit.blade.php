@extends('admin::layouts.master')   
@section('content')  
    {!! Form::model($course, ['method' => 'PATCH', 'route' => ['courses.update', $course->id],'class'=>'steps-validation','id'=>'course_form','enctype'=>'multipart/form-data']) !!}     
    @include('admin::courses.form', compact('course'))
    {!! Form::close() !!} 
@stop
 
             
  
