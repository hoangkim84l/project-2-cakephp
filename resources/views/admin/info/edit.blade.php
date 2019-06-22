@extends('adminlte::page')

@section('title', 'edit info')

@section('content')
@php
$date=date('Y-m-d', $info->date);
@endphp
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Cập nhật thông tin giới thiệu</h3>
    <div class="box-header-button">
      <a href="{{ URL::to('admin/info/') }}" class="btn btn-default">Danh sách</a>
    </div>
  </div>
  <div class="container content">

    <form method="post" action="{{url('admin/info/'.$info->id)}}" enctype="multipart/form-data" class="form-horizontal">
      @method('PATCH')
      @csrf
      <ul class="nav nav-tabs">
        <li class="active"><a href="#home">Thông tin chung</a></li>
        <li><a href="#menu1">Seo On page</a></li>
        <li><a href="#menu2">Nội dung</a></li>
      </ul>

      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <p>
            <div class="form-group">
              <label class="control-label col-sm-2" for="title_vn">Tiêu đề (tiếng việt):</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="title_vn" value="{{$info->title_vn}}" require="true">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="title_en">Tiêu đề (tiếng anh):</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="title_en" value="{{$info->title_en}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="title_cn">Tiêu đề (tiếng trung):</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="title_cn" value="{{$info->title_cn}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="image_list">Ảnh</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" multiple="true" name="image_list[]">
              </div>
            </div>
          </p>
        </div>
        <div id="menu1" class="tab-pane fade">
          <p>
            <div class="form-group">
              <label class="control-label col-sm-2" for="meta_key">Meta Key:</label>
              <div class="col-sm-10">
                <textarea id="form10" class="md-textarea form-control" rows="3" name="meta_key">{{$info->meta_key}}</textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="meta_desc">Meta Description:</label>
              <div class="col-sm-10">
                <textarea id="form10" class="md-textarea form-control" rows="3" name="meta_desc">{{$info->meta_desc}}</textarea>
              </div>
            </div>
          </p>
        </div>
        <div id="menu2" class="tab-pane fade">
          <p>
            <div class="form-group">
              <label class="control-label col-sm-2" for="content_vn">Nội dung (tiếng việt):</label>
              <div class="col-sm-10">
                <textarea id="form10" class="md-textarea form-control" rows="3" name="content_vn">{{$info->content_vn}}</textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="content_en">Nội dung (tiếng anh):</label>
              <div class="col-sm-10">
                <textarea id="form10" class="md-textarea form-control" rows="3" name="content_en">{{$info->content_en}}</textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="content_cn">Nội dung (tiếng trung):</label>
              <div class="col-sm-10">
                <textarea id="form10" class="md-textarea form-control" rows="3" name="content_cn">{{$info->content_cn}}</textarea>
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