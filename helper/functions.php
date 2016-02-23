<?php

// http://www.newadoringdress.com/plus-size-wedding-dresses.html
function getDomain($url){
    $pattern = "#^((http|https)://(www.)?)(?)([^/]+)#i";
    preg_match($pattern,$url,$matches);
    return $matches[4];
}

function getSiteName($domain){
    $_arr = explode('.',$domain);
    if(count($_arr) == 2){
        return $_arr[0];
    }else{
        return false;
    }
}

 // http://www.newadoringdress.com/plus-size-wedding-dresses.html
function getUri($url){
    $pattern = "#(.*)/(.*)(.html|.htm|/)#i";
    preg_match($pattern,$url,$matches);
    if(isset($matches[2])){
        return $matches[2];
    }
    return false;
}

// Exquisito-mangas-blusa-acanalada-gasa-falda-con-abalorios-correas-y-cintura-pZP_311773.html
function getSn($path){
    $pattern = "/(.*)-p(.*)\.(html|htm)/i";
    preg_match($pattern,$path,$matches);

    if(isset($matches[2])){
        return $matches[2];
    }
    return false;
}

// for test
//var_dump(getSn('Exquisito-mangas-blusa-acanalada-gasa-falda-con-abalorios-correas-y-cintura-pZP_311773.html'));