<div class="footer__container">
                <h1>SUBSCRIBE TO OUR NEWSLETTER: </h1>
                <h1>CONTACT</h1>
                <h1>REFUNDS</h1>
                <h1>PRIVACY & POLITIES</h1>
                <h1>TERM OF SERVICES</h1>
                <h2>&copy;BOOKLET & CO</h2>
            </div>
        </div>
    </div>

    <div id="hiddenContainer">

    </div>
    <?php
        if(isset($_SESSION['basketSize'])){
            $array = getElemArray();
        }
        function getElemArray(){
            $elemArray = array();
            for($i = 0; $i < $_SESSION['basketSize']; $i++){
                array_push($elemArray, $_SESSION['elem-'.$i]);
            }
            return json_encode($elemArray);
        }

        function resetBasket(){
            for($i = 0; $i < $_SESSION['basketSize']; $i++){
                $_SESSION['elem-'.$i] = 'del'.$i;
            }
            $_SESSION['basketSize'] = 0;
        }
    ?>
    <script src="js/app-main1.js"></script>
    <script type="text/javascript">

        function clearBasketJQ(){
            
        }

        window.addEventListener('load', 
        function() { 
            let val = "<?php echo $_SESSION['basketSize']; ?>";
            if(!document.getElementById('basketJSize')){
                console.log('BASKET J SIZE DOESNT EXISTS');
            }else{
                if((document.getElementById('basketJSize').value) < val ){
                    console.log('Uston we got a problem');
                    newBasket = [];
                    newBasket = <?php echo $array; ?>;
                    setNewBasket(newBasket);
                }else{

                }
            }
        }, false);

        

        function addToBasketJQ(bookid){
            $.ajax({
            method: "POST",
            url: "includes/basket.be.php",
            data: { product: bookid}
            })
            .done(function( response ) {
                addToBasketJS(bookid);
            });
        }
    </script>
</body>
</html>