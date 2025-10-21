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
        Schema::create('statuses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id', 50)->primary();
            $table->string('name', 50);
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id', 50)->primary();
            $table->string('name', 50);
            $table->text('child_roles',)->nullable();
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name', 100)->nullable(false);
            $table->string('link', 100)->nullable(false)->default('#');
            $table->string('link_alias', 100)->nullable(false)->default('#');
            $table->string('icon', 100)->nullable(false)->default('#');
            $table->bigInteger('parent')->nullable(false)->default(0);
            $table->bigInteger('order')->nullable(false)->default(0);
            $table->boolean('status')->nullable(false)->default(true);
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id', 50)->primary();
            $table->string('name', 50);
        });

        Schema::create('role_menu_permission', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('role_id', 50)->nullable(false);
            $table->unsignedBigInteger('menu_id')->nullable(false);
            $table->string('permission_id', 50)->nullable(false);
            $table->primary(['role_id', 'menu_id', 'permission_id']);
            $table->foreign('role_id')->on('roles')->references('id')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('menu_id')->on('menus')->references('id')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('permission_id')->on('permissions')->references('id')->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary(); // Set UUID as the primary key
            $table->string('role_id', 50)->nullable(false);
            $table->string('status_id', 50)->nullable(false);
            $table->string('name', 100)->nullable(false);
            $table->string('email', 100)->unique('users_email_unique');
            $table->string('password', 100);
            $table->timestamps();
            $table->foreign('role_id')->on('roles')->references('id')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('status_id')->on('statuses')->references('id')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('role_menu_permission');
        Schema::dropIfExists('users');
    }
};
