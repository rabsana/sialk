<?php

namespace Rabsana\Sialk\Services;

use Rabsana\Sialk\Contracts\Services\SettingsServiceInterface;
use Rabsana\Sialk\Models\Setting;

abstract class SettingsService implements SettingsServiceInterface
{
    public function get(int $userId, string $name, mixed $default = null): mixed
    {
        $setting = Setting::where('user_id', $userId)
            ->where('name', $name)
            ->first();

        if ($setting) {
            return $setting->value;
        }

        return $default;
    }

    public function set(int $userId, string $name, mixed $value): void
    {
        $setting = Setting::where('user_id', $userId)
            ->where('name', $name)
            ->first();

        if (empty($setting)) {
            $setting = new Setting;
            $setting->name = $name;
            $setting->user_id = $userId;
        }

        $setting->value = $value;

        $setting->save();
    }
}
