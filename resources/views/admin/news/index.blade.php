@extends('adminlte::page')

@section('title', 'News table')

@section('content')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Danh sách bản tin</h3>
    <div class="box-header-button">
      <a href="{{ URL::to('admin/categoty_news') }}" class="btn btn-success">Loại tin</a>
      <a href="{{ URL::to('admin/news/create') }}" class="btn btn-success">Thêm mới</a>
      <a href="{{ URL::to('admin/news/') }}" class="btn btn-default">Danh sách</a>
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
          <th>Lượt Xem</th>
          <th>Ngày tạo</th>
          <th style="text-align: center;">Hành động</th>
        </tr>
      </thead>
      <tbody>

        @foreach($news as $passport)
        @php
        $date=date('Y-m-d', $passport['date']);
        @endphp
        <tr>
          <td>{{$passport['id']}}</td>
          <td>{{$passport['name']}}</td>
          <td>{{ substr($passport['content'],0,50)}}</td>
          <td>{{$passport['views']}}</td>
          <td>{{$date}}</td>
          <td>
            <div class="row">
              <div class="col-sm-6">
                <a href="{{ URL::to('admin/news/' . $passport->id . '/edit') }}" class="btn btn-warning" style="float: right;">Sửa</a>
              </div>
              <div class="col-sm-6">
                <form action="{{ URL::to('admin/news/' . $passport->id) }}" method="post">
                  @csrf
                  <input name="_method" type="hidden" value="DELETE">
                  <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Xóa</button>
                </form>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $news->links() }}
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