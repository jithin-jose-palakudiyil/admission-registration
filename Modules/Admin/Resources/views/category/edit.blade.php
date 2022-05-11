@extends('admin::layouts.master')   
@section('content')  
    {!! Form::model($CoursesCategory, ['method' => 'PATCH', 'route' => ['category.update', $CoursesCategory->id],'class'=>'steps-validation','id'=>'category_form','enctype'=>'multipart/form-data']) !!}     
    @include('admin::category.form', compact('CoursesCategory'))
    {!! Form::close() !!} 
@stop
 
             
  
