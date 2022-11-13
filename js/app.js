const menu = document.querySelector('#mobile-menu');
const menuLink = document.querySelector('.nav__container');
/* 
menu.addEventListener('onload', function(){
    console.log('zbu');
    updateImage();
}); */
let isToggleOpen = false;
menu.addEventListener('click', function(){
    if(isToggleOpen==false && isBasketOpen){
        openOrCloseBasket(lastVal);
    }
    toggleHandler();
});

function toggleHandler(){
    menu.classList.toggle('is-active');
    menuLink.classList.toggle('active');
    
    isToggleOpen = !isToggleOpen;
    if(isToggleOpen == true){
        document.querySelector('.navbar').style.backgroundColor = 'var(--backgnd)';
    }else{
        updateVisuals();
    }
}

let marginImg = 0;

window.addEventListener("scroll", function(event) {
    updateVisuals();
});

function updateVisuals(){
    var scroll_y = this.scrollY;
    let navbar = document.querySelector('.navbar');
    let image = document.querySelector('.img__background');
    let containerImg = document.querySelector('.img__container');
    let opvalue = ((780 - scroll_y)/(780)).toFixed(2);
    if(opvalue < 0) opvalue = 0;
    //console.log(opvalue);
    //image.setAttribute("style", "opacity:"+opacity); 
    containerImg.style.opacity = opvalue;

    if(scroll_y < 780){
        if(isToggleOpen == false) navbar.style.backgroundColor = 'rgba(0, 0, 0, 0)';
        let value = (-(780 - (780 - scroll_y))/2.229)+marginImg;
        image.setAttribute("style", "margin-left:"+parseInt(value)+"px;"); 
    }
    else if(scroll_y >= 780 && scroll_y <= 820){
        
        let value = (40 - (820 - scroll_y))/80;
        if(isToggleOpen == false) navbar.style.backgroundColor = 'rgba(0, 0, 0, '+value+')';
    }
    else if(scroll_y > 820){
        if(isToggleOpen == false) navbar.style.backgroundColor = 'var(--backgnd)';
    }
}

function updateImage(){
    
    let W = screen.width;
    let w = getWidth();
    marginImg = parseInt(-(W - w)/(W/500));
    let image = document.querySelector('.img__background');
    //console.log(opacity);
    image.setAttribute("style", "margin-left:"+marginImg+"px;"); 

}

let basket = [];
let isBasketOpen = false;
let logButtonSelected = true;
let lastVal = -1;
let total = 0;

window.onresize = function() {
    updateSize(lastVal);
    updateImage();
};



function addToBasket(elem){
    
    basket.push(elem);
    if(basket.length>0){
        isBasketOpen = true;
        updateTotal();
        updateSize(1);
    }
}

function clearBasket(trashItemContainer){
    basket.length = 0;
    document.querySelector('.trash_container').innerHTML = " ";
    updateSize(1);
}

function openOrCloseBasket(menu){
    if(lastVal == menu || lastVal == -1){
        isBasketOpen = !isBasketOpen;
    }
    lastVal = menu;
    if(isToggleOpen == true){
        toggleHandler();
    }
    
    updateSize(menu);
}

function updateTotal(){
    total = 0;
    for(let i = 0; i < basket.length; i++){
        let rose = document.getElementById('elem-'+basket[i]);
        let price = rose.querySelector('.book_price').innerHTML;
        console.log(price);
        total += parseFloat(price);
    }
}

function updateSize(menu){
    //console.log(screen.height)
    let mainDiv = document.querySelector('.main_content');
    let basketDiv = document.querySelector('.sidebar__container');
    //let buttonShop = document.querySelector('.shop_button');
    
    let scrHeight = screen.height;
    basketDiv.style.height = scrHeight.toString()+'px';

    if(isBasketOpen){
        //buttonShop.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        if( getWidth() <= 630){
            mainDiv.style.width = '50%'
            basketDiv.style.width = '50%' 
        }
        else if( getWidth() <= 840){
            mainDiv.style.width = '60%'
            basketDiv.style.width = '40%' 
        }
        else if( getWidth() <= 1050){
            mainDiv.style.width = '65%'
            basketDiv.style.width = '35%' 
        }
        else{
            mainDiv.style.width = '75%'
            basketDiv.style.width = '25%' 
        }
        if(menu == 0){
            displayConnectionContent();
        }else if(menu == 1){
            displayBasketContent();
        }
    }else{
        //buttonShop.innerHTML = '<i class="fa-solid fa-cart-shopping"></i>';
        mainDiv.style.width = '100%'
        basketDiv.style.width = '0%' 
        document.querySelector('.trash_container').innerHTML = " ";
        basketContent = document.querySelector('.basket_content').innerHTML = " ";
    }
}

