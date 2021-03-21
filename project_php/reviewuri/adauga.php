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

    // Valideaza functie
    $input = trim($_POST["data"]);
    if(empty($input))
        $data_err = "Completati data.";
    else
        $data = $input;

    if(empty($rating_err) && empty($comentariu_err) && empty($data_err)){
        $sql = "INSERT INTO reviewuri (rating, comentariu, data) VALUES (?, ?, ?)";
    
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "iss", $param_rating, $param_comentariu, $param_data);

            $param_rating = $rating;
            $param_comentariu = $comentariu;
            $param_data = $data;

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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
        </ul>        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Adauga Inregistrare</h2>
                    </div>
                    <p>Completati datele pentru a adauga un review in baza de date.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($rating_err)) ? 'has-error' : ''; ?>">
                            <label>Rating</label>
                            <select name="rating">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option> 
                            </select>
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