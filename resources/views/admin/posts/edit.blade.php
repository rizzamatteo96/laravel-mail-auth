@extends('layouts.app')

@section('content')
  <form action="{{route('admin.posts.update', $post->id)}}" method="POST">
    {{-- genero token --}}
    @csrf

    {{-- imposto il metodo per il form --}}
    @method('PUT')
    
    {{-- Inizio - Campo inserimento del titolo --}}
    <div class="mb-3">
      <label for="title" class="form-label">Titolo</label>
      <input type="text" class="form-control
      @error('title') 
        is-invalid 
      @enderror" id="title" name="title" value="{{old('title', $post->title)}}">
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
              @if (old('category_id', $post->category_id) == $category->id)
                selected
              @endif>{{$category->name}}</option>
        @endforeach
      </select>
    </div>
    {{-- Fine - Campo selezione categoria --}}

    {{-- Inizio - Campo inserimento descrizione --}}
    <div class="mb-3">
      <label for="description" class="form-label">Descrizione</label>
      <textarea type="password" class="form-control
      @error('description') 
        is-invalid 
      @enderror" id="description" name="description" rows="5">{{old('description', $post->description)}}</textarea>
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
          @if(!$errors->any() && $post->tags->contains($tag->id))
            checked
          @elseif (in_array($tag->id, old('tags',[])))
            checked
          @endif>
          <label for="{{$tag->id}}">{{$tag->name}}</label>
        </span>
      @endforeach
    </div>
    {{-- Fine - Campo di selezione dei tags --}}

    <div class="mt-4">
      <a href="{{route('admin.posts.index')}}" class="btn btn-outline-dark"><i class="fas fa-arrow-left me-2"></i> Torna indietro</a>
      <button type="submit" class="btn btn-outline-primary"><i class="far fa-save me-2"></i> Salva le modifiche</button>
    </div>
  </form>
@endsection