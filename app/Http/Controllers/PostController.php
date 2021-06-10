<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Http\Requests\PostIndexRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Carbon\Carbon;
use App\Models\Post\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(PostIndexRequest $request)
    {
        $posts = Post::when($request->q, function ($query) use ($request) {
            return $query->where('title', 'LIKE', '%' . $request->q . '%');
        })->when($request->order, function ($query) use ($request) {
            return $query->orderBy($request->get('orderby'), $request->get('order'));
        }, function ($query) {
            return $query->orderBy('created_at', 'DESC');
        })->get();

        // if ($request->has('q')) {
        //     $posts = Post::where('title', 'LIKE', '%' . $request->get('q') . '%');
        // } else {
        //     $posts = Post::query();
        // }

        // if ($request->has('order')) {
        //     $posts = $posts->orderBy($request->get('orderby'), $request->get('order'));
        // } else {
        //     $posts = $posts->orderBy('created_at', 'DESC');
        // }

        // $posts = $posts->get();

        return view('posts/index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = PostStatus::asSelectArray();
        return view('posts/new', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        // $title = $request->get('title');

        // if (empty($title)) {
        //     return redirect()->back()->withErrors([
        //         'title' => ['Title must not be empty'],
        //     ]);
        // }

        // $content = $request->get('content');

        // if (empty($content)) {
        //     return redirect()->back()->withErrors([
        //         'content' => ['Content must not be empty'],
        //     ]);
        // }

        // if ($request->get('published_at')) {
        //     $publishDate = Carbon::parse($request->get('published_at'));
        // } else {
        //     $publishDate = null;
        // }

        // $status = $request->get('status');

        // if (!empty($publishDate)) {
        //     if ($status === 'planned') {
        //         if ($publishDate < Carbon::now()) {
        //             return redirect()->back()->withErrors([
        //                 'published_at' => ['The publishing date must be in the future'],
        //             ]);
        //         }
        //     } elseif ($status === 'published') {
        //         if ($publishDate > Carbon::now()) {
        //             return redirect()->back()->withErrors([
        //                 'published_at' => ['A new post cannot be published in the past'],
        //             ]);
        //         }
        //     } else {
        //         $publishDate = null;
        //     }
        // } else {
        //     if ($status === 'planned') {
        //         return redirect()->back()->withErrors([
        //             'published_at' => ['A planned post must have a publishing date'],
        //         ]);
        //     } elseif ($status === 'published') {
        //         $publishDate = Carbon::now();
        //     }
        // }

        // if ($status === 'draft') {
        //     $publishDate = null;
        // }

        // if ($request->get('slug')) {
        //     $slug = $request->get('slug');
        // } else {
        //     $slug = '';
        // }

        // $post = new Post();
        // $post->title = $title;
        // $post->slug = $slug;
        // $post->status = $status;
        // $post->content = $content;
        // $post->published_at = $publishDate;

        // $post->save();

        // @session_start();
        // $_SESSION['post_message'] = 'Post succesfully created';
        // dd($request->validated());

        $validated = $request->validated();

        if (!empty($validated['published_at']) && $validated['status'] === PostStatus::PUBLISHED) {
            return redirect()->back()->withErrors([
                'published_at' => ['A new post cannot be published in the future'],
            ]);
        }

        if (empty($validated['published_at']) && $validated['status'] === PostStatus::PUBLISHED) {
            $validated['published_at'] = now();
        }

        $post = Post::create($validated);

        return redirect()->route('posts.edit', $post)->with('post_message', 'Post succesfully created');
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Post\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // if ($post->status === 'draft') {
        //     abort(404);
        // } elseif ($post->status === 'planned') {
        //     if (!$post->published_at) {
        //         abort(404);
        //     } elseif ($post->published_at > Carbon::now()) {
        //         abort(404);
        //     }
        // }

        return view('posts.view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Post\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $statuses = PostStatus::asSelectArray();
        return view('posts/edit', compact('post', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        // $title = $request->get('title');

        // if (empty($title)) {
        //     return redirect()->back()->withErrors([
        //         'title' => ['Title must not be empty'],
        //     ]);
        // }

        // $content = $request->get('content');

        // if (empty($content)) {
        //     return redirect()->back()->withErrors([
        //         'content' => ['Content must not be empty'],
        //     ]);
        // }

        // if ($request->get('published_at')) {
        //     $publishDate = Carbon::parse($request->get('published_at'));
        // } else {
        //     $publishDate = null;
        // }

        // $status = $request->get('status');

        // if (!empty($publishDate)) {
        //     if ($post->published_at && $publishDate->equalTo($post->published_at)) {
        //         // If the given publishDate is equal to the current stored published_at
        //         if ($status === 'planned' && $publishDate < Carbon::now()) {
        //             // Update post to published if the published_at date has passed
        //             $status = 'published';
        //         } elseif ($status === 'draft') {
        //             // Remove published_at date if the post is updated to draft
        //             $publishDate = null;
        //         }
        //     } else {
        //         if ($status === 'planned') {
        //             if ($publishDate < Carbon::now()) {
        //                 return redirect()->back()->withErrors([
        //                     'published_at' => ['The publishing date must be in the future'],
        //                 ]);
        //             }
        //         } elseif ($status === 'published') {
        //             if ($publishDate > Carbon::now()) {
        //                 return redirect()->back()->withErrors([
        //                     'published_at' => ['A post cannot be published in the past'],
        //                 ]);
        //             }
        //         } else {
        //             $publishDate = null;
        //         }
        //     }
        // } else {
        //     if ($status === 'planned') {
        //         return redirect()->back()->withErrors([
        //             'published_at' => ['A planned post must have a publishing date'],
        //         ]);
        //     } elseif ($status === 'published') {
        //         $publishDate = Carbon::now();
        //     }
        // }

        // if ($status === 'draft') {
        //     $publishDate = null;
        // }

        // if ($request->get('slug')) {
        //     $slug = $request->get('slug');
        // } else {
        //     $slug = '';
        // }

        // $post->title = $title;
        // $post->slug = $slug;
        // $post->status = $status;
        // $post->content = $content;
        // $post->published_at = $publishDate;

        // $post->save();

        // @session_start();
        // $_SESSION['post_message'] = 'Post succesfully updated';
        $validated = $request->validated();

        if (!empty($validated['published_at']) && $validated['status'] === PostStatus::PUBLISHED) {
            return redirect()->back()->withErrors([
                'published_at' => ['A new post cannot be published in the future'],
            ]);
        }

        if (empty($validated['published_at']) && $validated['status'] === PostStatus::PUBLISHED) {
            $validated['published_at'] = now();
        }

        tap($post)->update($validated);

        return redirect()->route('posts.edit', $post)->with('post_message', 'Post succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Post\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (!$post->trashed()) {
            $post->delete();
        }

        @session_start();
        $_SESSION['post_message'] = 'Post "' . $post->title . '" has been deleted.';

        return redirect()->route('posts.index');
    }
}
