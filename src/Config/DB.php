<?php

namespace SRC\Config;
require_once("./vendor/autoload.php");
use Firebase\JWT\JWT;
use \PDO;
use \PDOException;
use SRC\Helpers\Response;

class DB {

    private static $conn;
    private static $db;
    private static $stmt;

    public function __construct() {
    }

    public static function init($db_host, $db_name, $db_user, $db_password) {
        self::$db = new DB();

        try {
            self::$conn = new PDO(
                "mysql:host={$db_host};port=3306;dbname={$db_name};charset=utf8",
                $db_user,
                $db_password,
                [
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_TIMEOUT => 5
                ]
            );
        } catch (PDOException $e) {
            Response::error($e->getMessage());
        }

        return self::$db;
    }

    public static function prepare($sql) {
        self::$stmt = self::$conn->prepare(trim($sql));
        return self::$db;
    }

    public static function bindValue($rows) {
        $type = function ($row) {
            switch (gettype($row)) {
                case 'integer':
                return PDO::PARAM_INT;
                break;

                case 'boolean':
                return PDO::PARAM_BOOL;
                break;

                case 'NULL':
                return PDO::PARAM_NULL;
                break;

                default:
                return PDO::PARAM_STR;
                break;
            }
        };

        foreach ($rows as $key => $row) {
            self::$stmt->bindValue(($key + 1), $row, $type($row));
        }

        return self::$db;
    }

    public static function execute() {
        try {
            self::$stmt->execute();
            return Response::success("Execution finished");
        } catch (PDOException $e) {
            return Response::error($e->getMessage());
        }
    }

    public static function fetch() {
        try {
            if (!self::$stmt->execute()) {
                Response::success("An unexpected error has occurred");
            }

            $request = self::$stmt->fetch();

            if (!$request) {
             Response::error("No data available");
         } else {
            return $request;
        }
    } catch (PDOException $e) {
        Response::error($e->getMessage());
    }
}

public function fetchAll() {
    try {
        if (!self::$stmt->execute()) {
         Response::error("An unexpected error has occurred");
     }

     $request = self::$stmt->fetchAll();

     if (!$request) {
        return Response::error("No data available");
    } else {
        return $request;
    }
} catch (PDOException $e) {
    return Response::error($e->getMessage());
}
}

public static function CreateJWT($id,$data){
    $date =time();
    $exp= $date +(60*60*24);
    $key="example_key";
    $token=array(
        "iat"=>$date ,
        "exp"=>$exp,
        "data"=>[
            "nombre"=>$id,
            "apellido"=>$data
        ]
    );
    $jwt= JWT::encode($token,$key,'HS256');

    $datos= (object) ["exp"=>$exp,"token"=>$jwt];

    return $datos;
}

public static function ValidateJWT( string $table,$token){

    try{

        $sql="SELECT * FROM $table WHERE token =?";

        $datos= DB::prepare($sql)->bindValue([$token])->fetch();

        if(time() < $datos->exp_token ){

           return Response::success("todavia sigue vigente el token",$datos->token);

       }else{

        return Response::error("no  sigue vigente todavia este token ",$datos->token);
    }

}catch (PDOException $e) {
    return Response::error($e->getMessage());

}

}


}
