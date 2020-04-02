<?php

use Illuminate\Database\Seeder;

class ResourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $rssLink = [
        ['url' => 'https://news.yandex.ru/auto.rss'],
        ['url' => 'https://news.yandex.ru/auto_racing.rss'],
        ['url' => 'https://news.yandex.ru/army.rss'],
        ['url' => 'https://news.yandex.ru/gadgets.rss'],
        ['url' => 'https://news.yandex.ru/index.rss'],
        ['url' => 'https://news.yandex.ru/martial_arts.rss'],
        ['url' => 'https://news.yandex.ru/communal.rss'],
        ['url' => 'https://news.yandex.ru/health.rss'],
        ['url' => 'https://news.yandex.ru/games.rss'],
        ['url' => 'https://news.yandex.ru/internet.rss'],
        ['url' => 'https://news.yandex.ru/cyber_sport.rss'],
        ['url' => 'https://news.yandex.ru/movies.rss'],
        ['url' => 'https://news.yandex.ru/cosmos.rss'],
        ['url' => 'https://news.yandex.ru/culture.rss'],
        ['url' => 'https://news.yandex.ru/championsleague.rss'],
        ['url' => 'https://news.yandex.ru/music.rss'],
        ['url' => 'https://news.yandex.ru/nhl.rss'],
    ];

    public function run()
    {
        DB::table('resources')->insert($this->rssLink);
    }
}
