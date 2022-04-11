<?php


namespace App\Http\Controllers;

use App\Company;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index(Request $request)
    {

        $companies_info = Company::getAll();

        return view('welcome', compact('companies_info'));
    }


    public function edit($name)
    {
        $name = Company::sanitize($name);
        $company_info = Company::getCompleteData($name);
        if($company_info->isNotEmpty())
        {
            return response()->json(compact('company_info'), 200);
        }
    }

    public function save($data)
    {
        $decoded_data = urldecode($data);
        $json_data = json_decode($decoded_data, true);
        Company::updateData($json_data);
        return response()->json('Information has been updated', 200);
    }
    public function destroy($data)
    {
        $company_id = Company::sanitize($data);
        Company::destroy($company_id);
        return response()->json('Successfully Deleted!', 200);
    }
    public function create(Request $request)
    {
        $company_name = Company::sanitize($request->companyname);
        $founder_name = Company::sanitize($request->founder_name);
        $inception_year = Company::sanitize($request->inceptionyear);
        $net_worth = Company::sanitize($request->networth);
        $headquarters = Company::sanitize($request->hq);
        $is_present = Company::get($company_name);
        if($is_present)
        {
            return response()->json('Company information is already present', 200);
        }
        else{
            $data = ['company_name' => $company_name,
                'year_founded' => $inception_year,
                'headquarters' => $headquarters,
                'founder' => $founder_name,
                'company_worth' => $net_worth];
            Company::insert($data);
            return response()->json('Information has been inserted', 200);

        }
    }


}


?>
