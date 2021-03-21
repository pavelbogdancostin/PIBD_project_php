<?php

require_once "../config.php";

$sarcina = $dificultate = $idangajat = $idreview ="";
$sarcina_err = $dificultate_err = $idangajat_err = $idreview_err = "";

if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    
    $input = trim($_POST["sarcina"]);
    if(empty($input)){
        $sarcina_err = "Completati denumirea sarcinei.";
    } else{
        $sarcina = $input;
    }

    $input = trim($_POST["dificultate"]);
    if(empty($input)){
        $dificultate_err = "Completati dificultatea.";
    } else{
        $dificultate = $input;
    }
    $input = trim($_POST["idangajat"]);
    if(empty($input)){
        $idangajat_err = "Selectati angajatul.";
    } else{
        $idangajat = $input;
    }
    $input = trim($_POST["idreview"]);
    if(empty($input)){
        $idreview_err = "Selectati review.";
    } else{
        $idreview = $input;
    }

    if(empty($sarcina_err) && empty($dificultate_err)){
        $sql = "UPDATE sarcini SET sarcina=?, dificultate=?, idangajat=?, idreview=? WHERE idsarcina=?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssiii", $param_sarcina, $param_dificultate, $param_angajat, $param_review, $param_id);

            $param_sarcina = $sarcina;
            $param_dificultate = $dificultate;
            $param_angajat = $idangajat;
            $param_review = $idreview;
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            } else{
                echo "EROARE: Nu se poate executa $sql. " . mysqli_error($link);
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);
        
        $sql = "SELECT * FROM sarcini WHERE idsarcina = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_assoc($result);
                    
                    $sarcina = $row["sarcina"];
                    $dificultate = $row["dificultate"];
                    $idangajat = $row["idangajat"];
                    $idreview = $row["idreview"];

                } else{
                    header("location: ../eroare.php");
                    exit();
                }
                
            } else{
                echo "EROARE: Nu se poate executa $sql. " . mysqli_error($link);
            }
        }
        mysqli_stmt_close($stmt);
        //mysqli_close($link);
    }  else{
        header("location: ../eroare.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifica inregistrarea</title>
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
                        <h2>Modifica Inregistrarea</h2>
                    </div>
                    <p>Actualizeaza campurile si trimite pentru a modifica inregistrarea .</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($sarcina_err)) ? 'has-error' : ''; ?>">
                            <label>Sarcina</label>
                            <input name="sarcina" type="text" class="form-control" value="<?php echo $sarcina; ?>">
                            <span class="help-block"><?php echo $sarcina_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($dificultate_err)) ? 'has-error' : ''; ?>">
                            <label>Dificultate</label>
                            <input name="dificultate" type="text" class="form-control" value="<?php echo $dificultate; ?>">
                            <span class="help-block"><?php echo $dificultate_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($angajat_err)) ? 'has-error' : ''; ?>">
                            <label>Angajat</label>
                            <select name="idangajat" id="idangajat"/>
                            <option value="">Select Angajat</option>
                                <?php $s="select * from angajati";
                                $q=mysqli_query($link, $s) or die($s);
                                while($rw=mysqli_fetch_array($q))
                                { ?>
                                <option value="<?php echo $rw['idangajat']; ?>"<?php if($row['idangajat']==$rw['idangajat']) echo 'selected="selected"'; ?>><?php echo $rw['nume'].' '.$rw['prenume']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group <?php echo (!empty($review_err)) ? 'has-error' : ''; ?>">
                            <label>Review</label>
                            <select name="idreview" id="idreview"/>
                            <option value="">Select Review</option>
                                <?php $s="select * from reviewuri";
                                $q=mysqli_query($link, $s) or die($s);
                                while($rw=mysqli_fetch_array($q))
                                { ?>
                                <option value="<?php echo $rw['idreview']; ?>"<?php if($row['idreview']==$rw['idreview']) echo 'selected="selected"'; ?>><?php echo $rw['rating'].' '.$rw['comentariu']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Trimite">
                        <a href="index.php" class="btn btn-default">Renunta</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>