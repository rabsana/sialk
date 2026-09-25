<?php

namespace Rabsana\Sialk\Models;

use Illuminate\Database\Eloquent\Model;
use Throwable;

class Option extends Model
{
    public mixed $name;
    public mixed $value;
    public mixed $default_value;

    protected $fillable = ['name', 'value', 'default_value'];

    public function getTable()
    {
        try {
            return app('config')->get('sialk.options_table', 'rabsana_sialk_options');
        } catch (Throwable $e) {
            return 'rabsana_sialk_options';
        }
    }
}
