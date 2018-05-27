<!-- ../admin/ajouter_livre.php -->
<html>
<head>
	<meta http-equiv="Content_Type" content="text/html; charset=utf-8"/>
	<title>bibliotheque d' universite batna2</title>
</head>
<body>
<h1>bibliotheque d' universite batna2 - Ajouter livre</h1>
<?php
include_once 'config.php';
include_once 'function.php';
/*
		* Renvoyer a l'ecran de connexion si l'utilisateur n'est pas admin
		*/
		 session_start();
         if(!isset($_SESSION['user']) !="admin"){
  header('Location: index.php'); die;
            }
            /*
            *connexion a la base de donnees
            */
            $conn=connecttoDB();
            $message="";
            /*
            *Interception a la requete POST
            */
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
            	$button=$_POST['submit'];
            	$titre=$_POST['titre'];
            	$auteur=$_POST['auteur'];
            	$filiere=$_POST['filiere'];
            	$date_pub=$_POST['date_pub'];
            	if ($button=="Enregistrer") {
            		$sql="INSERT INTO livre(titre,auteur,filiere,date_pub) VALUES ('$titre','$auteur','$filiere','$date_pub')";
            		/*
            		*Envoi de la requete sql a la bd
            		*/
            		if ($conn->query($sql)=== TRUE) { ?>
            			<table>
            				<?php include_once('../includes/admin_menu.php'); ?>
            				<td valign="top">
            					<b>Le livre a été rajouté avec succes !</b>
            				</td>
            			</table>
            			<?php
            			/* 
              		    *fermeture de la connexion a la base de données
              		    */
            			$conn->close();
            			die;
            		}else{
            			$message="Erreur ".$conn->error;
            		}
            	}

            }
            /* 
            *fermeture de la connexion a la base de données
            */
            $conn->close();
            ?>
            <form method="post" action="ajouter_livre.php">
            	<table>
            		<!-- Insertion du menu dans la table-->
            		<?php include_once 'admin_menu.php'; ?>
            		<td valign="top">
            			<table>
            				<tr>
            			       <td>Titre:</td>
            			       <td><input type="text" name="titre" size="60"></td>
            			   </tr>
            			   <tr>
            			       <td>Auteur:</td>
            			       <td><input type="text" name="auteur" size="40"></td>
            			   </tr>
            			   <tr>
            			       <td>Filiére:</td>
            			       <td><input type="text" name="filiere" size="40"></td>
            			   </tr>
            			   <tr>
            			       <td>Année de publication:</td>
            			       <td><input type="text" name="date_pub" size="5"></td>
            			   </tr>
            			   <tr>
            			   	<td>
            			   		<br>
            			   		<input type="submit" name="submit" value="Enregistrer"/>
            			   		<input type="submit" name="submit" value="Annuler"/>
            			   	</td>
            			   </tr>
            			</table>
            	</table>
            </form>
            <b><?php if ($message != "") echo $message; ?></b>


</body>
</html>
