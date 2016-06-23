<?php
require("../exp/class/sql.php");

if (isset($_FILES['uploaded_file'])) {
//mkdir("upload",0777, true);
    // Exemple:
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], "upload/centralpark.csv")){
        //echo $_FILES['uploaded_file']['name']. " uploaded ...";    
        /*Ouvre le fichier et retourne un tableau contenant une ligne par élément*/
        $lines = file('upload/centralpark.csv');
        /*On parcourt le tableau $lines et on affiche le contenu de chaque ligne précédée de son numéro*/
        CentralParkPurge($pdoAffectation);
        foreach ($lines as $lineNumber => $lineContent)
        {
	        //echo $lineContent."<br>";
            $split = explode(";", $lineContent);
            CentralPark($pdoAffectation, $split[0],$split[1],'KPA','KPA','KPA',$split[5],$split[6],$split[7],$split[8],$split[9],$split[10],$split[11],$split[12],$split[13],$split[14],$split[15],$split[16],$split[17],$split[18],$split[19],$split[20],$split[21],$split[22],$split[23],$split[24],$split[25],$split[26],$split[27],$split[28],$split[29],$split[30],$split[31],$split[32],$split[33],$split[34],$split[35],$split[36],$split[37],$split[38],$split[39],$split[40],$split[41],$split[42],$split[43],$split[44],$split[45],$split[46],$split[47],$split[48],$split[49],$split[50],$split[51],$split[52],$split[53],$split[54],$split[55],$split[56],$split[57],$split[58],$split[59],$split[60],$split[61],$split[62],$split[63],$split[64],$split[65],$split[66],$split[67],$split[68],$split[69],$split[70],$split[71],$split[72],$split[73]);
        }
            echo "Finish";
    } else {
        echo "Erreur";
    }

    exit;
} else {
    echo "no"; 
}
?>