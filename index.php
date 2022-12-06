<?php
    include_once 'header.php';
?>

    <div class="main__quote">
        <h1 id="firstQuote">THINK BEFORE YOU SPEAK.</h1>
        <h1 id="secondQuote">READ BEFORE YOU THINK.</h1>
        <h1 id="quoteAuthor">FRAN LEBOWITZ</h1>
    </div>
    <div class="main__downButton">
        <h1><i class="fa-solid fa-chevron-down"></i></h1>
    </div>
    <div class="img__container">
        <img class="img__background" src="src/img/test2.png">
    </div>
    <div class="main_container">
        <div class="main_content">
            <!-- <div class="shop_button" onclick="javascript: openOrCloseBasket()">
                <i class="fa-solid fa-cart-shopping"></i>
            </div> -->

            <div class="trash_container"></div>

            <?php
                include_once 'includes/dbh.be.php';
                include_once 'display.php';
                $mode = 'customer';
                displayCategories($conn, $mode);
            ?>

            <!-- 
            <h1 class="categorie__title">FANTASY</h1>
    
            <div class="categoryImg fantasyCat"></div>
            <div class="elem_container">
                <div class="elem" id="elem-1" >
                    <div class="img_container">
                        <img class="img" src="src/img/books/b1_cover.jpeg" alt="image 1 missing">
                        <div class="star_container">
                            <h1>&star;</h1>
                            <h1>&star;</h1>
                            <h1>&star;</h1>
                            <h1>&star;</h1>
                            <h1>&star;</h1>
                            <h4>4.5</h4>
                        </div>
                    </div>
                    <div class="data_container">
                        <h1 class="book_name">Harry Potter</h1>
                        <hr>
                        <h3>TOME 6</h3>
                        <hr>
                        <h4>Harry Potter and the half-blood prince</h4>
                        <hr>
                        <h2>from £<span class="book_price">22.99</span></h2>
                        <hr>
                        <div class="data_container_footer">
                            <a href="book-info.html">Read more</a>
                            <button onclick="javascript: addToBasket(1)">Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>    
            
            <h1 class="categorie__title">CULTURE</h1>
            <div class="categoryImg cultureCat"></div>
            <div class="elem_container" id="myDiv">
                <div class="elem" id="elem-2" >
                    <div class="img_container">
                        <img class="img" src="src/img/books/b2_cover.webp" alt="image 1 missing">
                        <div class="star_container">
                            <h1>&star;</h1>
                            <h1>&star;</h1>
                            <h1>&star;</h1>
                            <h1>&star;</h1>
                            <h1>&star;</h1>
                            <h4>4.5</h4>
                        </div>
                    </div>
                    <div class="data_container">
                        <h1 class="book_name">L'Art de la guerre</h1>
                        <hr>
                        <h3>Les treize articles</h3>
                        <hr>
                        <h4>-</h4>
                        <hr>
                        <h2>from £<span class="book_price">3.99</span></h2>
                        <hr>
                        <div class="data_container_footer">
                            <a href="book-info.html">Read more</a>
                            <button onclick="javascript: addToBasket(2)">Add to cart</button>
                        </div>
                    </div>    
                </div>
            </div> -->


<?php
    include_once 'footer.php';
?>