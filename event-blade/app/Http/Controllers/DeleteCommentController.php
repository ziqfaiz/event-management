<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class DeleteCommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id, Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return back();
    }
}
