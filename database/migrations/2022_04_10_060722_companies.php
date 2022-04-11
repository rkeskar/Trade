<?php

use App\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Companies extends Migration
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


        $data = [
                 ['company_name' => 'Alibaba', 'year_founded' => 1999, 'headquarters' => 'Hangzhou, China', 'founder' => 'Jack Ma', 'company_worth' => '$109.4 billion'],
                 ['company_name' => 'Amazon', 'year_founded' => 1999, 'headquarters' => 'Seattle, WA', 'founder' => 'Jeff Bezos', 'company_worth' => '$368.1 billion'],
                 ['company_name' => 'Best Buy', 'year_founded' => 1966, 'headquarters' => 'Richfield, MN', 'founder' => 'Hubert Joly', 'company_worth' => '$46.27 billion'],
                 ['company_name' => 'Walmart', 'year_founded' => 1962, 'headquarters' => 'Rogers, AR', 'founder' => 'Sam Walton', 'company_worth' => '$572.8 billion'],
                 ['company_name' => 'Kroger', 'year_founded' => 1883, 'headquarters' => 'Cincinnati, OH', 'founder' => 'Bernard Kroger', 'company_worth' => '$132.5 billion'],
                 ['company_name' => 'The Home Depot', 'year_founded' => 1978, 'headquarters' => 'Atlanta, GA', 'founder' => 'Craig Menear', 'company_worth' => '$110.2 billion'],
                 ['company_name' => 'Etsy', 'year_founded' => 2005, 'headquarters' => 'Brooklyn, NY', 'founder' => 'Robert Kalin', 'company_worth' => '$1.72 billion'],
                 ['company_name' => 'Menards', 'year_founded' => 1960, 'headquarters' => 'Eau Claire, WI', 'founder' => 'John Menard. Jr', 'company_worth' => '$10.7 billion'],
                 ['company_name' => 'Costco', 'year_founded' => 2005, 'headquarters' => 'Issaquah, WA', 'founder' => 'Craig Jelinek', 'company_worth' => '$166.76 billion'],
                 ['company_name' => 'Hobby Lobby', 'year_founded' => 1972, 'headquarters' => 'Oklahoma City, OK', 'founder' => 'David Green', 'company_worth' => '$5 billion'],
            ]     ;
        Company::insert($data);
        //DB::table('companies_info')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies_info');
    }
}
