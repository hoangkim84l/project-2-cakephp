@extends('adminlte::page')
@section('title', 'create news')
@section('content')
<div class="box">
<div class="container content">
    <h2>Create News</h2><br/>
    <form method="post" action="{{url('admin/news')}}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-md-10"></div>
        <div class="form-group col-md-10 col-sm-10">
          <label for="Name">Title:</label>
          <input type="text" class="form-control" name="name">
          @if ($errors->has('name'))
              <span class="text-danger">{{ $errors->first('name') }}</span>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-md-10"></div>
          <div class="form-group col-md-10  col-sm-10">
            <label for="Email">content:</label>
            <textarea name="content" class="form-control"></textarea>
            @if ($errors->has('content'))
                <span class="text-danger">{{ $errors->first('content') }}</span>
            @endif
          </div>
        </div>
      <div class="row">
        <div class="col-md-10"></div>
        <div class="form-group col-md-12  col-sm-10">
          <input type="file" name="filename">    
       </div>
      </div>
      <div class="row">
        <div class="col-md-10"></div>
        <div class="form-group col-md-10  col-sm-10">
          <strong>Date : </strong>  
          <input class="timepicker form-control"  type="date" id="timepicker" name="date">   
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