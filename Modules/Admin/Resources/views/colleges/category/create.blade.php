@extends('admin::layouts.master')  
@section('content')  
    {!! Form::model($CollegeCategory, ['method' => 'POST', 'route' => ['college-category.store'],'class'=>'form-valide','id'=>'college_category_form','enctype'=>'multipart/form-data']) !!}    
    @include('admin::colleges.category.form',compact($CollegeCategory)) 
    {!! Form::close() !!} 
@stop
 
             
  
