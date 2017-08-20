<?php
session_start();
require_once("inc/haut.inc.php");
?>

<?php

$msg="";
$val="";


if($_POST){



  if(empty($_POST['pseudo'])){
    $msg.="le champ pseudo n'est pas renseigné.<br>";
  }else{
        if(!preg_match("#^[A-Za-z0-9]{5,20}$#", $_POST['pseudo'])){
       $msg.="le champ pseudo est mal renseigné.<br>";

     }else {
       $reqpseudo=executeRequete("SELECT pseudo FROM membre WHERE pseudo='$_POST[pseudo]'");
               if( $reqpseudo->num_rows >=1){
               $msg.="Le pseudo est déjà utilisé. VOus allez être redirigé vers la page d'accueil. . Cliquez <a href='index.php'>içi </a>si vous ne voulez pas attendre.<br>";
             }else{$val=$val+1;}

            }
     }

  if(empty($_POST['mdp'])){
    $msg.="le champ mot de passe n'est pas renseigné.<br>";
  }else{
        if(!preg_match('#^[a-zA-Z0-9]{5,20}$#', $_POST['mdp'])){
        $msg.="le champ mot de passe est mal renseigné.<br>";

      }else {$val=$val+1;}
      }


      if(empty($_POST['nom'])){
        $msg.="le nom n'est pas renseigné.<br>";
      }else{
        if(!preg_match("#^[a-zA-Z-]{2,15}$#", $_POST['nom'])){
        $msg.="le champ nom est mal renseigné.<br>";

      }else {$val=$val+1;}
      }


  if(empty($_POST['prenom'])){
    $msg.="le prenom n'est pas renseigné.<br>";
  }else{
    if(!preg_match('#^[a-zA-Z-]{3,25}$#', $_POST['prenom'])){
    $msg.="le champ prenom est mal renseigné.<br>";

}else {$val=$val+1;}
  }

  if(empty($_POST['email'])){
    $msg.="l'email n'est pas renseigné.<br>";
  }else{
    if(!preg_match("#^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$_POST['email'])){
    $msg.= "le champ email est mal renseigné.<br>";


    } else {
      $reqmail=executeRequete("SELECT email FROM membre WHERE email='$_POST[email]'");
              if( $reqmail->num_rows >=1){
              $msg.="L'adresse mail est déjà utilisée'. Vous allez être redirigé vers la page d'accueil. . Cliquez <a href='index.php'>içi </a>si vous ne voulez pas attendre.<br>";
            }else{$val=$val+1;}
          }
  }


echo $msg;



if(empty($msg) && $val==5){

  $pseudo = mysqli_real_escape_string($mysqli, $_POST['pseudo']);
  $mdp = mysqli_real_escape_string($mysqli, $_POST['mdp']);
  $nom = mysqli_real_escape_string($mysqli, $_POST['nom']);
  $prenom = mysqli_real_escape_string($mysqli, $_POST['prenom']);
  $email = mysqli_real_escape_string($mysqli, $_POST['email']);



  $insertion=executeRequete("INSERT INTO  membre (pseudo, mdp, nom,prenom,email, civilite, statut, date_enregistrement )
  VALUES ('$pseudo', '$mdp','$nom','$prenom', '$email','$_POST[civilite]', 'membre', NOW())");


echo "Vous êtes bien inscrit. Vous allez être redirigé vers la page d'accueil. Cliquez <a href='index.php'>içi </a>si vous ne voulez pas attendre. ";

}

} ?>
<script type="text/javascript">
  window.setTimeout("location=('index.php');",5000);
</script>


<?php

            require_once("inc/bas.inc.php");

?>
