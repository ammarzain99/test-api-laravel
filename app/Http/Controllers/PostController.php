<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => Post::all(),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create($validated);
        return response()->json([
            'status' => 200,
            'data' => $post,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'status' => 404,
                'data' => [],
                'message' => 'Post not found'
            ], 404);
        }
        return response()->json([
            'status' => 200,
            'data' => $post,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'status' => 404,
                'data' => [],
                'message' => 'Post not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        $post->update($validated);
        return response()->json([
            'status' => 200,
            'data' => $post,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'status' => 404,
                'data' => [],
                'message' => 'Post not found'
            ], 404);
        }

        $post->delete();
        return response()->json([
            'status' => 200,
            'data' => [],
            'message' => 'Post deleted successfully'
        ], 200);
    }
}
