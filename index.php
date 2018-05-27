<?php

include_once"function.php";
session_start();

$message = "";

    //Interception de la requete POST

         if ($_SERVER['REQUEST_METHOD'] === "POST")
        {

          $code = addslashes($_POST['code']);

            $mot_de_passe = addslashes($_POST['mot_de_passe']);

        if($code && $mot_de_passe)
        {

        //Connexion a la base de données

         $conn = connecttoDB();

         $sql = " SELECT mot_de_passe,status FROM user WHERE codeuser = '".$code."'";

        //Envoie de la requete sql a la base de données

         $result = $conn -> query ($sql);

         $row = $result -> fetch_assoc();

        if ($result -> num_rows == 1)
        {

        if (crypt ($mot_de_passe, $row['mot_de_passe']) == $row['mot_de_passe'])
        {

        if ($code != 'admin' AND $row['statut'] == 'D')
             {

                $message ="Accés refusé . Veuillez contacter la librairie !";

            }else{

                    $_SESSION['user'] =$code;

                    header('titres_disponibles.php');

                }

            }else{

                    $message= "Mot de passe incorrect !";

                }

            }else{

                    $message= "Code incorrect !";

                 }

     //Fermeture de la connexion a la base de données


            $conn->close();



        }
      }

?>

<html>
<meta charset="utf-8">
		<link rel="stylesheet" href="style.css">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Login</title>

</head>

<body background="images/books.jpg" style="background-attachment: fixed">
<h1 align="center"> Bienvenue sur la bibliotheque  </h1>
             <div class="container">
                 <img src="imges/login.png"/>
                <form method="post" action="">

                               <br>Code:

                               <br><input type="text" name="code" size="20" title="Entrez votre code" />

                               <br>

                               <br>Mot de passe:

                               <br><input type="password" name="mot_de_passe" title="Entrez votre mot de passe" />

                               <br>

                               <br><input type="submit" name="Submit" value="Login" />

                               <br>

                               <br>

                               <a

                               href="inscription.php">Inscription</a>&nbsp;&nbsp;&nbsp;

        <a href="password.php">Mot de passe oublié?</a>
          </div>
    </form>

    <br>

    <b><?php if ($message != "") echo $message; ?> </b>

 

</body>

</html>

 
