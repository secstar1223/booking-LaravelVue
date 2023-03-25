<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tax_group_tax_rule', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('tax_group_id');
            $table->unsignedBigInteger('tax_rule_id');
            $table->index('tax_group_id');
            $table->index('tax_rule_id');
            $table->foreign('tax_group_id')->references('id')->on('tax_groups');
            $table->foreign('tax_rule_id')->references('id')->on('tax_rules');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tax_group_tax_rule');
    }
};
