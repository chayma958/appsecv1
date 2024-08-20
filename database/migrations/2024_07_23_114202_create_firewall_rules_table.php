<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirewallRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firewall_rules', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address')->nullable();
            $table->string('ip_range_start')->nullable();
            $table->string('ip_range_end')->nullable();
            $table->integer('port')->nullable();
            $table->enum('direction', ['inbound', 'outbound']);
            $table->enum('action', ['allow', 'deny']);  // Ensure this matches the intended values
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firewall_rules');
    }
}
