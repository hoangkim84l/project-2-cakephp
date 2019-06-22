@extends('adminlte::page')

@section('title', 'edit news')

@section('content')
@php
  $date=date('Y-m-d', $news->date);
@endphp
<div class="box">
<div class="container content">
    <h2>Edit News</h2><br/>
    <form method="post" action="{{url('admin/news/'.$news->id)}}" enctype="multipart/form-data">
      @method('PATCH')
        @csrf
      <div class="row">
        <div class="col-md-12"></div>
        <div class="form-group col-md-10">
          <label for="Name">Title:</label>
          <input type="text" class="form-control" name="name" value="{{$news->name}}">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12"></div>
          <div class="form-group col-md-10">
            <label for="content">Content:</label>
            <textarea name="content" class="form-control">{{$news->content}}</textarea>
          </div>
        </div>
      <div class="row">
        <div class="col-md-12"></div>
        <div class="form-group col-md-12">
          <img src="<?php echo asset("storage/news/$news->filename")?>" style="max-width: 400px; max-height: 400px; padding-bottom: 20px;">
          <input type="file" name="filename">    
       </div>
      </div>
      <div class="row">
        <div class="col-md-12"></div>
        <div class="form-group col-md-10">
          <strong>Date : </strong>  
          <input class="timepicker form-control"  type="date" id="timepicker" name="date" value="{{$date}}">   
       </div>
      </div>
      <div class="row">
        <div class="col-md-12"></div>
        <div class="form-group col-md-12" style="margin-top:60px">
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
    </form>
  </div
</div>
  
@stop

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@stop

@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> 
@stop