<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        // dd( Post::with('postCategory')->get() );

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Creo le richieste di validazione
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image'
        ]);

        // recupero i dati dal form
        $newPost = $request->all();

        // imposto lo slug dal titolo verificando che non sia già presente nella tabella essendo questo univoco
        $baseSlug = Str::slug($newPost['title'], '-');

        $newSlug = $baseSlug;
        $counter = 0;
        while(Post::where('slug', $newSlug)->first()){
            $counter++;
            $newSlug = $baseSlug . '-' . $counter;
        }

        $newPost['slug'] = $newSlug;
        
        // creo la nuova istanza per inviare i dati al DB
        $upPost = new Post();

        if(array_key_exists('image', $newPost)){
            // salvo l'immagine e ne recupero il percorso
            $cover_path = Storage::put('covers', $newPost['image']);
            // salvo il tutto nella tabella posts
            $newPost['cover'] = $cover_path;
        }

        // Invio i dati e li salvo nel DB
        $upPost->fill($newPost);
        $upPost->save();

        $upPost->tags()->attach($request->tags);

        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Creo le richieste di validazione
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image'
        ]);

        // recupero i dati dal form
        $editPost = $request->all();

        // preparo l'eventuale nuovo slug verificando che non sia già presente nella tabella essendo questo univoco
        $editSlug = Str::slug($editPost['title'], '-');
        if($editSlug != $post->slug){

            $newEditSlug = $editSlug;
            $counter = 0;
            while(Post::where('slug', $newEditSlug)->first()){
                $counter++;
                $newEditSlug = $editSlug . '-' . $counter;
            }
            $editPost['slug'] = $newEditSlug;
        }

        if(array_key_exists('image', $editPost)){
            // Se esista già una foto, elimino la vecchia immagine prima di scrivere quella nuova
            if($post->cover){
                Storage::delete($post->cover);
            }
            // salvo l'immagine e ne recupero il percorso
            $cover_path = Storage::put('covers', $editPost['image']);
            // salvo il tutto nella tabella posts
            $editPost['cover'] = $cover_path;
        }


        // carico le modifiche nel DB
        $post->update($editPost);
        $post->tags()->sync($request->tags);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::delete($post->cover);
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
