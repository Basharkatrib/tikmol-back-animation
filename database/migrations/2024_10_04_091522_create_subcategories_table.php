<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();                                      
            $table->string('name');                             // اسم الفئة الفرعية
            $table->string('slug')->unique();                   // عنوان URL الفئة الفرعية
            $table->text('description')->nullable();            // وصف الفئة الفرعية
            $table->unsignedBigInteger('category_id');          // معرف الفئة الرئيسية المرتبطة
            $table->timestamps();                              

            // العلاقة مع جدول الفئات الرئيسية
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcategories');
    }
}
