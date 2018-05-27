<!DOCTYPE html>
<html>

<head>

       <meta http-equiv="Content_type" content="text/html; charset=utf-8"/>

		<link rel="stylesheet" href="style.css">
<title>Inscription</title>

</head>

<body background="books.jpg" style="background-attachment: fixed">

                <?php

                include_once "function.php";

                /*

    *Initialisation des variables

    */

    $message="";

    $button="";

    $codeuser="";

    $nom="";

    $prenom="";

    $email="";

    $mot_de_passe="";

    $mot_de_passe1="";

    /*

    *Interception de la requete POST

    */

    if($_SERVER['REQUEST_METHOD'] === "POST"){

                $button=$_POST['submit'];

                $codeuser=$_POST['codeuser'];

                $nom=$_POST['nom'];

                $prenom=$_POST['prenom'];

                $email=$_POST['email'];

                $mot_de_passe=$_POST['mot_de_passe'];

                $mot_de_passe1=$_POST['mot_de_passe1'];

                if($button=="Envoyer"){

                               if($mot_de_passe==$mot_de_passe1){

                                               if(ComplexiteMotDePasse($mot_de_passe)){

                                                                /*

                     *Connexion a la base de données

                     */

                     $conn=connecttoDB();

                     $mot_de_passe= crypt ($mot_de_passe,' ');

                     $sql= "INSERT INTO user VALUES ('$codeuser','$nom','$prenom','$email','$mot_de_passe','A')";

                     /*

                     *Envoi de la requete sql a la base de données

                     */

                     if($conn->query($sql)===TRUE){?>

                     <b>Votre inscription a eu lieu avec succés !</b>

                     <br>

                     <br>

                     <a href="index.php">Connexion</a>

                     <?php

                     die;

 

 

                     }else{

                               $message="Erreur:".$conn->error;

                     }

                     /*

                     *Fermeture de la connexion a la base de données

                     */

                     $conn->close();

 

                                               }else{

                                                               $message="Le mot de passe est trop simple!";

                                               }

                               }else{

                                               $message="Confirmation de mot de passe incorrecte!";

                               }

                }

    }

    ?>

    <form method="post" action="inscription.php" class="container">
                 
                <table>

                               <tr>

                                               <td>Choisissez un identifiant:</td>

                                               <td><input type="text" name="codeuser" size="15" value=<?php echo $codeuser?>></td>

                               </tr>

                               <tr>

 

                                               <td>Nom:</td>

                                               <td><input type="text" name="nom" size="30" value=<?php echo $nom?>></td>

                                              

                               </tr>

                               <tr>

                                               <td>Prenom:</td>

                                               <td><input type="text" name="prenom" size="30" value=<?php echo $prenom?>></td>

                               </tr>

                               <tr>

                                               <td>Mail:</td>

                                               <td><input type="text" name="email" size="30" value=<?php echo $email?>></td>

                               </tr>

                               <tr>

                                               <td>Mot de passe:</td>

                                               <td><input type="password" name="mot_de_passe" size="20" ></td>

                               </tr>

                               <tr>

                                               <td>Confirmation mot de passe:</td>

                                               <td><input type="password" name="mot_de_passe1" size="20" ></td>

                               </tr>
                            
                </table>

    </br></br>

    <input type="submit" name="submit" velue="Envoyer"/>

</form>

 </br></br>

 <b><?php if ($message!="") echo $message; ?></b>

</body>

</html>

