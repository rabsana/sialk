<?php

declare(strict_types=1);

namespace Rabsana\Sialk\Console\Commands;

use Illuminate\Console\Command;

class SialkCommand extends Command
{
    /**
     * The command signature.
     */
    protected $signature = 'sialk:placeholder';

    /**
     * The command description.
     */
    protected $description = 'Placeholder Artisan command shipped by the package sialk.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->line('Main placeholder command executed.');

        return self::SUCCESS;
    }
}
