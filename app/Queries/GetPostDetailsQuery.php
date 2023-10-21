<?php

namespace App\Queries;

use App\Models\Post;

class GetPostDetailsQuery
{
    public function __construct(
        private int $postId,
    ) {}

    public function get(): array
    {
        $post = Post::query()
            ->select('title', 'highlight', 'content')
            ->findOrFail($this->postId);

        return $post->toArray();
    }
}
