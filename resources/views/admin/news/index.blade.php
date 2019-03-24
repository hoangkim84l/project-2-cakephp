@extends('adminlte::page')

@section('title', 'News table')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Table News</h3><br/><br/>
        <a href="{{ URL::to('admin/news/create') }}" class="btn btn-success">add news</a>
    </div>
    <!-- /.box-header -->
    <div class="">
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
        <th colspan="2">Action</th>
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
        
        <td><a href="{{ URL::to('admin/news/' . $passport->id . '/edit') }}" class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{ URL::to('admin/news/' . $passport->id) }}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
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