<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Policies\PostPolicy;


class PostDeleteController extends Controller
{
    public function delete(Request $request, Post $post, $id){
            $this->authorize('delete', $post);

            $post = Post::findOrFail($id);
            $post->delete();
            $success['success'] = true;
            $success['message'] = 'Delete this post successfully';
            
            return response()->json($success,200);
        
    }
}
