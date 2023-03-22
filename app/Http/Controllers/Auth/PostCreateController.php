<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\PostCreateRequest;
use App\Models\Post;
use App\Models\User;
use \Illuminate\Auth\Access\AuthorizationException;
use App\Policies\PostPolicy;

class PostCreateController extends Controller
{
    public function create(PostCreateRequest $request, Post $post){
        try {
            $this->authorize('create', Post::class);
        } catch (AuthorizationException $e){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        //Retrieve user_id from the current user     
        $user_id = auth()->user()->id;
        
        
        $post->content = $request->validated()['content'];
        $post->user_id = $user_id;
        $post->save();

        return response()->json(['Post successfully'], 200);
    }
}
