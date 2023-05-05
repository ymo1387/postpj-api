<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PostResource::collection(auth()->user()->posts()->orderBy('id', 'desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required', 'exists:post_types,id'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required']
        ]);

        $post = auth()->user()->posts()->create([
            'post_type_id' => $request->type,
            'title' => $request->title
        ]);

        $post->text()->create(['body' => $request->body]);

        return PostResource::make($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return PostResource::make($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'type' => ['exists:post_types,id'],
            'title' => ['string', 'max:255'],
        ]);

        if ($request->has('type')) {
            $post->update(['post_type_id' => $request->type]);
        }

        if ($request->has('title')) {
            $post->update(['title' => $request->title]);
        }

        if ($request->has('body')) {
            $post->text()->update(['body' => $request->body]);
        }

        return PostResource::make($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->forceDelete();

        return response()->noContent();
    }
}
