<?php

namespace App\Interfaces;

use App\Models\Post;
use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
    public function findById(int $id): ?Post;

    public function findByTitle(string $title): ?Post;

    public function getAll(): Collection;

    public function store(array $data): ?Post;

    public function update(int $id, array $data);

    public function delete(int $id);
}