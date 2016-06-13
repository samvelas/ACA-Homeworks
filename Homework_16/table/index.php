<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymo">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
</head>
<body>

<?php
define("ITEMS_PER_PAGE", 3);
$users = [];
$tempFile = fopen("info.txt", "r+") or die("Can't open file");
$tempArray = [];
while(!feof($tempFile)){ //while it's not file nd
    $line = fgets($tempFile);   //getting line
    $wordCount = str_word_count($line, 1); //getting massive with words in that line
    $tempArrayLine = [];
    $tempArrayLine['first'] = $wordCount[0];
    $tempArrayLine['last'] = $wordCount[1];
    $tempArrayLine['country'] = $wordCount[2];
    //creating line for new array
    array_push($users, $tempArrayLine);
    //pushing to final array}
}
$size= count($users);
fclose($tempFile);
$currentPage = 1;

if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
}

if (isset($_GET['del'])){
    $del = $_GET['del'];
    array_splice($users, $del, 1);
    $edit_file = fopen("info.txt", "w");
    $size--;
    for($i = 0; $i < $size; $i++) {
            $l = "\n" . $users[$i]['first'] . " " . $users[$i]['last'] . " " . $users[$i]['country'];

        fwrite($edit_file, $l);
    }
    fclose($edit_file);
}

if (isset($_GET['first']) && isset($_GET['last']) && isset($_GET['country'])) {
    $first = ($_GET['first']);
    $last = ($_GET['last']);
    $country = ($_GET['country']);
    $edit_file = fopen("info.txt", "a");
    $l = "\n" . $first . " " . $last . " " . $country;
    $size++;
    fwrite($edit_file, $l);
    fclose($edit_file);
}




$totalPageCount = ceil($size / ITEMS_PER_PAGE);

$start = ($currentPage - 1) * ITEMS_PER_PAGE + 1;
$limit = ITEMS_PER_PAGE;

if ($start + $limit > $size) {
    $limit = $size - $start;
}
?>
<div class="container">
    <div class=""row">
        <table class="table">
            <thead>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Country</th>
            <th>Delete</th>
            </thead>
            <tbody>
            <?php
            for ($i = $start; $i < $start + $limit; $i++) {
                echo "<tr>";
                echo "<td>" . $users[$i]["first"] . "</td>";
                echo "<td>" . $users[$i]["last"] . "</td>";
                echo "<td>" . $users[$i]["country"] . "</td>";
                echo '<td><a class="btn btn-danger" href="http://localhost/Homework_16/table/index.php?page=' . $currentPage . '&del=' . $i . '">Delete</a></td>';
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <nav>
            <ul class="pagination">
                <?php
                for ($i = 1; $i <= $totalPageCount; $i++) {
                    $style = '';
                    if ($i == $currentPage) {
                        $style = "active";
                    }

                    echo '<li class="' . $style . '"><a href="http://localhost/Homework_16/table/index.php?page=' . $i . '">' . $i . '</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
    <div class="row">
        <form action="index.php">
            <input class="form-control" name="first" placeholder="First Name">
            <input class="form-control" name="last" placeholder="Last Name">
            <input class="form-control" name="country" placeholder="Country">
            <br>
            <button class="btn btn-info btn-lg" type="submit">Add</button>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


</body>
</html>