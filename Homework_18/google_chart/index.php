<html>
    <head>
        <link href="main.css" rel="stylesheet">
        <?php
            $file = "lorem.txt";
            if(isset($_GET['text']) && $_GET['text'] != ''){
                $temp = $_GET['text'];
                $f = fopen("custom.txt", "w");
                fwrite($f, $temp);
                fclose($f);
                $file = "custom.txt";
            }
        ?>



        <?php
            $text = file_get_contents($file);
            $text = strtolower($text);
            $myArray = [];
            for($i = 0; $i < strlen($text); $i++){
                $myArray[$text[$i]]++;
            }
            arsort($myArray);
        ?>



        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {

                var data = google.visualization.arrayToDataTable([

                    <?php
                        $i = 0;
                        echo '["Word", "count"], ';
                        foreach($myArray as $key => $value){
                            if($i <= 5) {
                                if (ctype_alpha($key)) {
                                    echo "[";
                                    echo "'" . $key . "', " . $value;
                                    echo "], ";
                                }
                                $i++;
                            }
                        }
                    ?>
                ]);

                var options = {
                    title: 'Letters count in text'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
            }
        </script>
        <?php

        $text = file_get_contents($file);
        $text = strtolower($text);
        $words = str_word_count($text, 1);
        $myArray = [];
        foreach($words as $k => $v){
            $myArray[strlen($v)]++;
        }
        arsort($myArray);
        ?>
        <script type="text/javascript">
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {

                var data = google.visualization.arrayToDataTable([

                    <?php
                    echo '["Letter", "count"], ';
                    $i = 0;
                    foreach($myArray as $key => $value){
                        if($i < 5) {
                            echo "['" . $key . "', " . $value . "], ";
                            $i++;
                        }
                    }
                    ?>
                ]);

                var options = {
                    title: 'Words count in text'
                };

                var chart = new google.visualization.PieChart(document.getElementById('pie1chart'));

                chart.draw(data, options);
            }
        </script>
    </head>

    <body>
        <div id="chartContainer">
            <div id="piechart"></div>
            <div id="pie1chart"></div>
        </div>
        <form action="index.php">
            <h1>Or write your custom text</h1>
            <textarea placeholder="Custom text (Note! if you leave it blank, page will work on it's default text)" name="text"></textarea>
            <br>
            <button type="submit">Submit</button>
        </form>

    </body>
</html>