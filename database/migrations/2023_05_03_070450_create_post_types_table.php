<?php

use App\Models\PostType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('info')->nullable();
        });

        PostType::create(['name' => 'subscriber', 'info' => 'subscriber only']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_types');
    }
};
