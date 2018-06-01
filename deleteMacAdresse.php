<?php
  
  require '../database/database.php';
  
   if(!empty($_GET['Mac_Adressse_Id'])) 
    {
        $Mac_Adressse_Id	= checkInput($_GET['Mac_Adressse_Id']);
    }

    if(!empty($_POST)) 
    {
        $Mac_Adressse_Id= checkInput($_POST['Mac_Adressse_Id']);
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM mac_adressse WHERE Mac_Adressse_Id = ?");
		
        $statement->execute(array($Mac_Adressse_Id));
        Database::disconnect();

 echo "\nPDOStatement::errorInfo():\n";
            $arr = $statement->errorInfo();
             print_r($arr);
       header("Location: macAdresse.php"); 
    }

    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Preview</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../Css/style.css">
    </head>
    
    <body>
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span> Admin Mac Adresse Preview <span class="glyphicon glyphicon-wrench"></span></h1>
         <div class="container admin">
            <div class="row">
                <h1><strong>Supprimer une Adresse Mac</strong></h1>
                <br>
                <form class="form" action="deleteMacAdresse.php" role="form" method="post">
                    <input type="hidden" name="Mac_Adressse_Id" value="<?php echo $Mac_Adressse_Id;?>"/>
                    <p class="alert alert-warning">Etes vous sur de vouloir Cette Adresse ?</p>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-warning">Oui</button>
                      <a class="btn btn-default" href="macAdresse.php">Non</a>
                    </div>
                </form>
            </div>
        </div>   
    </body>
</html>