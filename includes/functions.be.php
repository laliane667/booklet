<?php


function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
    $result;
    if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}


function invalidUid($username){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat){
    $result;
    if($pwd !== $pwdRepeat){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

/* function clearBasket(){
    for($i = 0; $i < $_SESSION['basketSize']; $i++){
        $_SESSION['elem-'.$i] = 'del'.$i;
    }
    $_SESSION['basketSize'] = 0;
    echo "<script>console.log('mougou');</script>";
} */

function addToBasket($elem){
    $index = $_SESSION['basketSize'];
    $_SESSION['elem-'.$index] = $elem;
}

/* function fillBasket($size){
    for($i = 0; $i < $size; $i++){
        echo '<script>addToBasketJS('.$_SESSION["basketSize"].');</script>';
    }
} */

/* function test(){
    return 'zebi';
} */

function uidExists($conn, $username, $email){
   
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pwd){
   
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, usersPrivilege) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    $status = 0;

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../index.php?sg_failed:error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $username, $hashedPwd, $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index.php?sg_success");
    exit();
}

function getCategoryId($conn, $category){
    $sql = "SELECT catId FROM categories WHERE catName='$category';";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            return $row['catId'];
        }
    }else{
        $sql = "INSERT INTO categories (catName) VALUES (?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("location: ../new-product.php?book-creation_failed:error=catstmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $category);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return getCategoryId($conn, $category);
    }
}

function createProduct($conn, $name, $version, $title, $author, $category, $fileNewName, $description, $price, $grade){
    $sql = "INSERT INTO prices (priceId, priceValue, priceDiscount) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../new-product.php?book-creation_failed:error=stmtfailed");
        exit();
    }

    $reduction = 0;
    $priceId = uniqid(rand(),true); 
    mysqli_stmt_bind_param($stmt, "sss",$priceId, $price, $reduction);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    $sql = "INSERT INTO books (booksName, booksVersion, booksVersionTitle, booksAuthor, booksCategory, booksImgPath, booksDesc, booksPriceId, booksGrade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../new-product.php?book-creation_failed:error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssssss", $name, $version, $title, $author, $category, $fileNewName, $description, $priceId, $grade);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index.php?book-creation_success");
    exit();
}  



function emptyInputLogin($username, $pwd){
    $result;
    if(empty($username) || empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd){
    $uidExists = uidExists($conn, $username, $username);

    if($uidExists === false)
    {
        header("location: ../index.php?log_failed:error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkedPwd = password_verify($pwd, $pwdHashed);

    if($checkedPwd === false){
        header("location: ../index.php?log_failed:error=wronglogin");
        exit();
    }else if($checkedPwd === true)
    {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        $_SESSION["userprivilege"] = getUserPrivilege($conn, $_SESSION["userid"]);
        
        header("location: ../index.php");
        exit(); 
    }
}

function getBookPrice($conn, $priceId){
    $sql = "SELECT * FROM prices WHERE priceId='$priceId';";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $price = floatval($row['priceValue']) - floatval($row['priceDiscount'])* floatval($row['priceValue']);
        }
    }else{
        header("location: ../index.php?log_failed:error=privilege");
        exit();
    }
    return $price;
}
function getBookValue($conn, $priceId){
    $sql = "SELECT * FROM prices WHERE priceId='$priceId';";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $price = floatval($row['priceValue']);
        }
    }else{
        header("location: ../index.php?log_failed:error=privilege");
        exit();
    }
    return $price;
}

function getUserPrivilege($conn, $uid){
    $sql = "SELECT usersPrivilege FROM users WHERE usersId='$uid';";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $privilege = $row['usersPrivilege'];
        }
    }else{
        header("location: ../login.php?log_failed:error=privilege");
        exit();
    }
    return $privilege;
}

function getBookDiscount($conn,$booksPriceId){
    $sql = "SELECT priceDiscount FROM prices WHERE priceId='$booksPriceId';";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $disc = $row['priceDiscount'];
        }
    }else{
        header("location: ../table.php");
        exit();
    }
    return $disc;
}

function updateBookElem($conn,$bookid,$value,$type){
    $sql = "UPDATE books SET ".$type."='$value' WHERE booksId='$bookid';";
    $result = mysqli_query($conn, $sql); 
}

function updateBookPrice($conn,$priceId,$value,$type){
    $sql = "UPDATE prices SET ".$type."='$value' WHERE priceId='$priceId';";
    $result = mysqli_query($conn, $sql); 
}