<?php
if (isset($_FILES['uploaded_file'])) {
mkdir("upload",0777, true);
    // Exemple:
if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], "upload/ImportAffectation.csv")){
        echo $_FILES['uploaded_file']['name']. " uploaded ...";    
       }
  }else{
echo ";)";
}
?>