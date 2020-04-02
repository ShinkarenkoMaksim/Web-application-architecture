<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 * @package App
 *
 * @property string title
 * @property string text
 * @property string img
 * @property boolean is_private
 */
class News extends Model
{
    protected $fillable = ['id', 'title', 'text', 'is_private', 'category_id', 'category', 'img'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->first();
    }

    public static function rules($category = null)
{
    $tableCategory = (new Category())->getTable();
    return [
        'title' => 'required|min:5|max:100',
        'text' => 'required|max:5000',
        'category_id' => ($category == 'new_cat') ? "required|unique:categories,title" : "required|exists:{$tableCategory},id",
        'category' => ($category == 'new_cat') ? "required|unique:categories,title" : "nullable",
        'img' => 'mimes:jpeg,jpg|max:1000'
    ];
}

    public static function attributeNames()
    {
        return [
            'title' => 'Заголовок новости',
            'text' => 'Текст новости',
            'category_id' => 'Категория новости',
            'img' => 'Изображение'
        ];
    }

}
