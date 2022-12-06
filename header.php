<?php
    session_start();
    require_once 'includes/dbh.be.php';
    require_once 'includes/functions.be.php';
    if(isset($_SESSION['basketSize'])){
        if ($_SESSION['basketSize'] < 0 || $_SESSION['basketSize'] > 100){
            $_SESSION['basketSize'] = 0;
        } 
    }else{
        $_SESSION['basketSize'] = 0;
    }
    /* if (!isset($_GET['basket-size'])) {
        $_GET = array('basket-size' => '0');
        $_SESSION['basketSize'] = 0;
        $_SESSION['basketLastSize'] = 0;
    } */
    /* if($_SESSION['updateBasket'] == true){
        $_SESSION['updateBasket'] = false;
        fillBasket($_SESSION['basketSize']);
    } */
   /*  if(isset($_GET['basket-size'])) {
        $_SESSION['basketSize'] = $_GET['basket-size'];
     }
     if(($_GET['basket-size']) > 100 || ($_GET['basket-size'] < 0)){
        clearBasket();
        $_SESSION['basketSize'] = 0;
        $_SESSION['basketLastSize'] = 0;
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        $url = "https://";   
        else  
        $url = "http://";   
        $url.= $_SERVER['HTTP_HOST'];   
    
        $url.= $_SERVER['REQUEST_URI'];  
        $newLoc = explode('?',$url);
        $newLoc = $newLoc[0];
        $_SESSION['updateBasket'] = true;
        header("location: ".$newLoc."?basket-size=0");
    } */
    /* if(!isset($_GET['basket-size'])){
        
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        $url = "https://";   
        else  
        $url = "http://";   
        $url.= $_SERVER['HTTP_HOST'];   
        
        $url.= $_SERVER['REQUEST_URI'];  
        $newLoc = explode('?',$url);
        $newLoc = $newLoc[0];
        $_SESSION['updateBasket'] = true;
        echo "<script>console.log(bite);</script>";
        header("location: ".$newLoc."?basket-size=".$_SESSION['basketSize']);
    } */

    /* if($_SESSION['basketSize'] > $_SESSION['basketLastSize'] && $_SESSION['bufferElem'] != 'del' ){
        addToBasket($_SESSION['bufferElem']);
    }

    if (isset($_GET['product'])){
        $_SESSION['bufferElem'] = $_GET['product'];
    }else{
        $_SESSION['bufferElem'] = 'del';
    } */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKLET & Co</title>

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://kit.fontawesome.com/5c4b16e6c8.js" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
    <body>
    <nav class="navbar">
        <div class="nav__container">
            
            <div class="nav__list">
                <ul>
                    <li class="nav__button" href=" ">CATEGORIES</li>
                    <li class="nav__button" href="/">ABOUT</li>
                </ul>
            </div>
    
            <div class="nav__co">
                <?php 
                echo '<a href="index.php">';
                //echo '<a href="index.php?basket-size='.$_SESSION['basketSize'].'">'
                ?>
                    BOOKLET & CO
                </a>
            </div>
    
            <div class="nav__list">
                <ul>
                    <li class="nav__button" onclick="javascript: openOrCloseBasket(2)">SEARCH</li>
                    <?php
                    if(isset($_SESSION["useruid"])){
                        echo "<li class='nav__button'><a href='includes/logout.be.php' class='logout__button'>LOG&nbsp;OUT</a></li>";
                        if($_SESSION["userprivilege"] == 1){
                            echo "<li class='nav__button'><a href='page-editor.php' class='logout__button'>EDIT&nbsp;PAGE</a></li>";
                            //echo "<li class='nav__button'><a href='page-editor.php?basket-size=".$_SESSION['basketSize']."' class='logout__button'>EDIT&nbsp;PAGE</a></li>";
                        }
                    }
                    else
                    {
                        echo '<li class="nav__button" onclick="javascript: openOrCloseBasket(0)">LOGIN</li>';
                    }
                    

                    ?>
                    <li class="nav__button" onclick="javascript: openOrCloseBasket(1)">CART(<span id="bskSize"><?php echo $_SESSION['basketSize'] ?></span>)</li>
                </ul>
            </div>
        </div>
        <div class="navbar__toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        
    </nav>
    <!-- <img class="main__logo" src="src/img/logo2.png"> -->

    <div class="sidebar__container" data-basket-content>
        <!-- <h1 class="basket_title">Basket</h1> -->
        <div class="basket_content">
            
        </div>
    </div>