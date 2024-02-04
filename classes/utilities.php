<?php

    error_reporting(E_ALL);

    function sanitizer($evil_string){
        $cleaned = strip_tags($evil_string);
        $cleaned = trim($cleaned);
        $cleaned = htmlspecialchars($cleaned);

        return $cleaned;
    }

    class Utilities
    {
        public static function get_exercises()
        {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://exercises-by-api-ninjas.p.rapidapi.com/v1/exercises",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: exercises-by-api-ninjas.p.rapidapi.com",
                    "X-RapidAPI-Key: bd913c6290msh89a68d1c9a73890p19e685jsn73917d5e6eb1"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return json_decode($response);
            }
        }
    }

?>