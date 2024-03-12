<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {

        $products = Product::get();

        // $products = Product::join('users', 'products.id', '=', 'users.id')
        //     ->select('products.*', 'users.name as user_name')
        //     ->get();

        return view('requestvehicle.index');
    }

    public function create(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            $errors = $validator->errors();

            $response = [
                'message' => 'Validation failed',
                'errors' => [
                    'name' => $errors->first('name'),
                    'email' => $errors->first('email'),
                    'password' => $errors->first('password'),
                ],
            ];

            return response()->json($response, 422);
        }

        // If validation passes, create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hash the password before storing

        // Save the user to the database
        $user->save();

        // Return a success response
        return response()->json([
            'message' => 'success',
            'user' => $user,
        ], 201); // Created status code
    }


    public function datausers()
    {
        $users = User::all();

        return response()->json([
            'users' => $users,
        ]);
    }
    public function delete(Request $request)
    {

        $id = $request->id;
        User::find($id)->delete();


        return response()->json([
            'message' => 'success',
        ]);
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
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
            $user = User::findOrFail($id);

            // Update the user's name and email
            $user->name = $name;
            $user->email = $email;

            // Save the changes to the database
            $user->save();

            return response()->json([
                'message' => 'success',
                'user' => $user // Optionally return the updated user object
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'failed' . $e->getMessage()
            ], 500); // Internal Server Error status code
        }
    }
}
