@extends('admin::layouts.master')   
@section('content')  
    {!! Form::model($college, ['method' => 'PATCH', 'route' => ['colleges.update', $college->id],'class'=>'steps-validation','id'=>'college_form','enctype'=>'multipart/form-data']) !!}     
    @include('admin::colleges.form', compact('college'))
    <input type="hidden" name="HdnEdit" id="HdnEdit" value="1"/>
    {!! Form::close() !!} 
@stop
 
             
  
