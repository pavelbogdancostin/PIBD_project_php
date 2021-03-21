<?php

echo "GET[id]=", $_GET["id"], ", POST[id]=", $_POST["id"], "<BR>";

if(isset($_GET["id"])){
    if(!empty(trim($_GET["id"]))){
        require_once "../config.php";
        
        $sql = "SELECT * FROM angajati WHERE idangajat = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            $param_id = trim($_GET["id"]);
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
        
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    $nume = $row["nume"];
                    $prenume = $row["prenume"];
                    $functie = $row["functie"];
                    $experienta = $row["experienta"];
                    $salariu = $row["salariu"];
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
        // Include config file
        require_once "../config.php";

        // Prepare a delete statement
        $sql = "DELETE FROM angajati WHERE idangajat = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = trim($_POST["id"]);

            echo "id=", $param_id, "<BR>";
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records deleted successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "EROARE: Nu se poate executa $sql. " . mysqli_error($link);
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    } else{
        // Check existence of id parameter
        if(empty(trim($_GET["id"]))){
            // URL doesn't contain id parameter. Redirect to error page
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
                        <label>Nume</label>
                        <p class="form-control-static"><?php echo $row["nume"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Prenume</label>
                        <p class="form-control-static"><?php echo $row["prenume"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Functie</label>
                        <p class="form-control-static"><?php echo $row["functie"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Experienta</label>
                        <p class="form-control-static"><?php echo $row["experienta"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Salariu</label>
                        <p class="form-control-static"><?php echo $row["salariu"]; ?></p>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Sunteti sigur ca doriti sa stergeti acest angajat ?</p><br>
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