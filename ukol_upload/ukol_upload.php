
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ukol_upload</title>
</head>
<body>
<?php


    if($_FILES){
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES['uploadedName']['name']);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        
        $uploadSuccess = true;

        if($_FILES['uploadedName']['name'] != 0){
            echo " Chyba serveru pri uploadu.";
            $uploadSuccess = false;
        }

        if(file_exists($targetFile)){
            echo " Soubor jiz existuje.";
            $uploadSuccess = false;
        }

        elseif($_FILES['uploadedName']['size'] > 8000000){
            echo " Soubor je prilis velky.";
            $uploadSuccess = false;
        }

        //elseif ($fileType !== ".jpg" && $fileType !== ".png"){
        //    echo "Soubor ma spatny typ.";
        //    $uploadSuccess = false;
        //}


        if(!$uploadSuccess){
            echo " Doslo k chybe uploadu.";
        } 
        else{
            if(move_uploaded_file($_FILES['uploadedName']['tmp_name'], $targetFile)){
                echo " Soubor ". basename($_FILES['uploadedName']['name']) . " byl ulozen.";
                echo '<img src= "' . $targetFile . '">';
                echo '<video width="320" height="240" controls>
                    <source src="' . $targetFile . '" type="video/mp4">
                </video>';
                echo '<audio controls>
                    <source src="' . $targetFile . '" type="audio/mp3">
                </audio>';
            } 
            else{
                echo " Doslo k chybe uploadu.";
            }
        }
    }
?>
<form method='post' action='' enctype='multipart/form-data'><div>
        Select image to uploda:
        <input type='file' name="uploadedName"/>
        <input type="submit" value="Nahrát" name="submit" />
    </div></form>
</body>
</html>