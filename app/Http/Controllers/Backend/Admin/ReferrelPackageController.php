<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferralPackage;

class ReferrelPackageController extends Controller
{
    public $model;
    public function __construct() {

        $this->model = new ReferralPackage;
    }
    public function index()
    {
        $package = $this->model::all();
        return view('backend.admin.referrelPackag.list', compact('package'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $package = $this->model::findOrFail($id);
        return view('backend.admin.referrelPackag.update', compact('package'));
    }


    public function update(Request $request, string $id)
    {
        $package = $this->model::findOrFail($id);

        $update = $package->update([
            'name' => $request->name,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,
            'monthly_downline_return' => $request->monthly_downline_return,
            'second_profit' => $request->second_profit,
            'third_profit' => $request->third_profit,
            'fourth_profit' => $request->fourth_profit,
            'fifth_profit' => $request->fifth_profit,
            'bonus_for_reaching_tier' => $request->bonus_for_reaching_tier,
            'fixed_bonus_for_recruits_tier' => $request->fixed_bonus_for_recruits_tier,
        ]);
        if($update)
        {
            return redirect()->route('admin.referrel_packages.index')->with('success','Referral Package Updated');
        }
    }

    public function destroy(string $id)
    {
        //
    }
}