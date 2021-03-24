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

    function getWeather() {

        include 'db_config.php';

        date_default_timezone_set("Europe/Moscow");
        $currentDate = date("Y-m-d H:i:s");

        $curlInitialize = curl_init();
        curl_setopt($curlInitialize, CURLOPT_URL, "http://api.openweathermap.org/data/2.5/weather?q=Yerevan&appid=9638c0cc9efbbfc00e4493a1effc4199&units=metric");
        curl_setopt($curlInitialize, CURLOPT_RETURNTRANSFER, true);

        $sql = "SELECT city_name, temperature ,weatherTime FROM weather_data";
        $runQuery = $conn->query($sql);

        if($runQuery->num_rows == 0) {
            $result = curl_exec($curlInitialize);
            curl_close($curlInitialize);
            $weather_data = json_decode($result);
            $city =  $weather_data->name;
            $temp = $weather_data->main->temp;
            $query = "INSERT INTO weather_data (city_name, temperature, weatherTime)
                            VALUES ('$city', $temp, '$currentDate')";
            
            if(!$conn->query($query)) {
                echo "Database error";
                exit;
            }
        }

        else {
            $row = $runQuery->fetch_assoc();
            $time = $row['weatherTime'];
            $dbTime = strtotime($time);
            if (time() - $dbTime > 1800) {
                $result = curl_exec($curlInitialize);
                curl_close($curlInitialize);
                $weather_data = json_decode($result);
                $updatedTemp = $weather_data->main->temp;
                $queryUpdate = "UPDATE weather_data SET weatherTime = CURRENT_TIME(), temperature = $updatedTemp
                                WHERE (CURRENT_TIME() - weatherTime > 1800)";
                
                if(!$conn->query($queryUpdate)) {
                    echo "Database error";
                    exit;
                }
            }
            
        }

        $conn->query($sql);
        $row = $conn->query($sql)->fetch_assoc();
        return $row;
    }