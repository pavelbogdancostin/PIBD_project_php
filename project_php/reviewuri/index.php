<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tabela Reviewuri</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../main.css">
    <style type="text/css">
        .page-header h2{ margin-top: 0; }
        table tr td:last-child a{ margin-right: 15px; }
    </style>

    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <ul>
            <li><a href="../"><strong>Home</strong></a> </li>
            <li><a href="../angajati"><strong>Angajati</strong></a> </li>
            <li><a href="../reviewuri"><strong>Reviewuri</strong></a> </li>
            <li><a href="../sarcini"><strong>Sarcini</strong></a> </li>
        </ul>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Reviewuri</h2>
                        <a href="adauga.php" class="btn btn-success pull-right">Adauga un review</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "../config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM reviewuri";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Rating</th>";
                                        echo "<th>Comentariu</th>";
                                        echo "<th>Data</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['idreview'] . "</td>";
                                        echo "<td>" . $row['rating'] . "</td>";
                                        echo "<td>" . $row['comentariu'] . "</td>";
                                        echo "<td>" . $row['data'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='modifica.php?id=". $row['idreview'] ."' title='Actualizeaza' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='sterge.php?id=". $row['idreview'] ."' title='Sterge' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>Nu avem inregistrari.</em></p>";
                        }
                    } else{
                        echo "EROARE: Nu se poate executa $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>