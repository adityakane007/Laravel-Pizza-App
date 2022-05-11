<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('App\Http\Middleware\UserValidation')->only([
            'store'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formData = $request->all();
        $newUser = new User();
        $newUser->name = $formData['name'];
        $newUser->email = $formData['email'];
        $newUser->mobile = $formData['mobile'];
        $newUser->address = $formData['address'];
        $newUser->username = $formData['username'];
        $newUser->password = md5($formData['password']);
        $newUser->user_type = 'customer';
        if ($newUser->save()) {
            return array("success" => "1", "message" => "User Created Successfully");
        } else {
            return array("success" => "0", "message" => "Error While Creating User");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userDtls = new User();
        $loggedInUserId = $userDtls->getUserId($id);
        if ($loggedInUserId != null) {
            $userInfo = User::where('pk_id', $loggedInUserId)->get();
            if ($userInfo != null) {
                return array("success" => "1", "message" => "User Data Found", "data" => $userInfo);
            } else {
                return array("success" => "0", "message" => "No User Data Found");
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {      
        $userDtls = new User();
        $formData = $request->all();
        $loggedInUserId = $userDtls->getUserId($id);
        if ($loggedInUserId != null) {
            $userInfo = User::find($loggedInUserId);            
            if ($userInfo != null) {
                $userInfo->name = $formData['name'];
                $userInfo->email = $formData['email'];
                $userInfo->mobile = $formData['mobile'];
                $userInfo->address = $formData['address'];                
                if ($userInfo->update()) {
                    return array("success" => "1", "message" => "User Updated Successfully");
                } else {
                    return array("success" => "0", "message" => "Error While Updating User");
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request)
    {
        $formData = $request->all();
        $username = $formData['username'];
        $password = $formData['password'];

        if (($username != null || $username != '') && ($password != null || $password != '')) {

            $userModel = new User();
            $userInfo = $userModel->validateUser($username, $password);
            if (count($userInfo) > 0) {
                return array("success" => "1", "message" => "User Validate Successfully");
            } else {
                return array("success" => "0", "message" => "Invalid User Details");
            }
        } else {
            return array("success" => "0", "message" => "Error In Data");
        }
    }
}
