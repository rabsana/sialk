<?php

namespace Rabsana\Sialk\Models;

use Illuminate\Database\Eloquent\Model;
use Throwable;

class Quest extends Model
{
    public function getTable()
    {
        try {
            return app('config')->get('sialk.quests_table', 'rabsana_sialk_quests');
        } catch (Throwable $e) {
            return 'rabsana_sialk_quests';
        }
    }
}
