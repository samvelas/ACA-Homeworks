<?php include "bootstrap.php"?>

<?php
session_start();
$_SESSION['age'] = $_POST['age'];
?>

<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading"><strong>Smoking Survey</strong> Question 2</div>
                <div class="panel-body">
                    <form method="post" action="page3.php">
                        <label for="per_day">About how many cigarettes do you smoke in a typical day?</label>
                        <input class="form-control" name="per_day">
                        <button class="btn btn-info btn-md" type="submit" onclick="checkPerDay()">Next</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="script.js"></script>