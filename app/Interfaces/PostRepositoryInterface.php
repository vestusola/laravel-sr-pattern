<?php

namespace App\Interfaces;

use App\Models\Post;

interface PostRepositoryInterface
{
    public function create(array $data): ?Post;

    public function findPostByTitle(string $title): ?Post;
}