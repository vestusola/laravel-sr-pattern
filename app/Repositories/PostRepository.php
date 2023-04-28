<?php

namespace App\Repositories;

use App\Models\Post;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Collection;

class PostRepository implements PostRepositoryInterface
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll(): Collection
    {
        return $this->post->where('user_id', auth()->user()->id)->get();
    }

    /**
     * Find post by id
     */
    public function findById(int $id): ?Post
    {
        return $this->post->where('user_id', auth()->user()->id)->find($id);
    }

    /*
     * Find post by title
     */
    public function findByTitle(string $title): ?Post
    {
        return $this->post->where('user_id', auth()->user()->id)->where('title', $title)->first();
    }

    /**
     * Store post
     */
    public function store($data): ?Post
    {
        return $this->post->create($data);
    }

    /**
     * Update post
     */
    public function update(int $id, array $data)
    {
        $post = $this->findById($id);
        if ($post) return $post->update($data);

        throw new \Exception("Requested resources could not be found!");
    }

    /**
     * Delete post
     */
    public function delete(int $id)
    {
        $post = $this->findById($id);
        if ($post) return $post->delete();

        throw new \Exception("Requested resources could not be found!");
    }
}
