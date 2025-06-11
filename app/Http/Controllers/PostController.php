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

    public function index()
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (!$user) {

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

        $followedUserIds = $user->following()->pluck('users.id');

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


    public function create()
    {
        $categories = Category::get();

        return view('post.create', [
            'categories' => $categories,
        ]);
    }


    public function store(PostCreateRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        if (!isset($data['published_at']) || empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $data['image'] = $imagePath;
        } else {
            $data['image'] = null;
        }

        $post = Post::create($data);

        return redirect()->route('dashboard');
    }


    public function show(string $username, Post $post)
    {
        return view('post.show', [
            'post' => $post,
        ]);
    }


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


    public function update(PostUpdateRequest $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        $data = $request->validated();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $imagePath = $request->file('image')->store('posts', 'public');
            $data['image'] = $imagePath;
        }

        $post->update($data);

        return redirect()->route('myPosts');
    }


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
            return view('welcome');
        }

        $followedUserIds = $user->following()->pluck('users.id');

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

    public function search(Request $request)
    {
        $query = $request->input('q');

        if (empty($query)) {
            return redirect()->route('dashboard');
        }

        $posts = Post::with(['user', 'category'])
            ->where('published_at', '<=', now())
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            })
            ->withCount('claps')
            ->latest()
            ->paginate(10);

        return view('post.index', [
            'posts' => $posts,
            'searchQuery' => $query
        ]);
    }
}
