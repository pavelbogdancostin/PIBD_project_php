<?php

if(isset($_GET["id"])){
    if(!empty(trim($_GET["id"]))){
        require_once "../config.php";
        
        $sql = "SELECT * FROM sarcini WHERE idsarcina = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            $param_id = trim($_GET["id"]);
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
        
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    $sarcina = $row["sarcina"];
                    $dificultate = $row["dificultate"];

                    $stmt = mysqli_prepare($link, "select * from angajati where idangajat = ?");
                    mysqli_stmt_bind_param($stmt, "i", $row["idangajat"]);
                    mysqli_stmt_execute($stmt);
                    $res = mysqli_stmt_get_result($stmt);
                    $a = mysqli_fetch_array($res, MYSQLI_ASSOC);

                    $stmt = mysqli_prepare($link, "select * from reviewuri where idreview = ?");
                    mysqli_stmt_bind_param($stmt, "i", $row["idreview"]);
                    mysqli_stmt_execute($stmt);
                    $res = mysqli_stmt_get_result($stmt);
                    $r = mysqli_fetch_array($res, MYSQLI_ASSOC);

                } else{
                    header("location: ../eroare.php");
                    exit();
                }
                
            } else{
                echo "EROARE: Nu se poate executa $sql. " . mysqli_error($link);
            }
        }
        
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    } else{
        header("location: ../eroare.php");
        exit();
    }
}

if(isset($_POST["id"])){
    if(!empty($_POST["id"])){
        require_once "../config.php";

        $sql = "DELETE FROM sarcini WHERE idsarcina = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            $param_id = trim($_POST["id"]);

            echo "id=", $param_id, "<BR>";
            
            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            } else{
                echo "EROARE: Nu se poate executa $sql. " . mysqli_error($link);
            }
        }
         
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    } else{
        if(empty(trim($_GET["id"]))){
            header("location: ../eroare.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sterge Inregistrarea</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../main.css">
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
                    <div class="page-header">
                        <h1>Sterge inregistrarea</h1>
                    </div>
                    <div class="form-group">
                        <label>Sarcina</label>
                        <p class="form-control-static"><?php echo $row["sarcina"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Dificultate</label>
                        <p class="form-control-static"><?php echo $row["dificultate"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Angajat</label>
                        <p class="form-control-static"><?php echo $a["nume"].' '.$a["prenume"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Review</label>
                        <p class="form-control-static"><?php echo $r["rating"].' '.$r["comentariu"]; ?></p>
                    </div>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Sunteti sigur ca doriti sa stergeti acesta sarcina ?</p><br>
                            <p>
                                <input type="submit" value="Da" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">Nu</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>