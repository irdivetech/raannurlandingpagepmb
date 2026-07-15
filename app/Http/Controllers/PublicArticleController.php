<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleImage;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('category')->where('status', 'published');

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $articles = $query->latest('published_at')->paginate(9)->withQueryString();
        $categories = Category::withCount(['articles' => function($q) {
            $q->where('status', 'published');
        }])->get();

        return view('public.articles.index', compact('articles', 'categories'));
    }

    public function show($slug)
    {
        $article = Article::with(['category', 'author', 'images'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Increment view counter
        $article->increment('views');

        // Get recent articles for sidebar
        $recentArticles = Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        // Get popular articles for sidebar
        $popularArticles = Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        // Get related articles
        $relatedArticles = Article::where('status', 'published')
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        $categories = Category::withCount(['articles' => function($q) {
            $q->where('status', 'published');
        }])->get();

        return view('public.articles.show', compact('article', 'recentArticles', 'popularArticles', 'relatedArticles', 'categories'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $articles = Article::with('category')
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);
            
        $categories = Category::withCount(['articles' => function($q) {
            $q->where('status', 'published');
        }])->get();

        return view('public.articles.index', compact('articles', 'categories', 'category'));
    }

    public function gallery(Request $request)
    {
        // Get all article images that belong to published articles
        $images = ArticleImage::whereHas('article', function($q) {
            $q->where('status', 'published');
        })->latest()->paginate(16);

        return view('public.gallery.index', compact('images'));
    }
}
