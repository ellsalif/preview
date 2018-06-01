
<html>
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="../Css/style1.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            
            <form action="verification.php" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="User_Name" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="Users_Password">

                <input type="submit" id='submit' value='LOGIN' >
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>
            </form>
        </div>
    </body>
</html>