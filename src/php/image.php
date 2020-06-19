<?php
    function saveImage($title, $platform){
        //renames the file
        $upLoadOk = 1;
        $extention = getExt();
        $_FILES["image"]["name"] = str_replace(' ', '-', strtolower($title . $platform . $extention));

         //determines where the img is saved
        $targetDir = 'C:/xampp/htdocs/shopping-cart/src/db/img/';
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);

        //Check if image file is a actual image or fake image
        if(isset($_POST["submit"])){
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false){
                echo "File is an image";
                $upLoadOk = 1;
                }else{
                    echo "File is not an image";
                    $upLoadOk = 0;
                }
            }

        //Check if file already exists
        if(file_exists($targetFile)){
            echo "Sorry, file already exists.";
            $upLoadOk = 0;
        }

        //check if $upLoadOk is set to 0 by an error
        if($upLoadOk == 0){
            echo "Sorry, your file was not uploaded.";
        //if everything is ok, try to upload file
        }else{
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)){
                echo "The file ". basename($_FILES["image"]["name"]). " has been uploaded.";
            }else{
                echo "Sorry, there was an error uploading your file.";
            }
        }

        return basename($_FILES["image"]["name"]);
    }

    //gets the file extension
    //this is a jank way to do it and there probably is a more elagant solution. Too bad!
    function getExt(){
        switch ($_FILES["image"]["type"]) {
            case 'image/png':
                return '.png';
                break;

            case 'image/jpeg':
                return '.jpeg';
                break;

            case 'image/jpg':
                return '.jpg';
                break;

            default:
                $upLoadOk = 0;
                echo "the file extenstion type is not supported";
                break;
        }
    }