<?php
namespace SRC\App\Models;
use SRC\Config\DB;
use SRC\Helpers\Helpers;

class HomeModel{
    public function __construct(){
    }

    public function INSERTARDB($request){

     $JWT =DB::CreateJWT($request->nombre,$request->apellido);

     $sql = "INSERT INTO prueba (nombre, apellido,token,exp_token) VALUES (?,?,?,?);";
     return DB::prepare($sql)->bindValue([
        $request->nombre,
        $request->apellido,
        $JWT->token,
        $JWT->exp
    ])->execute();
 }

 public function BUSCARDB($request){

  $Validate =DB::ValidateJWT("prueba",$request->token);

  if ($Validate->status ==="success") {

     $sql="SELECT * FROM  prueba";
       return DB::prepare($sql)->fetchAll();
 }else{

    return $Validate;
 }

}
}
