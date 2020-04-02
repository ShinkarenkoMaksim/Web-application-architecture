<?php

namespace App\Http\Controllers;

use App\Category;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function news()
    {
        $news = News::query()
            ->paginate(6);

        return view('news.all', ['news' => $news]);
    }


    public function categories()
    {
        $categories = Category::query()->get();

        return view('news.category', ['categories' => $categories]);
    }


    public function newsOne(News $news)
    {
        return view('news.one', ['news' => $news]);

    }

    public function categoryId($url)
    {
        $categories = Category::query()->select(['id', 'title'])->where('url', $url)->get();
        if (!empty($categories[0])) {
            $category = $categories[0]->title;
            $news = Category::query()->find($categories[0]->id)->news()->paginate(6);
            return view('news.oneCategory', ['news' => $news, 'category' => $category]);
        } else
            return redirect(route('news.categories'));
    }
}


