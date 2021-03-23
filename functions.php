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

        $curlInitialize = curl_init();
        curl_setopt($curlInitialize, CURLOPT_URL, "http://api.openweathermap.org/data/2.5/weather?q=Yerevan&appid=9638c0cc9efbbfc00e4493a1effc4199&units=metric");
        curl_setopt($curlInitialize, CURLOPT_RETURNTRANSFER, true);

        date_default_timezone_set("Europe/Moscow");
        $currentDate = date("Y-m-d H:i:s");

        $sql = "SELECT weatherTime FROM weather_data";
        $runQuery = $conn->query($sql);
        $row = $runQuery->fetch_assoc();

        if($row['weatherTime'] == NULL) {
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
            $dbdate = $row['weatherTime'];
            $dbtimestamp = strtotime($dbdate);
            if (time() - $dbtimestamp > 30 * 60) {
                $result = curl_exec($curlInitialize);
                curl_close($curlInitialize);
                $weather_data = json_decode($result);
                $updatedTemp = $weather_data->main->temp;
                $queryUpdate = "UPDATE weather_data
                                    SET weatherTime = '$currentDate', temperature = $updatedTemp";
                
                if(!$conn->query($queryUpdate)) {
                    echo "Database error";
                    exit;
                }
            }
        }

        $finalQuery = "SELECT city_name, temperature FROM weather_data";

        $runQueryFinal = $conn->query($finalQuery);
        if (!$runQueryFinal) {
            echo "Database error";
            exit;
        }

        $rowFinal = $runQueryFinal->fetch_assoc();
        $_SESSION['cityName'] = $rowFinal['city_name'];
        $_SESSION['tempCelsius'] = $rowFinal['temperature'];
    }