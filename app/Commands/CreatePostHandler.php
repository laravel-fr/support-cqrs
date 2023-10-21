<?php

namespace App\Commands;

use App\Models\Post;
use App\Commands\CreatePostCommand;

class CreatePostHandler
{
    public function __invoke(CreatePostCommand $command): void
    {
        Post::create([
            'title' => $command->title,
            'highlight' => $command->highlight,
            'content' => $command->content,
        ]);
    }
}
