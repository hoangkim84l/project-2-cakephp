@extends('adminlte::page')

@section('title', 'support table')

@section('content')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Thông tin hổ trợ</h3>
    <div class="box-header-button">
      <a href="{{ URL::to('admin/support/') }}" class="btn btn-default">Danh sách</a>
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
          <th>Tên</th>
          <th>Email</th>
          <th>Điện thoại</th>
          <th>Cập nhật</th>
          <th style="text-align: center;">Hành động</th>
        </tr>
      </thead>
      <tbody>

        @foreach($support as $passport)
        @php
        $old_date=date($passport['updated_at']);
        $old_date_timestamp = strtotime($old_date);
        $date = date('Y-m-d', $old_date_timestamp);
        @endphp
        <tr>
          <td>{{$passport['id']}}</td>
          <td>{{$passport['name']}}</td>
          <td>{{$passport['gmail']}}</td>
          <td>{{$passport['phone']}}</td>
          <td>{{$date}}</td>
          <td>
            <div class="row">
              <div class="col-sm-12" style="text-align: center;">
                <a href="{{ URL::to('admin/support/' . $passport->id . '/edit') }}" class="btn btn-warning">Xem chi tiết</a>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $support->links() }}
  </div>
  <!-- /.box-body -->
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
  console.log('support!');
</script>
@stop