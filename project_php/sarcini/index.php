<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tabela Salariati</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../main.css">
    <style type="text/css">
        .page-header h2{ margin-top: 0 }
        table tr td:last-child a{ margin-right: 15px }
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
                        <h2 class="pull-left">Sarcini</h2>
                        <a href="adauga.php" class="btn btn-success pull-right">Adauga o sarcina</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "../config.php";
                    
                    //$sql = "SELECT * FROM sarcini";
                    //$sql = "SELECT a.Nume NumeAngajat, a.Prenume PrenumeAngajat, a.Functie FunctieAngajat, a.Experienta,a.Salariu, b.Rating, b.Comentariu ComentariuReview, b.data, c.idsarcina,c.idreview idreview_sarcina, c.idangajat idangajat_sarcina,c.Sarcina,c.Dificultate FROM angajati a,reviewuri b,sarcini c WHERE a.idangajat = c.idangajat AND b.idreview = c.idreview;"

                    $sql = "SELECT c.idsarcina,c.sarcina,c.dificultate,a.nume,a.prenume,b.rating,b.comentariu FROM angajati a,reviewuri b,sarcini c  WHERE a.idangajat = c.idangajat AND b.idreview = c.idreview";

                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Sarcina</th>";
                                        echo "<th>Dificultate</th>";
                                        echo "<th>Angajat</th>";
                                        echo "<th>*</th>";
                                        echo "<th>Review</th>";
                                        echo "<th>Actiune</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['idsarcina'] . "</td>";
                                        echo "<td>" . $row['sarcina'] . "</td>";
                                        echo "<td>" . $row['dificultate'] . "</td>";
                                        echo "<td>" . $row['nume'] .' '. $row['prenume'] . "</td>";
                                        echo "<td>" . $row['rating'] . "</td>";
                                        echo "<td>" . $row['comentariu'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='modifica.php?id=". $row['idsarcina'] ."' title='Actualizeaza' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                        echo "<a href='sterge.php?id=". $row['idsarcina'] ."' title='Sterge' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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