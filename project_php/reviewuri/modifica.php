<?php
require_once "../config.php";
 
$rating = $comentariu = $data = "";
$rating_err = $comentariu_err = $data_err = "";
 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    $input = trim($_POST["rating"]);
    if(empty($input))
        $rating_err = "Selectati ratingul";
    else
        $rating = $input;

    $input = trim($_POST["comentariu"]);
    if(empty($input))
        $comentariu_err = "Completati comentariul.";
    else
        $comentariu = $input;

    $input = trim($_POST["data"]);
    if(empty($input))
        $data_err = "Completati data.";
    else
        $data = $input;

    if(empty($rating_err) && empty($comentariu_err) && empty($data_err)){
        $sql = "UPDATE reviewuri SET rating=?, comentariu=?, data=? WHERE idreview=?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "issi", $param_rating, $param_comentariu, $param_data, $param_id);

            $param_rating = $rating;
            $param_comentariu = $comentariu;
            $param_data = $data;
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
        $sql = "SELECT * FROM reviewuri WHERE idreview = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    $rating = $row["rating"];
                    $comentariu = $row["comentariu"];
                    $data = $row["data"];
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
                        <div class="form-group <?php echo (!empty($rating_err)) ? 'has-error' : ''; ?>">
                            <label>Rating</label>
                            <input name="rating" type="text" class="form-control" value="<?php echo $rating; ?>">
                            <span class="help-block"><?php echo $rating_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($comentariu_err)) ? 'has-error' : ''; ?>">
                            <label>Comentariu</label>
                            <input name="comentariu" type="text" class="form-control" value="<?php echo $comentariu; ?>">
                            <span class="help-block"><?php echo $comentariu_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($data_err)) ? 'has-error' : ''; ?>">
                            <label>Data</label>
                            <textarea name="data" class="form-control"><?php echo $data; ?></textarea>
                            <span class="help-block"><?php echo $data_err;?></span>
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