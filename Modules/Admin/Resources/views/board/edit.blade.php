@extends('admin::layouts.master')   
@section('content')  
    {!! Form::model($board, ['method' => 'PATCH', 'route' => ['board.update', $board->id],'class'=>'steps-validation','id'=>'board_form','enctype'=>'multipart/form-data']) !!}     
    @include('admin::board.form', compact('board'))
   
    {!! Form::close() !!} 
@stop
 
             
  
