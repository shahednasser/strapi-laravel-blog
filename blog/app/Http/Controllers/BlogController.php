<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function home () {
        //retrieve the posts from Strapi
        $response = Http::withToken(env('STRAPI_API_TOKEN'))->get(env('STRAPI_URL') . '/api/posts?populate=image,tags');
        $posts = [];

        if ($response->failed()) {
            if (isset($data['error'])) {
                Log::error('Server error: ' . $data['error']['message']);
            } else {
                Log::error('Request Failed');
            }
        } else {
            //get posts from response
            $posts = $response->json('data');
        }

        // dump($posts); exit;

        return view('home', ['posts' => $posts]);
    }

    public function viewPost ($id) {
        //retrieve the post from Strapi
        $response = Http::withToken(env('STRAPI_API_TOKEN'))->get(env('STRAPI_URL') . '/api/posts/' . $id . '?populate=image,tags,comments');

        if ($response->failed()) {
            if (isset($data['error'])) {
                Log::error('Server error: ' . $data['error']['message']);
            } else {
                Log::error('Request Failed');
            }

            return response()->redirectTo('/');
        }

        //get post from response
        $post = $response->json('data');

        // dump($post); exit;

        return view('post', ['post' => $post]);
    }

    public function addComment (Request $request, $id) {
        $data = [
            "data" => [
                'email' => $request->get('email'),
                'content' => $request->get('content'),
                'post' => $id
            ]
        ];

        $response = Http::withToken(env('STRAPI_API_TOKEN'))->post(env('STRAPI_URL') . '/api/comments', $data);

        if ($response->failed()) {
            if (isset($data['error'])) {
                Log::error('Server error: ' . $data['error']['message']);
            } else {
                Log::error('Request Failed');
            }

            return response()->redirectTo('/');
        }

        //successfully added
        return response()->redirectTo('/post/' . $id);
    }
}
