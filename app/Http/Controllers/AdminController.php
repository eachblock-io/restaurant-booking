<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Helper\ResponseHelper;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
// use App\Http\Requests\StoreAdminRequest;
// use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\AdminRegisterRequest;
use Dedoc\Scramble\Support\Generator\Response;

class AdminController extends Controller
{
      /**
     * Admin Register
     * @param
     */


     public function adminRegister(AdminRegisterRequest $request){




    //    try{

    //     $admin = Admin::create([

    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),

    //     ]);

    //     if($admin){
    //         return ResponseHelper::success(message:'Admin registered successfully', data: $admin, statusCode: 201);

    //     }

    //     return ResponseHelper::error(message:'Admin not registered', statusCode: 400);

    //    }
    //    catch(\Exception $e){
    //     // \Log::error('Admin registration failed: ' . $e->getMessage(). '- Line no.'. $e->getLine());
    //     \Illuminate\Support\Facades\Log::error('Admin registration failed: ' . $e->getMessage(). '- Line no.'. $e->getLine());

    //     return ResponseHelper::error('error', 'Admin not registered', 400);


    //    }
     }

     /**
     * Admin Login
     * @param
     */


     public function adminLogin(Request $request)
     {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return ResponseHelper::error('Invalid credentials', statusCode: 401);
            // return $this->errorResponse('Invalid credentials', 401);
        }

        $token = $admin->createToken('admin-token')->plainTextToken;

        $data = [
            'admin' => $admin,
            'token' => $token,
            'token_type' => 'Bearer'
        ];

        return ResponseHelper::success(
            message: 'Admin logged in successfully',
            data: $data,
            statusCode: 200
        );

     }

      /**
     * Admin Logout
     * @param
     */

     public function adminLogout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return ResponseHelper::success(
        message: 'Admin logged out successfully',
        statusCode: 200
    );
}

 /**
     * Admin ForgetPassword
     * @param
     */

     Public function forgotPassword(Request $request)
     {
         
     }

    public function index()
    {
        //
        return Admin::all();
    }

    /**
     * Admin Login
     */


    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Admin $admin)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
