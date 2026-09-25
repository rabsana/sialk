<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable($this->getTable())) {
            return;
        }

        Schema::create($this->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('name', 72)->unique();
            $table->text('value')->nullable();
            $table->text('default_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->getTable());
    }

    protected function getTable(): string
    {
        try {
            return app('config')->get('sialk.options_table', 'rabsana_sialk_options');
        } catch (Throwable $e) {
            return 'rabsana_sialk_options';
        }
    }
};
