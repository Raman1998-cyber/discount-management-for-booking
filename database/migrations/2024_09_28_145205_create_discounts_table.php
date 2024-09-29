<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('type', ['fixed', 'percentage']);
            $table->decimal('value', 8, 2);
            $table->integer('max_uses')->nullable();
            $table->decimal('max_discount', 8, 2)->nullable();
            $table->boolean('recurring')->default(false);
            $table->boolean('family_member')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
?>