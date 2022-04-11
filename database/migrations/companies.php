<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name')->unique();
            $table->string('year_founded');
            $table->string('headquarters');
            $table->string('founder');
            $table->string('company_worth');
        });
        DB::table('companies_info')->insert(
            ['company_name' => 'Alibaba',
              'year_founded' => 1999,
              'headquarters' => 'Hangzhou, China',
              'founder' => 'Jack Ma',
               'company_worth' => '$109.4 billion'
            ],
            ['company_name' => 'Amazon',
                'year_founded' => 1999,
                'headquarters' => 'Seattle, WA',
                'founder' => 'Jeff Bezos',
                'company_worth' => '$368.1 billion'],
            ['company_name' => 'Best Buy',
                'year_founded' => 1966,
                'headquarters' => 'Richfield, MN',
                'founder' => 'Hubert Joly',
                'company_worth' => '$46.27 billion']
        );


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
