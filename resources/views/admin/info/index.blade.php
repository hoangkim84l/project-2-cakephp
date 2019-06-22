@extends('adminlte::page')

@section('title', 'info table')

@section('content')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Giới thiệu</h3>
    <div class="box-header-button">
      <a href="{{ URL::to('admin/info/') }}" class="btn btn-default">Danh sách</a>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="cus-data-table">
    <br />
    @if (\Session::has('success'))
    <div class="alert alert-success">
      <p>{{ \Session::get('success') }}</p>
    </div><br />
    @endif
    <table class="table table-striped col-sm-10">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tiêu đề</th>
          <th>Nội dung</th>
          <th>Ngày tạo</th>
          <th style="text-align: center;">Hành động</th>
        </tr>
      </thead>
      <tbody>

        @foreach($info as $passport)
        @php
        $old_date=date($passport['updated_at']);
        $old_date_timestamp = strtotime($old_date);
        $date = date('Y-m-d', $old_date_timestamp);
        @endphp
        <tr>
          <td>{{$passport['id']}}</td>
          <td>{{$passport['title_vn']}}</td>
          <td>{{ substr($passport['content_vn'],0,100)}}</td>
          <td>{{$date}}</td>
          <td>
            <div class="row">
              <div class="col-sm-12" style="text-align: center;">
                <a href="{{ URL::to('admin/info/' . $passport->id . '/edit') }}" class="btn btn-warning">Xem chi tiết</a>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $info->links() }}
  </div>
  <!-- /.box-body -->
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
  console.log('Product!');
</script>
@stop