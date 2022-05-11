@extends('admin::layouts.master')  
@section('content')  
    {!! Form::model($CoursesCategory, ['method' => 'POST', 'route' => ['category.store'],'class'=>'form-valide','id'=>'category_form','enctype'=>'multipart/form-data']) !!}    
    @include('admin::category.form',compact($CoursesCategory)) 
    {!! Form::close() !!} 
@stop
 
             
  
