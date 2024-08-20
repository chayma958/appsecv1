<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateActionEnumInFirewallRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('firewall_rules', function (Blueprint $table) {
            // Modify ENUM values
            $table->enum('action', ['allow', 'deny'])->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('firewall_rules', function (Blueprint $table) {
            // Revert to original ENUM values if needed
            $table->enum('action', ['allow', 'drop'])->change();
        });
    }
}
