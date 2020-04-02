<?php

namespace App\Http\Controllers\Admin;


use App\Jobs\NewsParsing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Services\XMLParserService;
use App\Resource;

class ParserController extends Controller
{
    public function index()
    {
        $rssLink = Resource::all()->toArray();

        foreach ($rssLink as $link) {
            NewsParsing::dispatch($link['url']);
        }

        return redirect()->route('admin.news.index')->with('success', 'Новости добавляются в БД, подождите несколько секунд...');

    }
}
