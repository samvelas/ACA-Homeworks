
<head>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
</head>
<body onload="res()">
    <?php
        $curYear = date("Y");
        $curMonth = date("m");

        if(isset($_GET['year']) && isset($_GET['month'])){
            $curYear = $_GET['year'];
            $curMonth = $_GET['month'];
        }
        $date = $curYear . "-" . $curMonth . "-" . "01";
    ?>
    <div class="container">
        <h1>
            <?php
                echo date("F, Y", strtotime($date));
            ?>
        </h1>
        <div class="row">
            <div class="col-md-4">
                <ul id="nav" class="nav nav-pills nav-stacked">
                    <?php
                        for($i = 0; $i <= 12; $i++){
                                $expire = strtotime('first day of +' . $i . ' month');
                                if(date(("F, Y"), strtotime($date)) == date(("F, Y"), $expire)){
                                    $style = 'active';
                                }
                                echo '<li role="presentation"><a href="http://localhost/Homework_17/Calendar/index.php?year=' . date(("Y"), $expire) . '&month=' . date("m", $expire) . '" class="list-group-item ' . $style . '" >' . date(("F, Y"), $expire) . '</a></li>';
                                $style = '';
                        }
                    ?>
                </ul>
            </div>
            <div class="col-md-8">
                <table id="tab" class="table table-bordered">
                    <tr>
                        <th>Sunday</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                    </tr>
                    <?php

                        $curday = 1;
                        $nextMonth = 1;
                        $number = cal_days_in_month(CAL_GREGORIAN, $curMonth, $curYear);
                        for($k = 0; $k < 6; $k++){

                            echo '<tr>';
                            if($k == 0) {
                                $start = date('w', strtotime($date));;

                                for ($i = 0; $i < $start; $i++) {
                                    echo '<td style="color: lightgray; font-size: 18px;">' . ($i + 1) . '</td>';
                                }
                                for ($i = $start; $i < 7; $i++){
                                    if($curMonth == date("m") && $curday + 1 == date("d")){
                                        echo '<td style="color: lightseagreen; background-color: greenyellow">';
                                        echo $curday++;
                                        echo '</td>';
                                    } else {
                                        echo '<td style="color: white;">';
                                        echo $curday++;
                                        echo '</td>';
                                    }
                                }
                            } else {
                                for($j = 0; $j < 7; $j++){
                                    if($curday <= $number) {
                                        if($curMonth == date("m") && $curday == date("d")){
                                            echo '<td style="color: lightseagreen; background-color: greenyellow">';
                                            echo $curday++;
                                            echo '</td>';
                                        } else {
                                            echo '<td style="color: white;">';
                                            echo $curday++;
                                            echo '</td>';
                                        }
                                    } else {
                                        echo '<td style="color: lightgray; font-size: 18px;">';
                                        echo $nextMonth++;
                                        echo '</td>';
                                        $isFinished = true;
                                    }

                                }
                            }

                            echo '</tr>';

                            if($isFinished){
                                break;
                            }
                        }
                    ?>
                </table>
            </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
