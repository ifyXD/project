<?php

namespace App\Http\Controllers;

use App\Models\Budgets;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BudgetsController extends Controller
{
    public function index()
    {
        return view('budgets.index');
    }

    public function create(Request $request)
    {
        // Validation rules
        $rules = [
            'content' => 'required|string',
            'qty' => 'required|integer|min:0',
            'unitcost' => 'required|integer|min:0',
            'totalcost' => 'required|integer|min:0',
            'laborneeded' => 'required|integer|min:0',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'failed',
                'errors' => $validator->errors(),
            ], 422); // Unprocessable Entity status code
        }

        // If validation passes, create a new user
        $budget = new Budgets();
        $budget->content = $request->content;
        $budget->qty = $request->qty;
        $budget->unitcost = $request->unitcost;
        $budget->totalcost = $request->totalcost;
        $budget->labordneeded = $request->labordneeded;
        



        // Save the user to the database
        $budget->save();

        // Return a success response
        return response()->json([
            'message' => 'success',
            'budget' => $budget,
        ], 201); // Created status code
    }


    public function datausers()
    {
        $budget = Budgets::all();

        return response()->json([
            'budget' => $budget,
        ]);
    }
    public function delete(Request $request)
    {

        $id = $request->id;
        Budgets::find($id)->delete();


        return response()->json([
            'message' => 'success',
        ]);
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $content = $request->content;
        $email = $request->email;
       
        try {
            // Validation rules
            $rules = [
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($id),
                ],
            ];
    
            // Validate the request data
            $validator = Validator::make($request->all(), $rules);
    
            // Check if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'failed',
                    'errors' => $validator->errors(),
                ], 422); // Unprocessable Entity status code
            }
    
            // Find the user by ID
            $budget = Budgets::findOrFail($id);
    
            // Update the user's name and email
            $budget->content = $content;
            $budget->email = $email;
    
            // Save the changes to the database
            $budget->save();
    
            return response()->json([
                'message' => 'success',
                'budget' => $budget // Optionally return the updated user object
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'failed' . $e->getMessage()
            ], 500); // Internal Server Error status code
        }
    }
}    