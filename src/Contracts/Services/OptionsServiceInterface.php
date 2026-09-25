<?php

namespace Rabsana\Sialk\Contracts\Services;

/**
 * Provides options that used all over parts of system.
 */
interface OptionsServiceInterface
{
    /**
     * get option entry
     *
     * @param string $name
     * @param float|bool|int|string|null $defaultValue
     * @return string|int|float|bool|null
     */
    public function get(string $name, float|bool|int|string|null $defaultValue = null): string|int|float|bool|null;

    /**
     * Clear cached data
     */
    public function refresh(): void;

    /**
     * Initialize option entry
     *
     * @param string $name
     * @param float|bool|int|string|null $value
     * @param float|bool|int|string|null $defaultValue
     */
    public function init(string $name, float|bool|int|string|null $value, float|bool|int|string|null $defaultValue): void;

    /**
     * set value of existing option
     *
     * @param string $name
     * @param float|bool|int|string|null $value
     */
    public function set(string $name, float|bool|int|string|null $value): void;

    /**
     * reset option value to default
     *
     * @param string $name
     */
    public function reset(string $name): void;
}
