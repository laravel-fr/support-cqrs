<?php

namespace App\Http\Controllers;

use App\CommandBus;
use Illuminate\Http\Request;
use App\Commands\CreatePostCommand;
use App\Queries\GetPostDetailsQuery;

class PostController extends Controller
{
    public function __construct(
        private CommandBus $commandBus,
    ) {}

    public function show(int $postId)
    {
        $query = new GetPostDetailsQuery($postId);

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $command = new CreatePostCommand(
            title: $request->get('title'),
            highlight: $request->get('highlight'),
            content: $request->get('content'),
        );

        $this->commandBus->handle($command);

        return response()->noContent();
    }
}
