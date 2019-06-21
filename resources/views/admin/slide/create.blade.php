@extends('adminlte::page')

@section('title', 'edit slide')

@section('content')

<div class="box">
  <div class="box-header">
    <h3 class="box-title">Thông tin slider</h3>
    <div class="box-header-button">
      <a href="{{ URL::to('admin/slide/') }}" class="btn btn-default">Danh sách</a>
    </div>
  </div>
  <div class="container content">

    <form method="post" action="{{url('admin/slide')}}" enctype="multipart/form-data" class="form-horizontal">
      @method('POST')
      @csrf
      <ul class="nav nav-tabs">
        <li class="active"><a href="#home">Thông tin chung</a></li>
      </ul>

      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <p>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Tên:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="" required="true">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="image_link">Image:</label>
              <div class="col-sm-10">
                <input type="file" name="filename">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="link">Link:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="link" value="">
              </div>
            </div>

          </p>
        </div>
        <div class="row">
          <div class="col-md-12"></div>
          <div class="form-group col-md-12" style="margin-top: 60px; text-align: right;">
            <button type="submit" class="btn btn-success">Lưu</button>
          </div>
        </div>
      </div>

    </form>
  </div> @stop @section('css')
  <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
  <link rel="stylesheet" href="/css/admin_custom.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  @stop

  @section('js')
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".nav-tabs a").click(function() {
        $(this).tab('show');
      });
    });
  </script>
  @stop