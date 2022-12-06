let isDescOpen = false;
let isDiscoverOpen = false;

function updateBackgroundImg(){
    let doc = document.querySelector('.bookinfo__imgContainer');
    if(!isDescOpen && !isDiscoverOpen){
        doc.style.height = '820px';
    }else if(isDescOpen && !isDiscoverOpen){
        doc.style.height = '940px';
    }else if(!isDescOpen && isDiscoverOpen){
        doc.style.height = '1020px';
    }else if(isDescOpen && isDiscoverOpen){
        doc.style.height = '1430px';
    }

}

function openOrCloseDesc(){
    isDescOpen = !isDescOpen;
    updateBackgroundImg();
    let descContainer = document.querySelector('.bookinfo__desc');
    let button = document.querySelector('#bib1');
    if(isDescOpen){
        descContainer.style.height = '470px';
        descContainer.style.overflow = 'scroll';
        button.innerHTML = '<i class="fa-solid fa-chevron-up"></i>';

    }else{
        descContainer.style.height = '60px';
        descContainer.style.overflow = 'hidden';
        button.innerHTML = '<i class="fa-solid fa-chevron-down"></i>';

    }
}

function openOrCloseDiscover(){
    isDiscoverOpen = !isDiscoverOpen;
    updateBackgroundImg();
    let discContainer = document.querySelector('.bookinfo__sameauthor');
    let button = document.querySelector('#bib2');
    if(isDiscoverOpen){
        discContainer.style.height = 'fit-content';
        /* discContainer.style.overflow = 'scroll'; */
        button.innerHTML = '<i class="fa-solid fa-chevron-up"></i>';

    }else{
        discContainer.style.height = '60px';
        discContainer.style.overflow = 'hidden';
        button.innerHTML = '<i class="fa-solid fa-chevron-down"></i>';

    }
}