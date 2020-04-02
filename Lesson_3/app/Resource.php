<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'url',
    ];

    public static function rules()
    {
        return [
            'url' => 'required|url|min:10|max:100',
        ];
    }

    public static function attributeNames()
    {
        return [
            'url' => 'Ссылка ресурса',
        ];
    }

}
