<?php

class Curl_func {
    

    function req($url, $fields = null, $headers = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if ($fields !== null) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }
        if ($headers !== null) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $result   = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return array(
            $result,
            $httpcode
        );
	}

    function request($url, $token = null, $data = null, $pin = null){
        // $id = mt_rand(10000,99999);
        // $header[] = "Host: api.gojekapi.com";
        // $header[] = "User-Agent: okhttp/3.10.0";
        // $header[] = "Accept: application/json";
        // $header[] = "Accept-Language: id-ID";
        // $header[] = "Content-Type: application/json; charset=UTF-8";
        // $header[] = "X-AppVersion: 3.30.2";
        // $header[] = "User-uuid: 6545".$id;
        // $header[] = "X-UniqueId: ".time()."57".mt_rand(1000,9999);
        // $header[] = "Connection: keep-alive";
        // $header[] = "X-User-Locale: id_ID";
        // $header[] = "X-Location: -6.917464,107.619122";
        // $header[] = "X-Location-Accuracy: 3.0";
        // if ($pin):
        // $header[] = "pin: $pin";
        //     endif;
        // if ($token):
        // $header[] = "Authorization: Bearer $token";
        // endif;
        $c = curl_init($url);
            curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
            if ($data):
            curl_setopt($c, CURLOPT_POSTFIELDS, $data);
            curl_setopt($c, CURLOPT_POST, true);
            endif;
            curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($c, CURLOPT_HEADER, true);
            // curl_setopt($c, CURLOPT_HTTPHEADER, $header);
            $response = curl_exec($c);
            $httpcode = curl_getinfo($c);
            if (!$httpcode)
                return false;
            else {
                $header = substr($response, 0, curl_getinfo($c, CURLINFO_HEADER_SIZE));
                $body   = substr($response, curl_getinfo($c, CURLINFO_HEADER_SIZE));
            }
            $json = json_decode($body, true);
            return $json;
        }
        
        function color($color = "default" , $text)
            {
                $arrayColor = array(
                    'grey'      => '1;30',
                    'red'       => '1;31',
                    'green'     => '1;32',
                    'yellow'    => '1;33',
                    'blue'      => '1;34',
                    'purple'    => '1;35',
                    'nevy'      => '1;36',
                    'white'     => '1;0',
                );  
                return "\033[".$arrayColor[$color]."m".$text."\033[0m";
            }
            function nama()
            {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $ex = curl_exec($ch);
            // $rand = json_decode($rnd_get, true);
            preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
            return $name[2][mt_rand(0, 14) ];
            }
}

?>
