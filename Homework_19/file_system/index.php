<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <style>
            a {
                font-size: 18px !important;
            }
            ul {
                border: 1px solid cornflowerblue;
                border-radius: 15px;
                margin-top: 75px;
                max-height: 70% !important;
                overflow-y: auto;
                padding: 15px;
                padding-left: 20px;
            }
            li {
                border: 3px solid dodgerblue;
                padding: 4px 30px;
                border-radius: 9px;
                background-color: white;
            }
            h1 {
                text-align: center;
                margin-top: 30px;
                color: #5BC0DE;
                font-size: 50px;
            }
            .nav {
                padding-left: 20px;
                padding-right: 20px;
                background-color: #5BC0DE;
            }
            .form-control {
                display: inline-block !important;

            }
            #search {
                width: 80%;
            }
            #search-btn {
                width: 17%;
            }
            form {
                padding: 0;
                margin: 0;
            }
            #upload {
                text-align: center;
                padding: 30px 30%;
            }
            #upload-btn {
                margin-top: 10px;;
            }
            #file {
                font-size: 18px !important;
            }

            ::-webkit-scrollbar {
                width: 12px;
            }

            ::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb {
                border-radius: 10px;
                color: white;
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,10);
            }
        </style>
    </head>
    <body>
        <h1>FILE MANAGER</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <?php
                        define("ROOT_PATH", "/");
                        $path = ROOT_PATH;
                        if(isset($_GET['path'])){
                            $path = $_GET['path'];
                        }

                        if(isset($_GET['displayimage'])){
                            $img = $_GET['path'];
                            $img = "http://localhost" . $img;
                            echo '<img style="width: 100%; height: 300px" src="' . $img .'"></img>';
                        }

                        if(isset($_GET['search'])){
                            echo '<ul class="nav nav-pills nav-stacked">';
                            echo '<li>';
                            echo '<form action="index.php" method="get">
                                    <input id="search" class="form-control" name="search" placeholder="Search...">
                                    <button id="search-btn" class="btn btn-md btn-info" type="submit">Search</button>
                                 </form>';
                            echo '</li>';
                            echo '<li role="presentation">';
                            search();
                            echo '</li></ul>';
                        }

                        $file = fopen("link.txt", "w") or die("Can't open file");
                        fwrite($file, $path);
                        fclose($file);



                        if (!empty($_FILES["myFile"])) {
                            $file = fopen("link.txt", "r");
                            $read = fread($file);
                            fclose($file);
                            define("UPLOAD_DIR",  $read);
                            $myFile = $_FILES["myFile"];
                            var_dump(UPLOAD_DIR);
                            if ($myFile["error"] !== UPLOAD_ERR_OK) {
                                echo "<p>An error occurred.</p>";
                                exit;
                            }

                            // ensure a safe filename
                            $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

                            // don't overwrite an existing file
                            $i = 0;
                            $parts = pathinfo($name);
                            while (file_exists(UPLOAD_DIR . $name)) {
                                $i++;
                                $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
                            }

                            // preserve file from temporary directory
                            $success = move_uploaded_file($myFile["tmp_name"],
                                UPLOAD_DIR . $name);
                            if (!$success) {
                                echo "<p>Unable to save file.</p>";
                                exit;
                            }

                            // set proper permissions on the new file
                            chmod(UPLOAD_DIR . $name, 0644);
                        }
                    


                        $result = scandir($path);
                        unset($result[array_search(".", $result)]);

                        echo '<ul class="nav nav-pills nav-stacked">';

                        echo '<li>';
                        echo '<form action="index.php" method="get">
                                <input id="search" class="form-control" name="search" placeholder="Search...">
                                <button id="search-btn" class="btn btn-md btn-info" type="submit">Search</button>
                             </form>';
                        echo '</li>';
                        foreach($result as $index => $key){
                            echo '<li role="presentation">';
                            $info = new SplFileInfo($path . $key);
                            $ext = $info->getExtension();

                            if($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "bmp"){
                                echo '<div>
                                        <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                                        <a href="http://localhost/Homework_19/file_system/?displayimage=true&' . "path=" . $path . $key . '" class="btn btn-md">' . ($key) . '</a>
                                    </div>';
                            } else if(is_dir($path . $key)) {
                                if($key == "..") {
                                    echo '<div>
                                        <span class="glyphicon glyphicon glyphicon-level-up" aria-hidden="true"></span>
                                        <a class="btn btn-md" href="http://localhost/Homework_19/file_system?path=' . $path . $key . "/" . '">' . ($key) . '</a>
                                    </div>';
                                } else {
                                    echo '<div>
                                        <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                                        <a class="btn btn-md" href="http://localhost/Homework_19/file_system?path=' . $path . $key . "/" . '">' . ($key) . '</a>
                                    </div>';
                                }
                            } else {
                                echo '<div>
                                        <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                        <span id="file" class="btn btn-md">' . $key . '</span>
                                    </div>';
                            }
                            echo '</li>';
                        }

                        echo '</ul>';
                        echo
                           '<form id="upload" action="index.php?path=' . $path . '" enctype="multipart/form-data" method="post">
                                <input class="form-control" type="file" name="myFile">
                                <button id="upload-btn" class="btn btn-info btn-md" type="submit">Upload</button>
                            </form>'
                    ?>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </body>
</html>


<?php
            function search($path = '""'){
                $searchFileName = $_GET["search"];
                define ("SEARCH_NAME", $searchFileName);
                define("ROOT_PATH", "/var/www/html/");

                if($path == '""'){
                    $path = ROOT_PATH;
                }

                $scan = scandir($path);
                $dot = array_search('.', $scan);
                $twodot = array_search('..', $scan);

                unset($scan[$dot]);
                unset($scan[$twodot]);
                foreach ($scan as $index => $item) {
                    if (strpos($item, SEARCH_NAME) !== false){
                        echo '<a href = "index.php?path='. $path . $item . "/".'">';
                        echo $path . $item . "/";
                        echo '</a>';
                    }
                    if (is_dir($path . $item . "/")) {
                        search($path . $item . "/");
                    }
                }
            }
?>