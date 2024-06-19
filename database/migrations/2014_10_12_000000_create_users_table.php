<?php

use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('is_admin')->default(0);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $admin = new User();
        $admin->name = "administrateur";
        $admin->email = "administrateur@univ-roune.com";
        $admin->password = Hash::make("123456");
        $admin->is_admin = true;
        $admin->save();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
