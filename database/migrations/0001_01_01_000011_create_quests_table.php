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
            $table->string('third_party', 192);
            $table->string('type', 100);
            $table->text('reason')->nullable();
            $table->unsignedSmallInteger('response_status_code')->default(0);
            $table->string('method', 20);
            $table->text('endpoint');
            $table->string('request_time');
            $table->string('response_time');
            $table->text('request_headers')->nullable();
            $table->text('request_query_params')->nullable();
            $table->text('request_body')->nullable();
            $table->longText('response_body')->nullable();
            $table->longText('response_headers')->nullable();
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
            return app('config')->get('sialk.quests_table', 'rabsana_sialk_quests');
        } catch (Throwable $e) {
            return 'rabsana_sialk_quests';
        }
    }
};
