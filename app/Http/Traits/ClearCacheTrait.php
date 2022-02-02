<?php 

namespace App\Http\Traits;

trait ClearCacheTrait {

    
    public static function clearAbraaCache($table){
        $ch = curl_init();
        $url = "https://www.abraa.com/ajax.php?do=update_cache&tables=" . $table;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);

        return true;
    }

}

?>