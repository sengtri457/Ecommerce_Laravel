<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\BlogTag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display blog listing.
     */
    public function index(Request $request): View
    {
        $query = BlogPost::published()->with(['category', 'author', 'comments']);

        if ($request->filled('q')) {
            $term = '%'.$request->q.'%';
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', $term)->orWhere('excerpt', 'like', $term);
            });
        }

        $posts = $query->paginate(6)->withQueryString();

        return view('blog.index', [
            'pageTitle' => 'Blog - '.setting('site_name', 'Molla'),
            'posts' => $posts,
            'currentCategory' => null,
            'currentTag' => null,
        ]);
    }

    /**
     * Filter blog by category.
     */
    public function category(string $slug): View
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        $posts = BlogPost::published()
            ->where('blog_category_id', $category->id)
            ->with(['category', 'author', 'comments'])
            ->paginate(6);

        return view('blog.index', [
            'pageTitle' => $category->name.' - Blog - '.setting('site_name', 'Molla'),
            'posts' => $posts,
            'currentCategory' => $category,
            'currentTag' => null,
        ]);
    }

    /**
     * Filter blog by tag.
     */
    public function tag(string $slug): View
    {
        $tag = BlogTag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()
            ->published()
            ->with(['category', 'author', 'comments'])
            ->paginate(6);

        return view('blog.index', [
            'pageTitle' => '#'.$tag->name.' - Blog - '.setting('site_name', 'Molla'),
            'posts' => $posts,
            'currentCategory' => null,
            'currentTag' => $tag,
        ]);
    }

    /**
     * Display blog detail post.
     */
    public function show(string $slug): View
    {
        $post = BlogPost::published()
            ->where('slug', $slug)
            ->with(['category', 'author', 'tags', 'comments.replies'])
            ->firstOrFail();

        $prevPost = BlogPost::published()->where('id', '<', $post->id)->latest('id')->first();
        $nextPost = BlogPost::published()->where('id', '>', $post->id)->oldest('id')->first();

        $relatedPosts = BlogPost::published()
            ->where('blog_category_id', $post->blog_category_id)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        return view('blog.show', [
            'pageTitle' => $post->title.' - '.setting('site_name', 'Molla'),
            'metaDescription' => $post->excerpt,
            'post' => $post,
            'prevPost' => $prevPost,
            'nextPost' => $nextPost,
            'relatedPosts' => $relatedPosts,
        ]);
    }

    /**
     * Submit blog comment.
     */
    public function comment(Request $request, string $slug): RedirectResponse
    {
        $post = BlogPost::published()->where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'body' => 'required|string|min:3|max:1000',
            'parent_id' => 'nullable|exists:blog_comments,id',
        ]);

        BlogComment::create([
            'blog_post_id' => $post->id,
            'parent_id' => $validated['parent_id'] ?? null,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'body' => $validated['body'],
            'is_approved' => true,
        ]);

        return back()->with('success', 'Thank you! Your comment has been posted.');
    }
}
