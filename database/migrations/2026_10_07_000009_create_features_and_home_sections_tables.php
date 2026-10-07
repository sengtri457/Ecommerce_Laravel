<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('position')->default('home_services')->index();
            $table->string('icon');
            $table->string('title');
            $table->string('description');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('type')->default('featured'); // featured, new, category, on_sale, manual
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->integer('item_limit')->default(8);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('home_section_products', function (Blueprint $table) {
            $table->foreignId('home_section_id')->constrained('home_sections')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->integer('sort_order')->default(0);
            $table->primary(['home_section_id', 'product_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_section_products');
        Schema::dropIfExists('home_sections');
        Schema::dropIfExists('features');
    }
};
