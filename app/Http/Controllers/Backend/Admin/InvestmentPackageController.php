<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvestmentPackage;

class InvestmentPackageController extends Controller
{
    public $model;
    public function __construct() {

        $this->model = new InvestmentPackage;
    }
    
    public function index()
    {
        $package = $this->model::all();
        return view('backend.admin.investmentPackage.list', compact('package'));
    }

   
    public function create()
    {
        return view('backend.admin.investmentPackage.addNew');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'         => ['required'],
            'investment'    => ['required'],
            'monthly_return'=> ['required'],
        ]);

        $packag = $this->model::create([
            'name' => $request->name,
            'investment' => $request->investment,
            'monthly_return' => $request->monthly_return
        ]);
        if($packag)
        {
            return redirect()->route('admin.investment_packages.index')->with('success','Investment Package Added');
        }
    }

    
    public function show(string $id)
    {
        $packag = $this->model::findOrFail($id);
        if($packag)
        {
            $packag->delete();
            return redirect()->back()->with('success','Investment Package Deleted');
        }else
        {
            return redirect()->back()->with('error','Soomething went wrong');
        }
    }

    
    public function edit(string $id)
    {
        $package = $this->model::findOrFail($id);
        return view('backend.admin.investmentPackage.update', compact('package'));
    }

    
    public function update(Request $request, string $id)
    {
        $package = $this->model::findOrFail($id);
        $update = $package->update([
            'name' => $request->name,
            'investment_start_range' => $request->investment_start_range,
            'investment_end_range' => $request->investment_end_range,
            'monthly_return' => $request->monthly_return
        ]);
        if($update)
        {
            return redirect()->route('admin.investment_packages.index')->with('success','Investment Package Updated');
        }
    }

}