function displayConnectionContent(){
    let basketContent = document.querySelector('.basket_content');
    let doc = document.createElement('div');//.className='signup_form';
    doc.className = 'signup_form';

    basketContent.innerHTML = '';

    if(logButtonSelected == true){
        let form = document.createElement('form');
        form.setAttribute("method", "post");
        form.setAttribute("action", "submit.php");
    
        let iptId = document.createElement('input');
        iptId.setAttribute("type", "text");
        iptId.setAttribute("name", "uid");
        iptId.setAttribute("placeholder", "Username/E-mail...");
    
        let iptPw = document.createElement('input');
        iptPw.setAttribute("type", "password");
        iptPw.setAttribute("name", "pwd");
        iptPw.setAttribute("placeholder", "Password...");
    
        let iptSubmit = document.createElement('button');
        iptSubmit.setAttribute("type", "submit");
        iptSubmit.setAttribute("name", "submit");
        iptSubmit.innerHTML = 'LOG IN';
    
        form.appendChild(iptId);
        form.appendChild(iptPw);
        form.appendChild(iptSubmit);
        doc.appendChild(form);
        basketContent.innerHTML = '<h1 class="basket_h1 login_menu"><span onclick="javascript: loginClick()" class="login_menu_button log_menu_selected">LOGIN</span><span onclick="javascript: signUpClick()" class="login_menu_button">SIGN IN</span></h1>';
    }else if(!logButtonSelected){
        let form = document.createElement('form');
        form.setAttribute("method", "post");
        form.setAttribute("action", "submit.php");
    
        let iptId = document.createElement('input');
        iptId.setAttribute("type", "text");
        iptId.setAttribute("name", "name");
        iptId.setAttribute("placeholder", "Full name...");

        let iptMail = document.createElement('input');
        iptMail.setAttribute("type", "text");
        iptMail.setAttribute("name", "email");
        iptMail.setAttribute("placeholder", "E-mail...");

        let iptUId = document.createElement('input');
        iptUId.setAttribute("type", "text");
        iptUId.setAttribute("name", "uid");
        iptUId.setAttribute("placeholder", "Username...");
    
        let iptPw = document.createElement('input');
        iptPw.setAttribute("type", "password");
        iptPw.setAttribute("name", "pwd");
        iptPw.setAttribute("placeholder", "Password...");

        let iptPwRepeat = document.createElement('input');
        iptPwRepeat.setAttribute("type", "password");
        iptPwRepeat.setAttribute("name", "pwdRepeat");
        iptPwRepeat.setAttribute("placeholder", "Repeat password...");
    
        let iptSubmit = document.createElement('button');
        iptSubmit.setAttribute("type", "submit");
        iptSubmit.setAttribute("name", "submit");
        iptSubmit.innerHTML = 'SIGN UP';

        form.appendChild(iptId);
        form.appendChild(iptMail);
        form.appendChild(iptUId);
        form.appendChild(iptPw);
        form.appendChild(iptPwRepeat);
        form.appendChild(iptSubmit);
        doc.appendChild(form);
        basketContent.innerHTML = '<h1 class="basket_h1 login_menu"><span onclick="javascript: loginClick()" class="login_menu_button">LOGIN</span><span onclick="javascript: signUpClick()" class="login_menu_button log_menu_selected">SIGN IN</span></h1>';
    }
    basketContent.appendChild(doc);

    /* <form action="includes/signup.inc.php" method="post">
                <input type="text" name="name" placeHolder="Full name...">
                <input type="text" name="email" placeHolder="E-mail...">
                <input type="text" name="uid" placeHolder="Username...">
                <input type="password" name="pwd" placeHolder="Password...">
                <input type="password" name="pwdRepeat" placeHolder="Repeat password...">
                <button type="submit" name="submit">SIGN UP</button>
            </form> */
}

function loginClick(){
    logButtonSelected = true;
    displayConnectionContent();
}

function signUpClick(){
    logButtonSelected = false;
    displayConnectionContent();
}

function displayBasketContent(){
    let basketContent = document.querySelector('.basket_content');
    //let buttonClear = document.querySelector('.clear_button');
    let trashItemContainer = document.querySelector('.trash_container');
    let trash = "<div class='clear_button' onclick='javascript: clearBasket()'><h1>CLEAR</h1></div>";
    if(basket.length==0){
        basketContent.innerHTML = '<h1 class="basket_h1">Nothing here yet !</h1>';
        //buttonClear.style.width = '0%';
        trashItemContainer.innerHTML = " ";
    }else if(basket.length>0 && isBasketOpen){
        
        let top ='<h1 class="basket_h1">Items selected: </h1>';
        let bottom ='<h1 class="basket_h1">Total: £'+total.toFixed(2);+'</h1>';
        let list = getList();
        htmlElem = top + list + bottom;
        trashItemContainer.innerHTML = trash;
        basketContent.innerHTML = htmlElem;
    }
    if(!isBasketOpen){
        trashItemContainer.innerHTML = " ";
    }
}

function getList(){
    let l = '<ul class="basket_list">';
    for(let i = 0; i < basket.length; i++){
        l += '<li>';

        let rose = document.getElementById('elem-'+basket[i]);
        let name = document.querySelector('.book_name').innerHTML;
        let price = document.querySelector('.book_price').innerHTML;
        l += (name+' - £'+price);

        l += '</li>';
    }
    l += '</ul>';
    return l;
}

function getWidth() {
    if (self.innerWidth) {
      return self.innerWidth;
    }
  
    if (document.documentElement && document.documentElement.clientWidth) {
      return document.documentElement.clientWidth;
    }
  
    if (document.body) {
      return document.body.clientWidth;
    }
}
