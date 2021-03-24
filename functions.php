<?php
    session_start();

    function setSession ($key, $val) {
        $_SESSION[$key] = $val;
    }

    function getSession($key) {
        if(isset($_SESSION[$key])) {
            echo $_SESSION[$key];
            unset($_SESSION[$key]);
        }
    }

    function initCurl () {
        $curlInitialize = curl_init();
        curl_setopt($curlInitialize, CURLOPT_URL, "http://api.openweathermap.org/data/2.5/weather?q=Yerevan&appid=9638c0cc9efbbfc00e4493a1effc4199&units=metric");
        curl_setopt($curlInitialize, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curlInitialize);
        curl_close($curlInitialize);
        $weather_data = json_decode($result);
        return $weather_data;
    }

    function getWeather() {

        include 'db_config.php';

        date_default_timezone_set("Asia/Yerevan");
        $currentDate = date("Y-m-d H:i:s");

        $sql = "SELECT city_name, temperature ,weatherTime FROM weather_data";
        
        $runQuery = $conn->query($sql);
        if($runQuery->num_rows == 0) {
            $weatherData = initCurl();
            $city =  $weatherData->name;
            $temp = $weatherData->main->temp;
            $query = "INSERT INTO weather_data (city_name, temperature, weatherTime)
                            VALUES ('$city', $temp, '$currentDate')";
            
            if(!$conn->query($query)) {
                echo "Database error";
                exit;
            }
            return ['temperature' => $temp, 'city_name' => $city];
        }

        else {
            $checkDate = "SELECT weatherTime FROM weather_data
                            WHERE CURRENT_TIMESTAMP() - weatherTime > 1800";
    
            $runTime = $conn->query($checkDate);
            $row = $runQuery->fetch_assoc();
            if ($runTime->num_rows == 1) {
                $weatherData = initCurl();
                $updatedCity =  $weatherData->name;
                $updatedTemp = $weatherData->main->temp;
                $queryUpdate = "UPDATE weather_data SET weatherTime = '$currentDate', temperature = $updatedTemp";
                
                if(!$conn->query($queryUpdate)) {
                    echo "Database error";
                    exit;
                }
                return ['temperature' => $updatedTemp, 'city_name' => $updatedCity];
            }
            else {
                return ['temperature' => $row['temperature'], 'city_name' => $row['city_name']];
            }
        }
    }