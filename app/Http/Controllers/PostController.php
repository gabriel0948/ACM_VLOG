<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = DB::table('vlog_post')->get();
        return view('posts.index')->with('posts', $posts);
    }

    public function StoredPost(Request $request)
    {


        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $imagePath = $request->file('image')->store('public/images');


        DB::table('vlog_post')->insert([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'content' => $imagePath,
            'created_at' => now(),
        ]);

        // Return a response
        return response()->json(['success' => true, 'message' => 'Post created successfully']);
    }
}
