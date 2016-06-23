<?php
require("../config/class/sql.php");
if(isset($_POST['chaine']) == true){
    $chaine_img = 0;
    $DateDeAffectation = $_POST['da'];
    $chaine_img = $_POST["img"];
    $chaine = (string)$_POST['chaine'];
    $chaine_md5 = md5($chaine);
$dbh = $pdoAffectation;
    // attempt a connection
    if (!$dbh) {
        die("Error in connection: " . pg_last_error());
    }
    // execute query
    $pdoAffectation->query("INSERT INTO \"historique\" (\"chaine\", \"date_edition\", \"date_affectation\", \"chaine_md5\", \"chaine_img\") VALUES ('".$chaine."', '".date("d-m-Y H:i")."', '".$DateDeAffectation."' ,'".$chaine_md5."','".$chaine_img."')");
    echo $chaine_img;
    echo "INSERT INTO \"historique\" (\"chaine\", \"date_edition\", \"date_affectation\", \"chaine_md5\", \"chaine_img\") VALUES ('".$chaine."', '".date("d-m-Y H:i")."', '".$DateDeAffectation."' ,'".$chaine_md5."','".$chaine_img."')"; 
}
if(isset($_GET['periodeDate']) == true){
    $dbh = $pdoAffectation;
    $date = $_GET['periodeDate'];
    if (!$dbh) {
        die("Error in connection: " . pg_last_error());
    }
    // execute query
    $stmt=$pdoAffectation->query("SELECT \"public\".calendrier.pa FROM \"public\".calendrier WHERE \"public\".calendrier.\"date\" = '".$date."'");
    $result = $stmt->fetch();
    if (!$result) {
      echo "Une erreur s'est produite.\n";
      exit;
    }

    echo $result[0];
}
if(isset($_GET['ladate']) == true){
    $ladate = $_GET['ladate'];
    $dbh = $pdoAffectation;
    // attempt a connection
    if (!$dbh) {
        die("Error in connection: " . pg_last_error());
    }
    // execute query
    $stmt=$pdoAffectation->query("SELECT * FROM \"public\".\"historique\" WHERE \"date_affectation\" = '".$ladate."'");
    $limit = 0;
    echo "<option value='choix'>Merci de choisir une edition</option>";
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo "<option value=" . $row[5]. ">" . $row[2]. "</option>";
    }
}
if(isset($_GET['regles']) == true){
    $dbh = $pdoAffectation;
    if (!$dbh) {
        die("Error in connection: " . pg_last_error());
    }
    // execute query
    $stmt=$pdoAffectation->query("SELECT * FROM \"public\".\"regles\"");
    $tabInterdit = [];
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $tabInterdit[$result["LIGNE"]] = $result["VEHICULE_INTERDIT"];
    }        
    echo json_encode($tabInterdit);
}
if(isset($_GET['getChaine']) == true){
    $id = $_GET['getChaine'];
    $dbh = $pdoAffectation;
    // attempt a connection
    if (!$dbh) {
        die("Error in connection: " . pg_last_error());
    }
    // execute query
    $stmt=$pdoAffectation->query("SELECT * FROM \"public\".\"historique\" WHERE \"id\" = '".$id."'");
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo $row[0];
    }
}
?>