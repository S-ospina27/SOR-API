<?php
namespace SRC\Helpers;

use SRC\Helpers\Response;

class Helpers{

    private static $request;
    private static $response;

    public function __construct(){
    }



    public static function init($request, $response) {
        self::$request = $request;
        self::$response = $response;
    }

    public static function exists($row, $message) {
        if (!isset(self::$request->$row)) {
            self::$response->finish(self::$response->error($message));
        }

        if (empty(self::$request->$row)) {
            self::$response->finish(self::$response->error($message));
        }
    }

    public static function optional($row, $message) {
        if (isset(self::$request->$row)) {
            if (empty(self::$request->$row)) {
                self::$response->finish(self::$response->error($message));
            }
        }
    }

    public static function isEmpty($row, $message) {
        if (empty($row)) {
            self::$response->finish(self::$response->error($message));
        }
    }




    public static function strClean($strCadena)
    {
        $string = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $strCadena);
        $string = trim($string);
        $string = stripslashes($string);
        $string = str_ireplace("<script>", "", $string);
        $string = str_ireplace("</script>", "", $string);
        $string = str_ireplace("<script src>", "", $string);
        $string = str_ireplace("<script type=>", "", $string);
        $string = str_ireplace("--", "", $string);
        $string = str_ireplace("^", "", $string);
        $string = str_ireplace("[", "", $string);
        $string = str_ireplace("]", "", $string);
        $string = str_ireplace("==", "", $string);
        return Response::success("funciono", $string);
    }

}

