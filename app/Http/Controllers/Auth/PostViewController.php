<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;


class PostViewController extends Controller
{
    //Get specific post by id
    public function view(Request $request, User $user, Post $post, $id){
        $this->authorize('view', $post);
        $post = Post::findOrFail($id);

        return response()->json($post,200);
    }

    //Get all posts
    public function viewAll(Request $request, User $user, Post $post){
        $this->authorize('view', $post);
        $post = Post::all();

        return response()->json($post,200);
    }
}
