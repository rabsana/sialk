<?php

namespace Rabsana\Sialk\Services;

use Rabsana\Sialk\Contracts\Services\OptionsServiceInterface;
use Rabsana\Sialk\Models\Option;
use Throwable;

abstract class OptionsService implements OptionsServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function get(string $name, float|bool|int|string|null $defaultValue = null): string|int|float|bool|null
    {
        $options = $this->fetchOptions();

        if (isset($options[$name])) {
            return $options[$name];
        }

        return $defaultValue;
    }

    /**
     * {@inheritDoc}
     */
    public function refresh(): void
    {
        app('cache')->forget($this->getCacheKey());
    }

    /**
     * {@inheritDoc}
     */
    public function init(string $name, mixed $value, mixed $defaultValue): void
    {
        Option::query()->updateOrCreate([
            'name' => $name,
        ], [
            'value' => $value,
            'default_value' => $defaultValue,
        ]);

        $this->purgeCache();
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $name, mixed $value): void
    {
        $option = Option::query()->where([
            'name' => $name,
        ])->first();

        if ($option) {
            $option->value = $value;
            $option->save();

            $this->purgeCache();
        } else {
            $this->init($name, $value, $value);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function reset(string $name): void
    {
        $option = Option::query()->where([
            'name' => $name,
        ])->first();

        if ($option) {
            $option->value = $option->default_value;
            $option->save();

            $this->purgeCache();
        }
    }

    protected function purgeCache(): void
    {
        app('cache')->forget($this->getCacheKey());
    }

    protected function fetchOptions()
    {
        if (app('cache')->has($this->getCacheKey())) {
            return app('cache')->get($this->getCacheKey());
        }

        try {
            $options = Option::query()->pluck('value', 'name')->toArray();

            app('cache')->forever($this->getCacheKey(), $options);

            return $options;
        } catch (Throwable $exception) {
            return [];
        }
    }

    protected function getCacheKey(): string
    {
        try {
            return app('config')->get('sialk.options_cache_key');
        } catch (Throwable $e) {
            return 'rabsana_sialk_system_options';
        }
    }
}
