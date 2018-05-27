<?php
include_once "config.php";



        // Connexion a la base de données

        function connecttoDB ()
        {

            $conn= new mysqli(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE)
                    or trigger_error(mysql_erreor(),E_USER_ERROR);

                if (mysqli_connect_errno())
                {
                    exit("La connexion a &eacute;chou&eacute;:".mysqli_connect_error());
                }

         //Modification de charactere set a utf-8

                if (!mysqli_set_charset($conn, "utf8"))
                {
                    printf("Error loading character set utf8: %s\n", mysqli_error($conn));
                    exit();
                
                 }
             return $conn;

        }

        //Verification de la complexité de mot de passe

        function ComplexiteMotDePasse($mot_de_passe)
        {
            $complexite=0;

        // Contient des minuscules

            if(preg_match("/[a-z]+/",$mot_de_passe)){$complexite++;}

        //Contient des majuscules

            if(preg_match("/[A-Z]+/",$mot_de_passe)){$complexite++;}

        // Contient des chiffres

            if(preg_match("/\d+/",$mot_de_passe)){$complexite++;}

        // Contient des caractéres spéciaux

            if(preg_match("/\W+/",$mot_de_passe)){$complexite++;}

        // Contient 6 caractéres et 15 caractéres au plus

            if(strlen($mot_de_passe) >= 6 AND strlen($mot_de_passe) <= 15){$complexite++;}

        // Contient plus de 15 caractéres.si oui, complexité est augmentée de 2

            elseif(strlen(mot_de_passe)>15){$complexite=$complexite+2;}

        //Mot de passe trop court.Complexité est mise a 1

            elseif(strlen(mot_de_passe)<6){$complexite=1;}

                if ($complexite>=4)
                {
                    return true;
                }

            return false;

        }

    //Génération automatique de mot de passe

    function generer_motDePasse()
    {

         $mot_de_passe='';

         $str ='abcdefghijklmnopqrstuvwxyz';

         $str ='ABCDEFGHIJKLMNOPQRSTUVWXYZ';

         $str ='0123456789';

    for($index=0;$index<10;$index++)
        {

    //Appel de la fonction de génération de chiffre aléatoire rand()

      $mot_de_passe=substr($str,(rand()%(strlen($str))),1);

        }

    return $mot_de_passe;

    }

