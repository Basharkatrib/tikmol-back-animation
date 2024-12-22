<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();                                      
            $table->string('name');                           
            $table->text('description')->nullable();           
            $table->decimal('price', 8, 2);                    
            $table->decimal('old_price', 8, 2)->nullable();   
            $table->decimal('discount', 5, 2)->nullable();     
            $table->boolean('is_active')->default(true);      
            $table->string('image_path')->nullable();          
            $table->unsignedBigInteger('category_id');         
            $table->timestamps();                              

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
        Schema::dropIfExists('products');
    }
}
