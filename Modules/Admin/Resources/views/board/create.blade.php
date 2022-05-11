@extends('admin::layouts.master')  
@section('content')  
    {!! Form::model($board, ['method' => 'POST', 'route' => ['board.store'],'class'=>'form-valide','id'=>'board_form','enctype'=>'multipart/form-data']) !!}    
    @include('admin::board.form',compact($board)) 
    {!! Form::close() !!} 
@stop
 
             
  
