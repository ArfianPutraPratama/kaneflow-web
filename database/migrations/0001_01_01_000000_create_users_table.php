<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 191)->unique();
            $table->string('email', 191)->unique();
            $table->string('password');
            $table->string('full_name')->nullable();
            $table->text('address')->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('profile_photo')->nullable();
            $table->rememberToken(); // This adds the `remember_token` column
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
