<?php include "bootstrap.php"?>

<?php
session_start();
$_SESSION['per_week'] = $_POST['per_week'];
?>

<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading"><strong>Smoking Survey</strong></div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Start age</td>
                            <td><?php echo $_SESSION['age']?></td>
                        </tr>
                        <tr>
                            <td>Smoken cigarettes per day</td>
                            <td><?php echo $_SESSION['per_day']?></td>
                        </tr>
                        <tr>
                            <td>Spent money per week</td>
                            <td><?php echo $_SESSION['per_week']?></td>
                        </tr>
                    </table>
                    <h2>Thanks for completing survey. We will review your answers</h2>
                    <form action="index.php">
                        <button class="btn btn-lg btn-warning" type="submit">Start over</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

