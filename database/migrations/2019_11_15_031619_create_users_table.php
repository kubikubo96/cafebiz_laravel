<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->tinyInteger('is_approved')->default(0)->nullable()->comment('0: Chua phe duyet; 1: Phe duyet dong y;2: Phe duyet khong dong y');
            $table->timestamps();

            $table->unique(['tenant_id','code'],'unique_data');
            $table->index(['is_auto_approved','is_deleted'],'index_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
