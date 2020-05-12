<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\JwtAuth;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
  public function register(Request $request){
    //Recoger post
    $json = $request->input('json',null);
    $params = json_decode($json);
    if(!is_null ($json)){
      $email = (isset($params->email)) ? $params->email : null;
      $name = (isset($params->name)) ? $params->name : null;
      $surname = (isset($params->surname)) ? $params->surname : null;
      $role =  'ROLE_USER';
      $password = (isset($params->password)) ? $params->password : null;
      //valido que las variables no vengan nulas
      if(!is_null($email) && !is_null($password) && !is_null($name)){
          //Crear el Usuario
          $user = new User();
          $user->email = $email;
          $user->password = hash('sha256',$password);
          $user->name = $name;
          $user->surname = $surname;
          $user->role = $role;

          //Comprobar usuario duplicado
          $isset_user = User::where('email','=', $email)->count();

          if($isset_user==0){
            $user->save();
            $data = array(
              'status' => 'success',
              'code' => 200,
              'message' => 'Usuario registrado correctamente'
            );
          }else{
            $data = array(
              'status' => 'error',
              'code' => 400,
              'message' => 'Usuario ya existe, no puede registrarse'
            );
          }


      }else{
        $data = array(
          'status' => 'error',
          'code' => 400,
          'message' => 'Usuario no creado'
        );
      }
    }else{
      $data = array(
        'status' => 'error',
        'code' => 400,
        'message' => 'Usuario no creado json null'
      );
    }
    return response()->json($data, 200);
  }

  public function login(Request $request){
    $jwtAuth = new JwtAuth();

    //Recibir post
    $json = $request->input('json',null);
    $params = json_decode($json);
    if(!is_null($json)){
      $email = (isset($params->email)) ? $params->email : null;
      $password = (isset($params->password)) ? $params->password: null;
      $getToken = (isset($params->getToken) ) ? $params->getToken : null;


      if(!is_null($email) && !is_null($password) && ($getToken == null || $getToken == 'false')){
        //Cifrar la password
        $pwd = hash('sha256',$password);
        $singup = $jwtAuth->signup($email,$pwd);

      }elseif (!is_null($email) && !is_null($password) && $getToken != null) {

        $pwd = hash('sha256',$password);
        $singup = $jwtAuth->signup($email,$pwd,$getToken);



      }else{
        $signup =array(
          'status' => 'error',
          'message' => 'Envia tus datos por post'
        );

      }

    }else{
      $signup =array(
        'status' => error,
        'message' => 'Envia tus datos por post'
      );
    }

      return response()->json($singup,200);
  }
}
