<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('products') && !Schema::hasColumn('products', 'features')) {
            Schema::table('products', function (Blueprint $table) {
                $table->json('features')->nullable();
            });
        }

        if (!Schema::hasTable('product_features')) {
            Schema::create('product_features', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
                $table->json('name');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('product_faqs')) {
            Schema::create('product_faqs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
                $table->json('question');
                $table->json('answer');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('product_qas')) {
            Schema::create('product_qas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
                $table->json('question');
                $table->json('answer');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('product_reviews')) {
            Schema::create('product_reviews', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->unsignedTinyInteger('rating')->default(0);
                $table->text('comment')->nullable();
                $table->string('image')->nullable();
                $table->boolean('is_visible')->default(true);
                $table->timestamps();

                $table->unique(['product_id', 'user_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
        Schema::dropIfExists('product_qas');
        Schema::dropIfExists('product_faqs');
        Schema::dropIfExists('product_features');

        if (Schema::hasTable('products') && Schema::hasColumn('products', 'features')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('features');
            });
        }
    }
};