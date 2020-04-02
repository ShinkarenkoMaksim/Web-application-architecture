<?php


namespace App\Services;

use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Category;
use App\News;

class XMLParserService
{
    public function saveNews($link)
    {
        $xml = XmlParser::load($link);
        $data = $xml->parse([
            'title' => ['uses' => 'channel.title'],
            'link' => ['uses' => 'channel.link'],
            'description' => ['uses' => 'channel.description'],
            'image' => ['uses' => 'channel.image.url'],
            'news' => ['uses' => 'channel.item[title,link,guid,description,pubDate]'],
        ]);

        $img = $data['image'];

        $category = Category::firstOrCreate(['title' => $data['title']],
            [
                'url' => \Str::slug($data['title']),
            ])->id;
        if ($data['news']) {
            foreach ($data['news'] as $item) {
                $news = new News();

                $news->firstOrCreate(['title' => $item['title']],
                    [
                        'category_id' => $category,
                        'text' => $item['description'],
                        'img' => $img
                    ]);
                // Либо сохраняем циклом, но через Eloquent, либо вне цикла через DB:: и городим проверку сущестующей новости...
                // Остановлюсь пока на этом, скорость будем считать неважной в данном случае. Да и отрабатывает достаточно быстро на данном этапе.
            }
        }

        //return redirect()->route('admin.news.index')->with('success', 'Новости добавлены в БД успешно');
    }
}
