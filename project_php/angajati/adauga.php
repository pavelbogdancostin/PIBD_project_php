<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$nume = $prenume = $functie = $experienta = $salariu = "";
$nume_err = $prenume_err = $functie_err = $experienta_err = $salariu_err = "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Valideaza nume
    $input_name = trim($_POST["nume"]);
    if(empty($input_name)){
        $nume_err = "Completati numele.";
    //} elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]$/")))){
    //    $nume_err = "Completati un nume corect.";
    } else{
        $nume = $input_name;
    }

    // Valideaza prenume
    $input_name = trim($_POST["prenume"]);
    if(empty($input_name)){
        $prenume_err = "Completati prenumele.";
    //} elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]$/")))){
    //    $prenume_err = "Completati un prenume corect.";
    } else{
        $prenume = $input_name;
    }

    // Valideaza functie
    $input = trim($_POST["functie"]);
    if(empty($input)){
        $functie_err = "Completati functia.";
    //} elseif(!filter_var($input, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]$/")))){
    //    $functie_err = "Completati o functie corecta.";
    } else{
        $functie = $input;
    }
    
    $input = trim($_POST["experienta"]);
    if(empty($input)){
        $experinta_err = "Cmpletati experienta.";
    } else{
        $experienta = $input;
    }
    
    // Validate salary
    $input = trim($_POST["salariu"]);
    if(empty($input)){
        $salariu_err = "Completati salariul.";
    } elseif(!ctype_digit($input)){
        $salariu_err = "Salariul trebuie sa fie pozitiv.";
    } else{
        $salariu = $input;
    }

    if(empty($nume_err) && empty($prenume_err) && empty($salariu_err)){
        // Prepare an update statement
        $sql = "INSERT INTO angajati (nume, prenume, functie, experienta, salariu) VALUES (?, ?, ?, ?, ?)";
    
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssii", $param_nume, $param_prenume, $param_functie, $param_experienta, $param_salariu);

            // Set parameters
            $param_nume = $nume;
            $param_prenume = $prenume;
            $param_functie = $functie;
            $param_experienta = $experienta;
            $param_salariu = $salariu;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "EROARE: Nu se poate executa $sql. " . mysqli_error($link);
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adauga Angajat</title>
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
                        <h2>Adauga Angajat</h2>
                    </div>
                    <p>Completati datele pentru a adauga un angajat in baza de date.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nume_err)) ? 'has-error' : ''; ?>">
                            <label>Nume</label>
                            <input name="nume" type="text" class="form-control" value="<?php echo $nume; ?>">
                            <span class="help-block"><?php echo $nume_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($prenume_err)) ? 'has-error' : ''; ?>">
                            <label>Prenume</label>
                            <input name="prenume" type="text" class="form-control" value="<?php echo $prenume; ?>">
                            <span class="help-block"><?php echo $prenume_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($functie_err)) ? 'has-error' : ''; ?>">
                            <label>Functie</label>
                            <textarea name="functie" class="form-control"><?php echo $functie; ?></textarea>
                            <span class="help-block"><?php echo $functie_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($experienta_err)) ? 'has-error' : ''; ?>">
                            <label>Experienta</label>
                            <textarea name="experienta" class="form-control"><?php echo $experienta; ?></textarea>
                            <span class="help-block"><?php echo $experienta_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
                            <label>Salariu</label>
                            <input name="salariu" type="text" class="form-control" value="<?php echo $salariu; ?>">
                            <span class="help-block"><?php echo $salariu_err;?></span>
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