<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UsersController extends Controller
{
    // ====================== START-----FETCH USERS API-----START====================
    public function getusers()
    {
        // $users=DB::table("users")->get();
        $users=User::get();
        if($users)
        {
            $status=200;
            $serverstatus=200;
            $msg="Users Data";
            $response=["status"=>$status,"serverstatus"=>$serverstatus,"msg"=>$msg, "response"=>$users];
        }else{
            $status=400;
            $serverstatus=200;
            $msg="No data found";
            $response=["status"=>$status,"serverstatus"=>$serverstatus,"msg"=>$msg,"response"=>[]];
        }
        
        return json_encode($response);
        
        exit;

    }
    // ====================== END-----FETCH USERS API-----END====================

      // ******************************##############******************************
    // ====================== START-----Edit USERS API-----START====================
    public function editUser(Request $request)
    {
        $id=$request->id;
        $users=User::find($id);
        if($users)
        {
            $status=200;
            $serverstatus=200;
            $msg="Users Data";
            $response=["status"=>$status,"serverstatus"=>$serverstatus,"msg"=>$msg, "response"=>$users];
        }else{
            $status=400;
            $serverstatus=200;
            $msg="No data found";
            $response=["status"=>$status,"serverstatus"=>$serverstatus,"msg"=>$msg,"response"=>[]];
        }
        
        return json_encode($response);
        

    }




    // ====================== END-----Edit USERS API-----END====================       
    // *************************#####################***************************
    // ******************************##############******************************
    // ====================== START-----UPDATE USERS API-----START====================
    public function updateUser(Request $request)
    {
        // $id=$request->id;
        $rules=array(
            "name"=>"required",
            "id" =>"required|max:3"
        );

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            $status=400;
            $serverstatus=200;
            $msg="Validation error";
            $response=["status"=>$status,"serverstatus"=>$serverstatus,"msg"=>$msg];
        } else {
           
            $user=User::find($request->id);
            if(!isset($user->id))
            { 
                $status=200;
                $serverstatus=200;
                $msg="data Not found"; 
               $response=["status"=>$status,"serverstatus"=>$serverstatus,"msg"=>$msg];
            
            }else{
                $user->name=$request->name;
                $save= $user->save();
                if($save)
                {
                $status=200;
                $serverstatus=200;
                $msg="User Updated Successfully"; 
               $response=["status"=>$status,"serverstatus"=>$serverstatus,"msg"=>$msg];
                }
                else{
                $status=400;
                $serverstatus=200;
                $msg="Something going wrong..plz try again";
                $response=["status"=>$status,"serverstatus"=>$serverstatus,"msg"=>$msg];
                }
            }
           
           
        }
        return json_encode($response);

    }




    // ====================== END-----Update USERS API-----END====================       
    // *************************#####################***************************
    // ====================== START----ADD USER----START =======================
    public function adduser(Request $req)
    {
        
   
  
        // die("testning");
        $user=new User();
      
        $user->name=$req->name;
        $user->email=$req->email;
        $user->city=$req->city;
        $user->password=$req->password;
       
        $save= $user->save();
       
        if($save)
        {
            $status=200;
            $serverstatus=200;
            $msg="User inserted successfully";
            $response=["status"=>$status,"serverstatus"=>$serverstatus,"msg"=>$msg];
           
        }
       
        return json_encode($response);
    } 

      // ====================== END---ADD USER- API-----END====================       
    // *************************#####################***************************
    // ====================== START----DELETE USER----START =======================

    public function deleteUser(Request $req)
    {
        $user=User::find($req->id);
        if(isset($user->id))
        {
            $delete=$user->delete();
            if($delete)
            {
                $status=200;
                $serverstatus=200;
                $msg="user deleted Susseccfully";
                $response=["status"=>$status,"serverstatus"=>$serverstatus,"msg"=>$msg];
            }else{
                $status=200;
                $serverstatus=200;
                $msg="Something going wrong...plz try again";
                $response=["status"=>$status,"serverstatus"=>$serverstatus,"msg"=>$msg];
            }
        }
        else{
            $status=200;
            $serverstatus=200;
            $msg="Data not found";
            $response=["status"=>$status,"serverstatus"=>$serverstatus,"msg"=>$msg];
        }
       return json_encode($response);
       
    }

      // ====================== END---DELETE USER-----END====================       
    // *************************#####################***************************
    // =======================  START --SEARCH USER--START====================
    public function searchUser(Request $req)
    {
    // echo $req->key;
    // die();
    // $data=DB::table("users")->where("name","LIKE",'%'.$req->key.'%')->get();
    // echo "<pre>";
    // print_r($data);
    // echo $data[0]->id;
    // die();
       $data= User::where('name', 'LIKE', '%'.$req->key.'%')->get();
       if(isset($data[0]->id))
       {
            $status=200;
            $serverstatus=200;
            $msg="Users Data";
            $response=["status"=>$status,"serverstatus"=>$serverstatus,"data"=>$data,"msg"=>$msg];
       }else{
            $status=200;
            $serverstatus=200;
            $msg="Data not found";
            $response=["status"=>$status,"serverstatus"=>$serverstatus,"msg"=>$msg];
       }
       return json_encode($response);
    }
}
