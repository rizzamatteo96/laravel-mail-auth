<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // richiamo i post presenti nel sito tramite il model Post per farli visualizzare come API ai guest
        $posts = Post::paginate(6);

        foreach($posts as $post){
            if($post->cover){
                $post->cover = url('storage/' . $post->cover); 
            }
        }

        // restituisco un JSON visibile anche alla route che si trova in api.php
        return response()->json([
            'success' => true,
            'results' => $posts
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // richiamo il post presente nel DB che riporta lo slug richiesto
        $post = Post::where('slug', $slug)->with(['postCategory', 'tags'])->first();

        // controllo se c'è l'immagine salvata e prepare il path per la visualizzazione in front end
        if($post->cover){
            $post->cover = url('storage/' . $post->cover); 
        }

        // restituisco un JSON visibile anche alla route che si trova in api.php
        return response()->json([
            'success' => true,
            'results' => $post
        ]);
    }

}
