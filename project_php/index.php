<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tabela Salariati</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" href="main.css">
    <style type="text/css">
        .page-header h2{ margin-top: 0; }
        table tr td:last-child a{margin-right: 15px;}
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
            <li><a href="./"><strong>Home</strong></a> </li>
            <li><a href="angajati"><strong>Angajati</strong></a> </li>
            <li><a href="reviewuri"><strong>Reviewuri</strong></a> </li>
            <li><a href="sarcini"><strong>Sarcini</strong></a> </li>
        </ul>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Angajati</h2>
                        <a href="angajati/" class="btn btn-success pull-right">Angajati</a>
                    </div>
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Reviewuri</h2>
                        <a href="reviewuri/" class="btn btn-success pull-right">Reviewuri</a>
                    </div>
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Sarcini</h2>
                        <a href="sarcini/" class="btn btn-success pull-right">Sarcini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>