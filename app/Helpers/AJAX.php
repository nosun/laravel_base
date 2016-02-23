<?php

namespace App\Helpers;

define('AJAX_SUCCESS', '200');
define('AJAX_INFO', '201');
define('AJAX_DATA_END','202');
define('AJAX_ARGUMENT_ERROR', '400');
define('AJAX_SIGN_FAIL', '401');
define('AJAX_TOKEN_FAIL', '402');
define('AJAX_FORBIDDEN', '403');
define('AJAX_DATA_EMPTY','404');
define('AJAX_AJAX_SIGN_FAIL','400');
define('AJAX_ROLE_ERROR', '406');
define('AJAX_SERVER_ERROR','500');
define('AJAX_CUSTOM', '999');

class AJAX
{
    public static function ajaxResponse($code, $data = array(), $allow_cross = false)
    {
        $out = array (
            'code' => $code
        );
        if (!empty($data)) {
            $out['result'] = $data;
        }

        if ($allow_cross || config('app.debug')) {
            return response()->json($out)->header('Access-Control-Allow-Origin', '*');
        }else{
            return response()->json($out);
        }
    }

    public static function argumentError($allow_cross = false)
    {
        return AJAX::ajaxResponse(AJAX_ARGUMENT_ERROR, $allow_cross);
    }

    public static function tokenFail($allow_cross = false)
    {
        return AJAX::ajaxResponse(AJAX_TOKEN_FAIL, $allow_cross);
    }

    public static function signatureFail($allow_cross = false)
    {
        return AJAX::ajaxResponse(AJAX_SIGN_FAIL, $allow_cross);
    }

    public static function forbidden($allow_cross = false)
    {
        return AJAX::ajaxResponse(AJAX_FORBIDDEN, $allow_cross);
    }

    public static function notExist($allow_cross = false)
    {
        return AJAX::ajaxResponse(AJAX_DATA_EMPTY,$allow_cross);
    }

    public static function success($data = array(), $allow_cross = false)
    {
        return AJAX::ajaxResponse(AJAX_SUCCESS, $data, $allow_cross);
    }

    public static function serverError($allow_cross = false)
    {
        return AJAX::ajaxResponse(AJAX_SERVER_ERROR, $allow_cross);
    }


    public static function roleError($allow_cross = false)
    {
        return AJAX::ajaxResponse(AJAX_ROLE_ERROR, $allow_cross);
    }

    public static function info($msg, $allow_cross = false)
    {
        return AJAX::ajaxResponse(AJAX_INFO, array('msg'=>$msg), $allow_cross);
    }

    public static function custom($data, $allow_cross = false)
    {
        return AJAX::ajaxResponse(AJAX_CUSTOM, $data, $allow_cross);
    }

    public static function dataEnd($data, $allow_cross = false)
    {
        return AJAX::ajaxResponse(AJAX_DATA_END,$data,$allow_cross);
    }

    public static function set_header(){
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-type: application/json');
    }

}