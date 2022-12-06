<?php

function displayCategories($conn, $mode){
    $sql = "SELECT * FROM categories;";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $catName = $row['catName'];
            $catId = $row['catId'];
            echo '<h1 class="categorie__title">'.$catName.'</h1>';
            echo '<div class="elem_container">';
            displayCategoryContent($conn, $catId, $mode);
            echo '</div>';
        }
    }
}

function displayBooks($conn, $mode){
    $sql = "SELECT * FROM categories;";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $catId = $row['catId'];
            displayCategoryContent($conn, $catId,$mode);
        }
    }
}

function displayCategoryContent($conn, $catId, $mode){
    include_once 'includes/functions.be.php';
    include_once 'includes/dbh.be.php';

    $sql = "SELECT * FROM books WHERE booksCategory='$catId';";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $bookId = $row['booksId'];
            $booksName = $row['booksName'];
            $booksVersion = $row['booksVersion'];
            $booksVersionTitle = $row['booksVersionTitle'];
            $booksAuthor = $row['booksAuthor'];
            $booksCategory = $row['booksCategory'];
            $booksImgPath = $row['booksImgPath'];
            $booksDesc = $row['booksDesc'];
            $booksPrice = getBookPrice($conn, $row['booksPriceId']);
            $booksGrade = $row['booksGrade'];

            echo '<div class="elem" id="elem-'.$bookId.'" >';
            echo '<div class="img_container">';
            echo '<img class="img" src="uploads/'.$booksImgPath.'" alt="image missing">';
            echo '<div class="star_container">';
            echo '<h1>&star;</h1><h1>&star;</h1><h1>&star;</h1><h1>&star;</h1><h1>&star;</h1><h4>'.$booksGrade.'</h4>';
            echo '</div></div>';
            echo '<div class="data_container">';
            echo '<h1 class="book_name">'.$booksName.'</h1>';
            echo '<hr><h3>'.$booksVersion.'</h3><hr>';
            echo '<h4>'.$booksVersionTitle.'</h4><hr>';
            echo '<h2>from £<span id="book_price" class="book_price">'.$booksPrice.'</span></h2><hr>';

            if($mode == 'customer'){
                $lastSize = $_SESSION['basketSize'];
                $_SESSION['basketLastSize'] = $lastSize;
                echo '<div class="data_container_footer"><a href="product-info.php?index='.$bookId.'">Read more</a>';
                //echo '<div class="data_container_footer"><a href="product-info.php?index='.$bookId.'&basket-size='.$_SESSION['basketSize'].'">Read more</a>';
               // echo '<button onclick="javascript: addToBasket('.$lastSize.','.$bookId.')">Add to cart</button>';
                echo '<button onclick="addToBasketJQ('.$bookId.')">Add to cart</button>';
            }else if($mode == 'edit'){
                echo '<div class="data_container_footer"><a href="edit-product.php?product='.$bookId.'">Edit product</a>';
                //echo '<div class="data_container_footer"><a href="edit-product.php?product='.$bookId.'&basket-size='.$_SESSION['basketSize'].'">Edit product</a>';
            }
            
            
            echo '</div></div></div>';
        }
    }
}

/* function test($bookId){
    $_SESSION['test'] = $bookId;
} */