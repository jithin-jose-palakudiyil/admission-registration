@extends('admin::layouts.master')   
@section('content')  
<?php if( (isset($quiz['open_or_close']) && $quiz['open_or_close'] !=2) || !isset($quiz['open_or_close']) ) : ?>
    {!! Form::model($quiz, ['method' => 'PATCH', 'route' => ['quiz.update', $quiz->id],'class'=>'steps-validation','id'=>'quiz_form','enctype'=>'multipart/form-data']) !!}     
<?php endif; ?>
    @include('admin::quiz.form', compact('quiz'))
<?php if( (isset($quiz['open_or_close']) && $quiz['open_or_close'] !=2) || !isset($quiz['open_or_close']) ) : ?>
    {!! Form::close() !!}
 <?php endif; ?>
@stop
 
             
  
