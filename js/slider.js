function createSlider(sliderClass){
    $("."+sliderClass).bxSlider({
        slideWidth: 300,
        minSlides: 3,
        maxSlides: 3,
        moveSlides: 1,
        slideMargin: 10,
        captions: true,
        adaptiveHeight: true
      });
}

$(document).ready(function(){
    $(".list-products > h4").click(function(){
        location.href = "search.php?CAT="+this.innerHTML;
    });
    
    $(".categories > li > a").click(function(){
        location.href = "search.php?CAT="+this.innerHTML;
    });
});

