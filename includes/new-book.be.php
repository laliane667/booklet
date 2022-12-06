<?php

if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $version = $_POST["version"];
    $title = $_POST["title"];
    $author = $_POST["author"];
    $category = $_POST["category"];
    $description = $_POST["description"];
    $price = $_POST['price'];
    $grade = $_POST['grade'];

    if(empty($name) || empty($version) || empty($title) || empty($author) || empty($category) || empty($description)){
        header("location: ../new-product.php?bookCreation_failed:error=missing_data");
        exit();
    }

    //echo $name." ".$version." ".$author." ".$category." ".$description." ".$title." ";
    
    require_once 'dbh.be.php'; 
    require_once 'functions.be.php'; 


    $bookId = uniqid(rand(),true); 
    $file = $_FILES['cover'];

    $fileName = $_FILES['cover']['name'];
    $fileTmpName = $_FILES['cover']['tmp_name'];
    $fileSize = $_FILES['cover']['size'];
    $fileError = $_FILES['cover']['error'];
    $fileType = $_FILES['cover']['type'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg','JPEG', 'png', 'webp');
    $maxSize = 1000000;

    $categoryId = getCategoryId($conn, $category);

    /* Pense a checker the mime type == image */

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < $maxSize){
                $fileNewName = "cover".$bookId.".".$fileActualExt;
                $fileDestination = '../uploads/'.$fileNewName;
                move_uploaded_file($fileTmpName, $fileDestination);
                createProduct($conn, $name, $version, $title, $author, $categoryId, $fileNewName, $description, $price, $grade);  


                header("location: ../new-product.php?book-creation_failed:error=none");
                exit();
            }
            else{
                header("location: ../new-product.php?book-creation_failed:error=toobigfile");
                exit(); 
            }
        }
        else{
            header("location: ../new-product.php?book-creation_failed:error=uploadfailed");
            exit(); 
        }
    }
    else{
        header("location: ../new-product.php?book-creation_failed:error=formatnotallowed");
        exit();
    }
       

}
else{
    header("location: ../new-product.php");
    exit();
}