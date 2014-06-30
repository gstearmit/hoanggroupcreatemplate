
<!-- /menu/-->
$(document).ready(function (){
$("#firstpane p.menu_head").click(function(){
$(this).css({backgroundImage:"url(images/mt.png)"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
$(this).siblings().css({backgroundImage:"url(images/mt.png)"});
});

$("#firstpane1 p.menu_head1").click(function(){
$(this).css({backgroundImage:"url(images/mt.png)"}).next("div.menu_body1").slideToggle(300).siblings("div.menu_body1").slideUp("slow");
$(this).siblings().css({backgroundImage:"url(images/mt.png)"});
});



$("#firstpane2 p.menu_head2").click(function(){
$(this).css({backgroundImage:"url(images/mt.png)"}).next("div.menu_body2").slideToggle(300).siblings("div.menu_body2").slideUp("slow");
$(this).siblings().css({backgroundImage:"url(images/mt.png)"});
});


$("#firstpane4 p.menu_head4").click(function(){
$(this).css({backgroundImage:"url(images/mt1.png)"}).next("div.menu_body4").slideToggle(300).siblings("div.menu_body4").slideUp("slow");

});




$("p.sub1").click(function(){
$(this).css({backgroundImage:"url(images/mt1.png)"}).next("div.son-sub1").slideToggle(300).siblings("div.son-sub1").slideUp("slow");

});



$("#firstpane5 p.menu_head5").click(function(){
$(this).css({backgroundImage:"url(images/mt1.png)"}).next("div.menu_body5").slideToggle(300).siblings("div.menu_body5").slideUp("slow");

});

$("p.sub2").click(function(){
$(this).css({backgroundImage:"url(images/mt1.png)"}).next("div.son-sub2").slideToggle(300).siblings("div.son-sub2").slideUp("slow");

});


$("#firstpane6 p.menu_head6").click(function(){
$(this).css({backgroundImage:"url(images/mt1.png)"}).next("div.menu_body6").slideToggle(300).siblings("div.menu_body6").slideUp("slow");

});

$("p.sub3").click(function(){
$(this).css({backgroundImage:"url(images/mt1.png)"}).next("div.son-sub3").slideToggle(300).siblings("div.son-sub3").slideUp("slow");

});




});



