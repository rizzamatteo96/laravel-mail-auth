@extends('layouts.app')

@section('content')
  <form action="{{route('admin.categories.update', $category->id)}}" method="POST">
    {{-- imposto il token e il metodo --}}
    @csrf
    @method('PUT')

    {{-- inserisco casella per la modifica della classe --}}
    <div class="mb-3">
      <label for="name" class="form-label">Nome categoria</label>
      <input type="text" class="form-control" id="name" name="name" value="{{old('name', $category->name)}}">
    </div>

    {{-- area pulsanti --}}
    <div class="mt-4">
      <a href="{{url()->previous()}}" class="btn btn-outline-dark"><i class="fas fa-arrow-left me-2"></i> Torna indietro</a>
      <button type="submit" class="btn btn-outline-primary"><i class="far fa-save me-2"></i> Salva le modifiche</button>
    </div>
  </form>
@endsection