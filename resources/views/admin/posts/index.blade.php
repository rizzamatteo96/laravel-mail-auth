@extends('layouts.app')

@section('content')

  <a href="{{route('admin.posts.create')}}" class="btn btn-secondary mb-5"> <i class="fas fa-plus me-2"></i> Crea nuovo post</a>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Titolo</th>
        <th scope="col">Categoria</th>
        <th scope="col">Azioni</th>
      </tr>
    </thead>
    <tbody>

      {{-- ciclo tutti gli elementi presenti ne DB --}}
      @foreach ($posts as $post)
        <tr>
          <th scope="row">{{$post->id}}</th>
          <td>{{$post->title}}</td>
          <td>
            {{-- @if ($post->category)
              {{$post->category->name}}
            @else
              {{'nessuna categoria'}}
            @endif --}}

            
            @if ($post->postCategory)
              {{$post->postCategory->name}}
            @endif
          </td>
          <td>
            <a href="{{route('admin.posts.show', $post->slug)}}" class="btn btn-outline-info px-3"><i class="fas fa-info"></i></a>
            <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-outline-secondary"><i class="far fa-edit"></i></a>
            <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST" class="d-inline-block">
              {{-- Per ogni form bisogna inserire il token altrimenti il cambiamento non viene accettato dal sistema --}}
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Sei sicuro di voler cancellare l\'elemento?')"><i class="far fa-trash-alt"></i></button>
            </form>
          </td>
        </tr>
      @endforeach

    </tbody>
  </table>
@endsection