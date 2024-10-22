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
            $table->string('position')->nullable()->default('staff');
            $table->string('salary')->nullable()->default(1000000);
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default(bcrypt('secret'));
            $table->string('department')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('nrc')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->default('other');
            $table->text('skills')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->date('joining_date')->nullable()->default(now());
            $table->enum('system_status', ['active', 'inactive', 'deleted'])->default('active');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        User::create([
            'name' => 'admin',
            'email' => 'super@admin.com',
            'position' => 'Super Administrator',
            'salary' => '100000',
            'role' => 'admin',
            'password' => bcrypt('supersecret'),
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'position' => 'Default User',
            'salary' => '100000',
            'role' => 'user',
            'password' => bcrypt('password')
        ]);

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
