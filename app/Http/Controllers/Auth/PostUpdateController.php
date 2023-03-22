<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\PostUpdateRequest;
use App\Models\Post;


class PostUpdateController extends Controller
{
    public function update(PostUpdateRequest $request, Post $post, $id)
    {
        $post = Post::find($id);
        $this->authorize('update', $post);
        //Retrieve user_id from the current user
        $user_id = auth()->user()->id;
        $content = $request->validated()['content'];
        

        $post->content = $content;
        $post->save();

        return response()->json(['message' => 'Update post successfully'],200);
    }
}
