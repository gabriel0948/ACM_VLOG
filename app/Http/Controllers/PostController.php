<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = DB::table('vlog_post')->get();
            return view('uploads', compact('posts'));
        } catch (QueryException $e) {
            // Log or handle the exception
            return response()->view('errors.500', [], 500);
        }
    }

    public function store(Request $request)
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
