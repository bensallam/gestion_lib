<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content_Type" content="text/html; charset=utf-8"/>
	<title>bibliotheque d' universite batna2</title>
</head>
<body>
	<h1>bibliotheque d' universite batna2 - Liste de livres</h1>
	<table>
		<?php
		/*
		* Renvoyer a l'ecran de connexion si l'utilisateur n'est pas connecté
		*/
		 session_start();
         if(!isset($_SESSION['user'])){
	         header('Location: index.php'); die;
            }
		 
            include_once('../includes/config.php');
            /*
            * Insertion de menu dans la table
            */
            if ($_SESSION['user']=="admin") {
            	 include_once('../includes/admin_menu.php');
            }else{
            	 include_once('../includes/user_menu.php');
            }
            /*
            * Cet écran a été appelé a partir de l'écran de recherche
            */
            if (isset($_GET['titre'])) {
            	$clause_where=" WHERE titre LIKE '% ".$_GET['titre']."%'";
            }elseif (isset($_GET['auteur'])) {
            	$clause_where=" WHERE auteur LIKE '% ".$_GET['auteur']."%'";
            }elseif (isset($_GET['filiere'])) {
            	$clause_where=" WHERE filiere LIKE '% ".$_GET['filiere']."%'";
            }else{
            	$clause_where="";
            }
            ?>
              <td valign="top">
              	<table>
              		<?php
              		include_once('../includes/functions.php');
              		$sql="SELECT codelivre,titre,auteur,filiere,date_pub FROM livre".$clause_where;
              		/*
              		*connexion a la base de donnees
              		*/
              		$conn=connecttoDB();
              		/*
              		*Envoi de la requete sql a la base de données
              		*/
              		$result= $conn->query($sql);
              		if ($result->num_rows > 0) {
              			?>
              			<!-- afficher entete -->
              			<tr>
              				<td><p align="center" > <b>Titre</b></td>
              					<td><p align="center" > <b>Auteur</b></td>
              						<td><p align="center" > <b>Filiére</b></td>
              							<td><p align="center" > <b>Publié</b></td>
              			</tr>
              			<?php
              			/*
              			*Boucle pour l'affichage des données dans un tableau
              			*/
              			while ($line = $result->fetch_assoc()) {
              				?>
              				<tr>
              					<!-- afficher données -->
              					<td><?php echo $line['titre'];?></td>
              					<td>&nbsp;&nbsp;<?php echo $line['auteur'];?></td>
              					<td>&nbsp;&nbsp;<?php echo $line['filiere'];?></td>
              					<td>&nbsp;&nbsp;<?php echo $line['date_pub'];?></td>
              					<?php
              					if ($_session['user'] == "admin") {
              						?>
              						<td>&nbsp;&nbsp;<a href="../admin/modifier_livre.php?codelivre=<?php echo $line['codelivre'];?>">Modifier</a></td>
              						<td>&nbsp;&nbsp;<a href="../admin/supprimer_livre.php?codelivre=<?php echo $line['codelivre'];?>">Supprimer</a></td>
              					}
              			    </tr>


              		<?php	
              		}		
              				
              			}
              		}
              		/* 
              		*fermeture de la connexion a la base de données
              		*/
              		$conn->close();
              		?>

              	</table>
            </td>
	</table>

</body>
</html>
