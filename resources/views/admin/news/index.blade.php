@extends('adminlte::page')

@section('title', 'News table')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Table News</h3><br/><br/>
        <a href="{{ URL::to('admin/news/create') }}" class="btn btn-success">add news</a>
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
        <th>Name</th>
        <th>Date</th>
        <th>Content</th>
        <th>Views</th>
        <th style="text-align: center;">Action</th>
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
        <td>{{$date}}</td>
        <td>{{ substr($passport['content'],0,50)}}</td>
        <td>{{$passport['views']}}</td>
        
        <td>
          <div class="row">
            <div class="col-sm-6">
              <a href="{{ URL::to('admin/news/' . $passport->id . '/edit') }}" class="btn btn-warning" style="float: right;">Edit</a>
            </div>
            <div class="col-sm-6">
              <form action="{{ URL::to('admin/news/' . $passport->id) }}" method="post">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
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
    <script> console.log('Product!'); </script>
@stop