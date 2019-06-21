@extends('adminlte::page')

@section('title', 'edit support')

@section('content')
@php
$date=date('Y-m-d', $support->date);
@endphp
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Cập nhật thông tin hổ trợ</h3>
    <div class="box-header-button">
      <a href="{{ URL::to('admin/support/') }}" class="btn btn-default">Danh sách</a>
    </div>
  </div>
  <div class="container content">

    <form method="post" action="{{url('admin/support/'.$support->id)}}" enctype="multipart/form-data" class="form-horizontal">
      @method('PATCH')
      @csrf
      <ul class="nav nav-tabs">
        <li class="active"><a href="#home">Thông tin chung</a></li>
        <li><a href="#menu1">Seo On page</a></li>
      </ul>

      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <p>
            <div class="form-group">
              <label class="control-label col-sm-2" for="name">Tên:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{$support->name}}" required="true">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="gmail">Email:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="gmail" value="{{$support->gmail}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="skype">Skype:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="skype" value="{{$support->skype}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Số điện thoại:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="phone" value="{{$support->phone}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="hotline">Hot line:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="hotline" value="{{$support->hotline}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="logo">Logo:</label>
              <div class="col-sm-10">
                <img src="<?php echo asset("storage/support/$support->logo") ?>" style="max-width: 400px; max-height: 400px; padding-bottom: 20px;">
                <input type="file" name="filename">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="facebook">Facebook:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="facebook" value="{{$support->facebook}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="zalo">Zalo:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="zalo" value="{{$support->zalo}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="address">Địa chỉ:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="address" value="{{$support->address}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="chat_zalo">Chat zalo:<br />
                <a href="https://drive.google.com/file/d/1750MozMFzqtHkg0zkP5KG6ECo308mx66/view?usp=sharing" target="_blank" style="color:red;font-size: 12px;">Tài liệu hướng dẩn Chat Zalo</a>
              </label>
              <div class="col-sm-10">
                <textarea id="form10" class="md-textarea form-control" rows="5" name="chat_zalo">{{$support->chat_zalo}}</textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="chat_facebook">Chat Facebook:<br />
                <a href="https://drive.google.com/file/d/18YjdJhPfVprbr3xtcV3cWbxqMNTm22fj/view?usp=sharing" target="_blank" style="color:red;font-size: 12px;">Tài liệu hướng dẩn Chat Facebook</a>
              </label>
              <div class="col-sm-10">
                <textarea id="form10" class="md-textarea form-control" rows="5" name="chat_facebook">{{$support->chat_facebook}}</textarea>
              </div>
            </div>
          </p>
        </div>
        <div id="menu1" class="tab-pane fade">
          <p>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Tiêu đề trang:</label>
              <div class="col-sm-10">
                <textarea id="form10" class="md-textarea form-control" rows="3" name="site_title">{{$support->site_title}}</textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="meta_key">Meta Key:</label>
              <div class="col-sm-10">
                <textarea id="form10" class="md-textarea form-control" rows="3" name="meta_key">{{$support->meta_key}}</textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="meta_desc">Meta Description:</label>
              <div class="col-sm-10">
                <textarea id="form10" class="md-textarea form-control" rows="3" name="meta_desc">{{$support->meta_desc}}</textarea>
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