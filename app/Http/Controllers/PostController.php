<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (!$user) {
            // For non-authenticated users, show the redesigned welcome page
            // We'll fetch data for the welcome page here
            $featuredPosts = Post::with(['user', 'category'])
                ->where('published_at', '<=', now())
                ->withCount('claps')
                ->orderBy('claps_count', 'desc')
                ->take(5)
                ->get();

            $staffPicks = Post::with('user')
                ->where('published_at', '<=', now())
                ->inRandomOrder()
                ->take(3)
                ->get();

            $categories = Category::all();

            return view('welcome', [
                'featuredPosts' => $featuredPosts,
                'staffPicks' => $staffPicks,
                'categories' => $categories
            ]);
        }

        // For authenticated users, show their feed
        // Get posts from followed users
        $followedUserIds = $user->following()->pluck('users.id');

        // Include the current user's ID to see their own posts
        $userIds = $followedUserIds->push($user->id);

        $posts = Post::with(['user', 'category'])
            ->where('published_at', '<=', now())
            ->withCount('claps')
            ->whereIn('user_id', $userIds)
            ->latest()
            ->paginate(10);

        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return view('post.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        // Set a default published_at date if not provided
        if (!isset($data['published_at']) || empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        // Handle image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $data['image'] = $imagePath;
        } else {
            $data['image'] = null;
        }

        $post = Post::create($data);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        return view('post.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        $categories = Category::get();
        return view('post.edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Delete old image if exists
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $imagePath = $request->file('image')->store('posts', 'public');
            $data['image'] = $imagePath;
        }

        $post->update($data);

        return redirect()->route('myPosts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        $post->delete();

        return redirect()->route('dashboard');
    }

    public function category(Category $category)
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (!$user) {
            // For non-authenticated users, show the welcome page
            return view('welcome');
        }

        // Get posts from followed users only, filtered by category
        $followedUserIds = $user->following()->pluck('users.id');

        // Include the current user's ID to see their own posts
        $userIds = $followedUserIds->push($user->id);

        $posts = $category->posts()
            ->where('published_at', '<=', now())
            ->with(['user'])
            ->withCount('claps')
            ->whereIn('user_id', $userIds)
            ->latest()
            ->simplePaginate(5);

        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    public function myPosts()
    {
        /** @var User $user */
        $user = Auth::user();
        $posts = $user->posts()
            ->with(['user'])
            ->withCount('claps')
            ->latest()
            ->simplePaginate(5);

        return view('post.index', [
            'posts' => $posts,
        ]);
    }
}
