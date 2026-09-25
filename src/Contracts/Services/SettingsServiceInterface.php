<?php

namespace Rabsana\Sialk\Contracts\Services;

interface SettingsServiceInterface
{
    /**
     * @param int $userId
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function get(int $userId, string $name, mixed $default = null): mixed;


    /**
     * @param int $userId
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function set(int $userId, string $name, mixed $value): void;
}
