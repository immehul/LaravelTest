<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserConnectionRequest;
use Redirect;
use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the user list whose critria is matched.
     *
     * @param  array  $data
     * @return array $searchData
     */
    public function searchUser(Request $request)
    {
        $requestData = $request->post(); 
        $searchData = $requestData['search_user'];

        if($searchData != '') {
            $currentUserid = Auth::id();

            //Get the search by user model instace.
            $userData =  User::where('first_name','LIKE',"%{$searchData}%")
                ->select('id', 'first_name', 'last_name', 'phone_number', 'email', 'tech_name')
                ->orWhere('last_name', 'LIKE',"%{$searchData}%")
                ->orWhere('phone_number', 'LIKE',"%{$searchData}%")
                ->orWhere('email', 'LIKE',"%{$searchData}%")
                ->orwhereRaw("FIND_IN_SET('{$searchData}', tech_name)")
                ->where('id', '!=', $currentUserid)
                ->orderBy('first_name', 'asc')
                ->get();
        
            return view('home', compact('userData', 'searchData', 'currentUserid'));
        } else {
            return redirect()->back()->with('success', 'Please enter any keyword to search');
        }
    }
    
    /**
     * Send User connection Requiest
     *
     * @param  string  $id
     * @return bolleaan true|false
     */
    public function sendRequest($id)
    {
    	if($id != '') {
            $isCreated = UserConnectionRequest::create([
                'user_id'   => Auth::id(),
                'req_user_id' => $id,
                'status'    => 0
            ]);
    	}

        return redirect('home');
    }

    /**
     * Get my connection list infor
     *
     * @return array responseData
     */
    public function getConnectionList()
    {
        $obj = new UserConnectionRequest();
    	
        $myConnection = $obj->getMyConnectionList()->where('id', Auth::id());
        
        return view('connection-list', compact('myConnection'));
    }
}
