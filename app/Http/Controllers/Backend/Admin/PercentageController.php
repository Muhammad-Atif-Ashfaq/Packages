<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Percentage;

class PercentageController extends Controller
{
    public $model;
    public function __construct() {

        $this->model = new Percentage;
    }

    public function index()
    {
        $percentages = $this->model::all();
        return view('backend.admin.percentage.list', compact('percentages'));
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
        $percentage = $this->model::find($id);
        return view('backend.admin.percentage.update', compact('percentage'));
    }

    
    public function update(Request $request, string $id)
    {
        $percentage = $this->model::find($id);
        $update = $percentage->update([
            'first_profit' => $request->first_profit,
            'second_profit' => $request->second_profit,
            'third_profit' => $request->third_profit,
        ]);
        if($update)
        {
            return redirect()->route('admin.percentage.index')->with('success','Percentage Updated');
        }
    }

    
    public function destroy(string $id)
    {
        //
    }
}
