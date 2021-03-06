@extends('layouts.app')

@section('content')

  <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
    {{-- genero token --}}
    @csrf
    
    {{-- Inizio - Campo inserimento del titolo --}}
    <div class="mb-3">
      <label for="title" class="form-label">Titolo</label>
      <input type="text" class="form-control
      @error('title') 
        is-invalid 
      @enderror" 
      id="title" name="title" value="{{old('title')}}">
      @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    {{-- Fine - Campo inserimento del titolo --}}

    {{-- Inizio - Campo selezione categoria --}}
    <div class="mb-3">
      <label for="category" class="form-label">Categoria</label>
      <select name="category_id" id="category" class="form-control">
        <option value="">-- Seleziona una categoria --</option>
        @foreach ($categories as $category)
            <option value="{{$category->id}}"
            @if (old('category_id') == $category->id)
              selected
            @endif  
            >{{$category->name}}</option>
        @endforeach
      </select>
    </div>
    {{-- Fine - Campo selezione categoria --}}


    {{-- Inizio - Campo caricamento foto --}}
    <div class="mb-3">
      <label for="img" class="form-label">Immagine copertina</label>
      <input type="file" name="image" id="img" class="form-control-file
      @error('image') 
        is-invalid 
      @enderror">
      @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    {{-- Fine - Campo caricamento foto --}}


    {{-- Inizio - Campo inserimento descrizione --}}
    <div class="mb-3">
      <label for="description" class="form-label">Descrizione</label>
      <textarea class="form-control
      @error('description') 
        is-invalid 
      @enderror" 
      id="description" name="description" rows="5"> {{old('description')}}</textarea>
      @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    {{-- Fine - Campo inserimento descrizione --}}

    {{-- Inizio - Campo di selezione dei tags --}}
    <div class="mb-3">
      @foreach ($tags as $tag)
        <span class="mx-1">
          <input type="checkbox" id="{{$tag->id}}" name="tags[]" value="{{$tag->id}}"
          @if (in_array($tag->id, old('tags',[])))
            checked
          @endif>
          <label for="{{$tag->id}}">{{$tag->name}}</label>
        </span>
      @endforeach
    </div>
    {{-- Fine - Campo di selezione dei tags --}}


    <a href="{{route('admin.posts.index')}}" class="btn btn-outline-dark"><i class="fas fa-arrow-left me-2"></i> Torna indietro</a>
    <button type="submit" class="btn btn-primary">Salva</button>
  </form>

@endsection