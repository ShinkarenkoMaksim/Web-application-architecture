<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FormTest extends DuskTestCase
{
    use RefreshDatabase;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testTitleError()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://laravel/admin/create') //При указани "/admin/create" не проходят тесты. С чем связано - непонятно, как отладить тоже неясно
                ->type('title', 'Мало')
                ->press('Добавить')
                ->assertSee('Количество символов в поле Заголовок новости должно быть не менее 5.')
                ->assertPathIs('/admin/create');
        });
    }

    public function testTextError()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://laravel/admin/create') //При указани "/admin/create" не проходят тесты. С чем связано - непонятно, как отладить тоже неясно
                ->type('title', 'Достаточно')
                ->type('text', '')
                ->press('Добавить')
                ->assertSee('Поле Текст новости обязательно для заполнения.')
                ->assertPathIs('/admin/create');
        });
    }

    public function testSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://laravel/admin/create') //При указани "/admin/create" не проходят тесты. С чем связано - непонятно, как отладить тоже неясно
                ->type('title', 'Достаточно')
                ->type('text', 'Текст новости')
                ->press('Добавить')
                ->assertSee('Новость добавлена')
                ->assertPathIs('/admin');
        });
    }
}
