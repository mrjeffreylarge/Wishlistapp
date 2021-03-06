<!-- home.blade.php -->

@extends('layouts.app')
@section('content')
  <div class="container">
    <p>
      <a class="btn btn-primary" href="{{action('WishlistItemController@create')}}">New Item</a>
    </p>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Link</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($wishlistItems as $item)
      <tr>
        <td>
          {{$item['title']}}
        </td>
        <td>{{$item['description']}}</td>
        <td>
          @if ($item['link'])
          <a class="btn btn-default" href="{{$item['link']}}" target="_BLANK">Link</a>
          @endif
        </td>
        <td><a href="{{action('WishlistItemController@edit', $item['id'])}}" class="btn btn-warning">Edit</a></td>
        {{-- <td><a href="{{action('WishlistItemController@destroy', $item['id'])}}" class="btn btn-danger">Delete</a></td> --}}
        <td>
          <form action="{{action('WishlistItemController@destroy', $item['id'])}}" method="post">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
@endsection
