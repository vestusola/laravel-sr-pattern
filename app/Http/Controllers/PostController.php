<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Support\Facades\{
    Validator
};

class PostController extends Controller
{

    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = $this->postService->getAll();

        return response()->json(['status' => 200, 'data' => $posts], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Validation rules
            $rules = [
                'title'         => 'required|string|max:191',
                'description'   => 'required|string'
            ];

            // Validate rules
            $validation = Validator::make($request->all(), $rules);
            if ($validation->fails()) return response()->json(['status' => 422, 'errors' => $validation->errors()], 422);

            // Request form data
            $title = $request->title;
            $description = $request->description;

            // Check if post title exists for user
            $postExists = $this->postService->existsForUser($title);
            if ($postExists) return response()->json(['status' => 400, 'message' => 'Post already exists!'], 400);

            $post = $this->postService->store([
                'title'         => $title,
                'description'   => $description,
                'user_id'       => $request->user()->id
            ]);

            return response()->json(['status' => 201, 'data' => $post, 'message' => 'Post was successfully added!'], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Sorry, an error occurred!', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $post = $this->postService->postById($id);

        return response()->json(['status' => 200, 'data' => $post], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        return $this->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            // Validation rules
            $rules = [
                'title'         => 'required|string|max:191',
                'description'   => 'required|string'
            ];

            // Validate rules
            $validation = Validator::make($request->all(), $rules);
            if ($validation->fails()) return response()->json(['status' => 422, 'errors' => $validation->errors()], 422);

            // Request form data
            $title = $request->title;
            $description = $request->description;

            // Check if post title exists for user
            $postExists = $this->postService->existsForUser($title);
            if ($postExists && $postExists->id != $id) return response()->json(['status' => 400, 'message' => 'Post already exists!'], 400);

            $post = $this->postService->update($id, [
                'title'         => $title,
                'description'   => $description
            ]);

            return response()->json(['status' => 202, 'message' => 'Post was successfully updated!'], 202);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Sorry, an error occurred!'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($post)
    {
        try {
            // Delete post
            $this->postService->destroy($post);

            return response()->json(['status' => 200, 'message' => 'Post was successfully deleted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Sorry, an error occurred!'], 500);
        }
    }
}
