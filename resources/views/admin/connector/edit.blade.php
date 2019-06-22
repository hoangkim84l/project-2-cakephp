@extends('adminlte::page')

@section('title', 'edit connector')

@section('content')

<div class="box">
  <div class="box-header">
    <h3 class="box-title">Thông tin nhà môi giới</h3>
    <div class="box-header-button">
      <a href="{{ URL::to('admin/connector/') }}" class="btn btn-default">Danh sách</a>
    </div>
  </div>
  <div class="container content">

    <form method="post" action="{{url('admin/connector/'.$connector->id)}}" enctype="multipart/form-data" class="form-horizontal">
      @method('PATCH')
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
                <input type="text" class="form-control" name="name" value="{{$connector->name}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="image_link">Avatar:</label>
              <div class="col-sm-10">
                <img src="<?php echo asset("storage/connector/$connector->image_link") ?>" style="max-width: 400px; max-height: 400px; padding-bottom: 20px;">
                <input type="file" name="filename">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="intro_vn">Giới thiệu - Tiếng Việt:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="intro_vn" value="{{$connector->intro_vn}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="intro_en">Giới thiệu - Tiếng Anh:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="intro_en" value="{{$connector->intro_en}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="intro_cn">Giới thiệu - Tiếng Trung:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="intro_cn" value="{{$connector->intro_cn}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="phone">Số điện thoại:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="phone" value="{{$connector->phone}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Email:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" value="{{$connector->email}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="address">Địa chỉ:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="address" value="{{$connector->address}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="position">Chức vụ:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="position" value="{{$connector->position}}">
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