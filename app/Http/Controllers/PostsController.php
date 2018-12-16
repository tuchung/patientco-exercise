<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Users;
use App\Posts;
class PostsController extends Controller
{
    public function newPost(Request $request)
    {
        try{
            $new_post = new Posts;
            $new_post->message = $request->input('message');
            $new_post->user_id = session('user_id');
            $new_post->save();

            // for($i = 0; $i < 50; $i++){
            //     $new_post = new Posts;
            //     $new_post->message = $request->input('message');
            //     $new_post->user_id = session('user_id');
            //     $new_post->save();
            // }
            return response("success", 200);

        }catch(\Exception $e){
            return response($e, 500);
        }
    }

    public function getPosts(Request $request)
    {
        try{
            $postsArray = [];
            $posts = Posts::orderBy('updated_at', 'desc')->paginate(10, ['*'], 'page', $request->input('page'));
            foreach($posts as $post){
                $postsArray[] = (object) [
                    'id' => $post->id,
                    'editable' => $post->user->id == session('user_id'),
                    'user' => $post->user->name,
                    'message' => $post->message,
                    'update' => $post->updated_at
                ];
            }
            return response(\json_encode(['records' => $postsArray, 'pages' => $posts->lastPage()]));  
        }catch(\Exception $e){
            return response($e, 500);
        }
    }


    public function updatePost(Request $request)
    {
        try{
            $model = Posts::find($request->input('edit_id'));
            $model->message = $request->input('edit_message');
            $model->save();
            return response("success", 200);  
        }catch(\Exception $e){
            return response($e, 500);
        }
    }


    public function deletePost(Request $request)
    {

        try{
            $model = Posts::find($request->input('id'));
            $model->delete();
            return response("success", 200);  
        }catch(\Exception $e){
            return response($e, 500);
        }
    }

}