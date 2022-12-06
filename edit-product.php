<?php
    include_once 'header.php';
    require_once 'includes/dbh.be.php';
    require_once 'includes/functions.be.php'; 
    require_once 'display.php'; 

    $bookId = mysqli_real_escape_string($conn, $_GET['product']);

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
            $bookValue = getBookValue($conn,$booksPriceId);
        }
    }else{
        header("location: ../index.php");
        exit();
    }
?>

    <div class="main_container">
        <div class="main_content">
            <div class="bookinfo__imgContainer">
                <!-- <img class="bookinfo__background" src="src/img/books/b1_cover.jpeg" alt="image 1 missing"> -->
            </div>
            
            <div class="bookinfo__container">
                <form method="post" action="includes/update-product.be.php">
                    <?php echo '<input type="hidden" value="'.$bookId.'" name="bookid">'; ?>
                    <?php echo '<input type="hidden" value="'.$booksPriceId.'" name="priceid">'; ?>

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
                                        echo '<input style="width: 40px;" type="number" step="0.1" min="0" min="5" name="book-grade" placeHolder="'.$booksGrade.'">';
                                        ?>
                                </h4>
                            </div>
                            <div class="bookinfo__topright">
                                <h1 class="book_name">
                                    <?php
                                        echo '<input type="text" name="book-name" placeholder="'.$booksName.'">';
                                    ?>
                                </h1>
                                <hr>
                                <h1 class="book_author">by 
                                    <?php
                                        echo '<input type="text" name="book-author" placeholder="'.$booksAuthor.'">';
                                    ?>
                                </h1>
                                <hr>
                                <h3> 
                                    <?php
                                        echo '<input type="text" name="book-version" placeholder="'.$booksVersion.'">';
                                    ?>
                                </h3>
                                <hr>
                                <h4>
                                    <?php
                                        echo '<input type="text" name="book-versionTitle" placeholder="'.$booksVersionTitle.'">';
                                    ?>
                                </h4>
                                <hr>
                                <h2>from £<span class="book_price">
                                    <?php
                                        //echo '<input type="number" step="0.01" min="0" name="book-price" placeHolder="'.number_format($bookPrice, 2).'">';
                                        echo number_format($bookPrice, 2);
                                    ?>
                                </span></h2>
                                <hr>
                                <div class="data_container_footer">
                                    <button type="submit" name="submit-save">Save</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="bookinfo__section__bis bookinfo__desc">
                        <h1 class="bookinfo__htxt">PRODUCT DESCRIPTION <span class="bookinfo__buttonDown" id="bib1" onclick="javascript: openOrCloseDesc()"><i class="fa-solid fa-chevron-down"></i></span></h1>                            
                            <?php
                                echo '<textarea cols="110" rows="20" name="book-desc" placeholder="'.$booksDesc.'"></textarea>'; 
                            ?>
                    </div>

                    <div class="bookinfo__section__bis bookinfo__sameauthor">
                        <h1 class="bookinfo__htxt">PRODUCT DISCOUNT <span class="bookinfo__buttonDown" id="bib2" onclick="javascript: openOrCloseDiscover()"><i class="fa-solid fa-chevron-down"></i></span></h1>                            
                            <?php
                                echo "<div style='width: 100%; display: flex; justify-content: space-around; margin-bottom: 20px;'>";
                                echo "<span>Price ";
                                echo '<input style="width: 60px;" type="number" step="0.1" min="0" name="book-price" placeHolder="'.number_format($bookValue, 2).'"></span>';
                                echo "<span>Discount ";
                                echo '<input style="width: 60px;" type="number" step="0.01" min="0" max="1" name="book-discount" placeHolder="'.number_format($bookDiscount, 2).'"></span>';
                                echo "</div>";
                            ?>
                    </div>
                </form>
                
                <script src="js/book-info.js"></script>
            </div>

<?php
    include_once 'footer.php';
?>