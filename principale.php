<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		
        <!-- importer le fichier de style -->
		
        <link rel="stylesheet" href="Style.css" media="screen" type="text/css" />
    </head>
    <body style='background:#fff;'>
        <div id="content">
            
            <a href='principale.php?deconnexion=true'><span>Déconnexion</span></a>
            
            <!-- tester si l'utilisateur est connecté -->
            <?php
                session_start();
                if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                      session_unset();
                      header("location:login.php");
                   }
                }
                else if($_SESSION['User_Name'] !== ""){
                    $user = $_SESSION['User_Name'];
                    // afficher un message
                    echo "<br>Bonjour $user, vous êtes connectés";
                }
            ?>
            
        </div>
    </body>
</html>