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

        // restituisco un JSON visibile anche alla route che si trova in api.php
        return response()->json([
            'success' => true,
            'results' => $post
        ]);
    }

}
