<?php

if($curMonth == date("m") && $curday == date("d") && $curYear == date("Y")){
    echo '<td style="color: lightseagreen; background-color: greenyellow">';
    echo $curday++;
    echo '</td>';
} else {
    echo '<td style="color: white;">';
    echo $curday++;
    echo '</td>';
}