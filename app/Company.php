<?php

namespace App;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    protected $table = 'companies_info';
    protected $primaryKey = 'id';

    public static function insert($data)
    {
        DB::table('companies_info')->insert($data);
    }
    public static function getAll()
    {
        try{
            $data =  DB::table('companies_info')->get();
        }catch (\Exception $e){
            $data = null;
            Debugbar::info('Data is not present');
        }
         return $data;
    }

    public static function get($company_name)
    {
        $name = DB::table('companies_info')->where('company_name', $company_name)->value('id');
        if(!empty($name)){
            $is_present = true;
        }else{
            $is_present = false;
        }
        return $is_present;
    }

    public static function getCompleteData($company_name)
    {
        $company_info = DB::table('companies_info')->where('company_name', $company_name)->get();
        return $company_info;
    }

    public static function updateData($data)
    {
        $id = Company::sanitize($data['company_id']);
        $company_name = Company::sanitize($data['company_name']);
        $year_founded = Company::sanitize($data['year_founded']);
        $headquarters = Company::sanitize($data['hq']);
        $founder = Company::sanitize($data['founder']);
        $net_worth = Company::sanitize($data['net_worth']);

         try{
             DB::table('companies_info')->where('id', $id)->update(['company_name' => $company_name,
                 'year_founded' => $year_founded, 'headquarters' => $headquarters, 'founder' => $founder, 'company_worth' => $net_worth]);
         }catch(\Exception $e){
               Debugbar::info('Update is not successful');
         }
    }

    public static function destroy($company_id)
    {
        $company_id = Company::sanitize($company_id);
        DB::table('companies_info')->where('id', $company_id)->delete();
    }

    /* Very important to sanitize the input for any SQL injection attacks*/
    public static function sanitize($input)
    {
        $sanitized_input = strip_tags($input);
        $sanitized_input = preg_replace('/[^A-Z, \'$&.a-z0-9\-]/', '', $sanitized_input);
        return $sanitized_input;
    }


}
