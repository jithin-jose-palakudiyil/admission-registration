@extends('admin::layouts.master')  
@section('content')  
    {!! Form::model($college, ['method' => 'POST', 'route' => ['colleges.store'],'class'=>'form-valide','id'=>'college_form','enctype'=>'multipart/form-data']) !!}    
    @include('admin::colleges.form',compact($college)) 
    {!! Form::close() !!} 
@stop
 
             
  
