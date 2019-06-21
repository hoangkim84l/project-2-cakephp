@extends('adminlte::page')

@section('title', 'edit storeAddress')

@section('content')
@php
$date=date('Y-m-d', $storeAddress->date);
@endphp
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Cập nhật thông tin chi nhánh</h3>
    <div class="box-header-button">
      <a href="{{ URL::to('admin/storeAddress/') }}" class="btn btn-default">Danh sách</a>
    </div>
  </div>
  <div class="container content">

    <form method="post" action="{{url('admin/storeAddress/'.$storeAddress->id)}}" enctype="multipart/form-data" class="form-horizontal">
      @method('PATCH')
      @csrf
      <ul class="nav nav-tabs">
        <li class="active"><a href="#home">Thông tin chung</a></li>
      </ul>

      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <p>
            <div class="form-group">
              <label class="control-label col-sm-2" for="phone">Số điện thoại:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="phone" value="{{$storeAddress->phone}}" required="true">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Email:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" value="{{$storeAddress->gmail}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="address">Địa chỉ:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="address" value="{{$storeAddress->address}}">
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