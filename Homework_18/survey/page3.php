<?php include "bootstrap.php"?>

<?php
session_start();
$_SESSION['per_day'] = $_POST['per_day'];
?>

<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading"><strong>Smoking Survey</strong> Question 3</div>
                <div class="panel-body">
                    <form method="post" action="result.php">
                        <label for="per_week">About how much do you spend, in U.S. dollars, on smoking in a typical week?</label>
                        <input class="form-control" name="per_week">
                        <button class="btn btn-info btn-md" type="submit" onclick="checkPerWeek()">Next</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="script.js"></script>
