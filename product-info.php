<?php
    include_once 'header.php';
    require_once 'includes/dbh.be.php';
    require_once 'includes/functions.be.php'; 
    require_once 'display.php'; 

    $bookId = mysqli_real_escape_string($conn, $_GET['index']);

    $sql = "SELECT * FROM books WHERE booksId='$bookId';";
    $result = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($result);

    if($queryResults > 0){
        while($row = mysqli_fetch_assoc($result)){
            $booksName = $row['booksName'];
            $booksVersion = $row['booksVersion'];
            $booksVersionTitle = $row['booksVersionTitle'];
            $booksAuthor = $row['booksAuthor'];
            $booksCategory = $row['booksCategory'];
            $booksImgPath = $row['booksImgPath'];
            $booksDesc = $row['booksDesc'];
            $booksPriceId = $row['booksPriceId'];
            $booksGrade = $row['booksGrade'];
            $bookDiscount = getBookDiscount($conn,$booksPriceId);
            $bookPrice = getBookPrice($conn,$booksPriceId);
        }
    }else{
        header("location: ../index.php");
        exit();
    }
?>

    <div class="main_container">
        <div class="main_content">
            <div class="trash_container"></div>

            <div class="bookinfo__imgContainer">
                <!-- <img class="bookinfo__background" src="src/img/books/b1_cover.jpeg" alt="image 1 missing"> -->
            </div>
            <div class="bookinfo__container">
                <div class="bookinfo__section">
                    <div class="bookinfo__top">
                        <?php
                            echo '<img class="img bookinfo__img" src="uploads/'.$booksImgPath.'" alt="image missing">';
                        ?>
                        <div class="star_container">
                            <h1>&star;</h1>
                            <h1>&star;</h1>
                            <h1>&star;</h1>
                            <h1>&star;</h1>
                            <h1>&star;</h1>
                            <h4>
                                <?php
                                    echo $booksGrade;
                                ?>
                            </h4>
                        </div>
                        <div class="bookinfo__topright">
                            <h1 class="book_name">
                                
                                <?php
                                    echo $booksName;
                                ?>
                            </h1>
                            <hr>
                            <h1 class="book_author">by 
                                <?php
                                    echo $booksAuthor;
                                ?>
                            </h1>
                            <hr>
                            <h3> 
                                <?php
                                    echo $booksVersion;
                                ?>
                            </h3>
                            <hr>
                            <h4>
                                <?php
                                    echo $booksVersionTitle;
                                ?>
                            </h4>
                            <hr>
                            <h2>from £<span class="book_price">
                                <?php
                                    echo $bookPrice;
                                ?>
                            </span></h2>
                            <hr>
                            <div class="data_container_footer">
                            <?php
                                    $lastSize = $_SESSION['basketSize'];
                                    $_SESSION['basketLastSize'] = $lastSize;
                                    echo '<button onclick="javascript: addToBasketJQ('.$bookId.')">Add to cart</button>';
                            ?>    
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="bookinfo__section__bis bookinfo__desc">
                    <h1 class="bookinfo__htxt">PRODUCT DESCRIPTION <span class="bookinfo__buttonDown" id="bib1" onclick="javascript: openOrCloseDesc()"><i class="fa-solid fa-chevron-down"></i></span></h1>
                    <p>
                        <?php
                            echo $booksDesc;
                        ?>
                    </p>
                </div>

                <div class="bookinfo__section__bis bookinfo__sameauthor">
                    <h1 class="bookinfo__htxt">CHECK ALSO<span class="bookinfo__buttonDown" id="bib2" onclick="javascript: openOrCloseDiscover()"><i class="fa-solid fa-chevron-down"></i></span></h1>

                    <!-- <div class="categoryImg fantasyCat"></div> -->
                    <?php
                        include_once 'includes/dbh.be.php';
                        include_once 'display.php';
                        $mode = 'customer';
                        displayCategories($conn, $mode);
                    ?>
                </div>
                <script src="js/book-info.js"></script>
            </div>

<?php
    include_once 'footer.php';
?>