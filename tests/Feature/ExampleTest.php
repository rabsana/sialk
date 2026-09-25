<?php

declare(strict_types=1);

use Rabsana\Sialk\Sialk;

it('resolves the singleton', function () {
    expect(app(Sialk::class))->toBeInstanceOf(Sialk::class);
});

it('returns the same instance from the container', function () {
    expect(app(Sialk::class))->toBe(app(Sialk::class));
});

it('merges the package config', function () {
    expect(config('sialk.placeholder'))->toBe('default');
});

it('loads the package translations', function () {
    expect(trans('sialk::messages.placeholder'))->toBe('Main placeholder translation.');
});

it('loads the package views', function () {
    expect(view()->exists('sialk::placeholder'))->toBeTrue();
});

it('registers the artisan command', function () {
    $this->artisan('sialk:placeholder')
        ->expectsOutputToContain('Main placeholder command executed.')
        ->assertSuccessful();
});
