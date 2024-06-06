<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Comment;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::with('alumni')->orderBy('created_at','desc')->get();
        // $alumni = Alumni::whereIn('id', $stories->user_id)->get();
        $comments = Comment::all();
        return view('alumni.stories.stories', compact('stories', 'comments'));
    }

    public function createStories(Request $request)
    {
        //dd($request->all());
        $user = Auth::user();
        Story::create([
            'user_id'=> $user->id,
            'story'=> $request->story,
        ]);

        return redirect()->route('alumni.stories')->with('success', 'story uploaded!');
    }

    public function showComments($storyId)
    {
        $story = Story::findOrFail($storyId);
        $comments = Comment::where('story_id', $storyId)->get();

        return view('alumni.stories.comments', compact('story', 'comments'));
    }

    public function storeComment(Request $request, $story_id)
    {
        // Validasi request sesuai kebutuhan Anda

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->story_id = $story_id;
        $comment->comment = $request->input('comment');
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully');
    }

    public function destroy($story_id)
    {
        $story = Story::findOrFail($story_id);
        $story->delete();

        return redirect()->back()->with('success', 'Success delete story!');
    }
    public function deleteComment($story_id, $comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->delete();

        return redirect()->back()->with('success', 'Success delete comment!');
    }

}

