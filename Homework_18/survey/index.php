<?php
    include "bootstrap.php";
    session_destroy();
?>

<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading"><strong>Smoking Survey</strong></div>
                <div class="panel-body">
                    <form method="post" action="page1.php">
                        <h2>This is survey which collects details from smokers. Please complete this survey if you are smoking.</h2>
                        <button class="btn btn-lg btn-warning" type="submit">Start survey!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
