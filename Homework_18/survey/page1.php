<?php include "bootstrap.php"?>

<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading"><strong>Smoking Survey</strong> Question 1</div>
                <div class="panel-body">
                    <form method="post" action="page2.php">
                        <label for="age">At what age did you start smoking?</label>
                        <input class="form-control" name="age">
                        <button class="btn btn-info btn-md" type="submit" onclick="checkAge()">Next</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="script.js"></script>
