@extends('layouts.app')

@section('content')

  <a href="{{route('admin.categories.create')}}" class="btn btn-secondary mb-5"> <i class="fas fa-plus me-2"></i> Crea nuova categoria</a>

  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Comandi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($categories as $category)
      <tr>
        <th scope="row">{{$category->id}}</th>
        <td>{{$category->name}}</td>
        <td>
          <a href="{{route('admin.categories.show', $category->slug)}}" class="btn btn-outline-info"><i class="far fa-clipboard"></i></a>
          <a href="{{route('admin.categories.edit', $category->id)}}" class="btn btn-outline-secondary"><i class="far fa-edit"></i></a>
          {{-- <a href="#" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></a> --}}
          <form action="{{route('admin.categories.destroy', $category->id)}}" method="POST" class="d-inline-block">
            {{-- Per ogni form bisogna inserire il token altrimenti il cambiamento non viene accettato dal sistema --}}
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Sei sicuro di voler cancellare la categoria?')"><i class="far fa-trash-alt"></i></button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>    
@endsection