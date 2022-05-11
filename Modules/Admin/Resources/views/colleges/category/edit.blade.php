@extends('admin::layouts.master')   
@section('content')  
    {!! Form::model($CollegeCategory, ['method' => 'PATCH', 'route' => ['college-category.update', $CollegeCategory->id],'class'=>'steps-validation','id'=>'college_category_form','enctype'=>'multipart/form-data']) !!}     
    @include('admin::colleges.category.form', compact('CollegeCategory'))
    {!! Form::close() !!} 
@stop
 
             
  
