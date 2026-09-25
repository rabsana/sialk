<?php

namespace Rabsana\Sialk\Models;

use Illuminate\Database\Eloquent\Model;
use Throwable;

class Setting extends Model
{
    public function getTable()
    {
        try {
            return app('config')->get('sialk.settings_table', 'rabsana_sialk_settings');
        } catch (Throwable $e) {
            return 'rabsana_sialk_settings';
        }
    }
}
