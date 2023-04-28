<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Models\Post;
use Illuminate\Support\Collection;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Fetch all authenticated user posts
     */
    public function getAll(): Collection
    {
        return $this->postRepository->getAll();
    }

    /**
     * Find post by Id
     */
    public function postById(int $id): ?Post
    {
        return $this->postRepository->findById($id);
    }

    /**
     * Post exists for user
     */
    public function existsForUser(string $title): ?Post
    {
        return $this->postRepository->findByTitle($title);
    }

    /**
     * Authenticated user add new post
     */
    public function store(array $data): ?Post
    {
        return $this->postRepository->store($data);
    }

    /**
     * Authenticated user update post
     */
    public function update(int $id, array $data)
    {
        return $this->postRepository->update($id, $data);
    }

    /**
     * Authenticated user delete post
     */
    public function destroy(int $id)
    {
        return $this->postRepository->delete($id);
    }
}
