(function($){
"use strict";

jQuery(document).ready( function(){
	
function get_url(){
	var templateUrl = object_name.templateUrl;
	
	return templateUrl;
}
	
var businessArray = ['newly-updated-businesses', 'visa-possible-businesses', 'businesses-over-a-million','franchise-businesses'];
	
var buyArray = ['buyer-faq','steps-to-buy-a-business', 'buyer-services', 'search-for-businesses-for-sale', 'featured-businesses'];
	
var sellArray = ['seller-services', 'steps-to-sell-a-business', 'sell-my-business-now'];
	

	var dynamicForm = $('.form-wrap .col-md-4');
    var colForm = $('.form-wrap .col-md-8');

    colForm.height(dynamicForm.height());
	
	var dynamicFind = $('.find-wrap .col-md-4');
    var colFind = $('.find-wrap .col-md-8');

    colFind.height(dynamicFind.height());
	
	var dynamicBlog = $('.blog-wrap .col-md-4');
    var colBlog = $('.blog-wrap .col-md-8');

    colBlog.height(dynamicBlog.height());
	
	var dynamicQuest = $('.answers-wrap .col-md-4');
    var colQuest = $('.answers-wrap .col-md-8');

    colQuest.height(dynamicQuest.height());
	
$( window ).resize(function() {
  var dynamicForm = $('.form-wrap .col-md-4');
    var colForm = $('.form-wrap .col-md-8');

    colForm.height(dynamicForm.height());
	
	var dynamicFind = $('.find-wrap .col-md-4');
    var colFind = $('.find-wrap .col-md-8');

    colFind.height(dynamicFind.height());
	
	var dynamicBlog = $('.blog-wrap .col-md-4');
    var colBlog = $('.blog-wrap .col-md-8');

    colBlog.height(dynamicBlog.height());
	
	var dynamicQuest = $('.answers-wrap .col-md-4');
    var colQuest = $('.answers-wrap .col-md-8');
	
	colQuest.height(dynamicQuest.height());

});

$('.mob-ul li').each(function(){
	var link = $(this).attr('data-link');
	link = link.replace(/\//g, '');
	var path = window.location.pathname.replace(/\//g, '');
	

	
	if(link === path){
		$(this).addClass('mobile-select');
	}
	
	if(businessArray.indexOf(path) !== -1 && link === 'buyer-faq'){
		$(this).addClass('mobile-select');
	}
});
	
$('#top-menu a').each(function(){
	var path = window.location.pathname.replace(/\//g, '');
	var roughPath = window.location.pathname.replace(/\//g, ' ');
	var ref = $(this).attr('href').replace(/\//g, '');
	var text = $(this).text();
	var found = false;
	
	if(path === ref && text !== 'BUSINESSES FOR SALE'){
		$(this).parent().addClass('nav-selected');
		$(this).addClass('current');
		found = true;
	}
	
	if(businessArray.indexOf(path) !== -1 && ref === 'buyer-registration'){
		$(this).parent().addClass('nav-selected');
		$(this).addClass('current');
		found = true;
	}
	
	if(buyArray.indexOf(path) !== -1 && ref === 'buyer-registration'){
		$(this).parent().addClass('nav-selected');
		$(this).addClass('current');
		found = true;
	}
	
	if(sellArray.indexOf(path) !== -1 && ref === 'seller-services'){
		$(this).parent().addClass('nav-selected');
		$(this).addClass('current');
		found = true;
	}
	
	if(path === 'meet-our-team' && ref === 'about-us'){
		$(this).parent().addClass('nav-selected');
		$(this).addClass('current');
		found = true;
	}
	
	if(roughPath.indexOf('featured') !== -1 && path.indexOf('featured-businesses') < 0 && ref === 'buyer-registration'){
		$(this).parent().addClass('nav-selected');
		$(this).addClass('current');
		found = true;
	}
	
	if(path === 'blog' && ref === 'resources'){
		$(this).parent().addClass('nav-selected');
		$(this).addClass('current');
		found = true;
	}
	
	if(path === 'find-a-professional' && ref === 'resources'){
		$(this).parent().addClass('nav-selected');
		$(this).addClass('current');
		found = true;
	}
	
	if(path === 'forms' && ref === 'resources'){
		$(this).parent().addClass('nav-selected');
		$(this).addClass('current');
		found = true;
	}
	
	if(path === 'franchise-opportunities' && ref === 'resources'){
		$(this).parent().addClass('nav-selected');
		$(this).addClass('current');
		found = true;
	}
	
	if(roughPath.indexOf('franchise') !== -1 && roughPath.indexOf('businesses') < 0 && ref === 'resources'){
		$(this).parent().addClass('nav-selected');
		$(this).addClass('current');
		found = true;
	}
	
	if(path === 'carey-sobel' && ref === 'about-us'){
		$(this).parent().addClass('nav-selected');
		$(this).addClass('current');
		found = true;
	}
	
	
});
	
if($('.nav-selected').length === 0){
		$('#menu-item-86').addClass('nav-holder');
	}
	
	
$('#top-menu a').hover(
				
               function () {
				  
				   if(!$(this).hasClass('current')){
					   $(this).parent().not('.sub-menu li').removeClass('nav-holder');
                  $(this).parent().not('.sub-menu li').addClass('nav-selected');
				   }
               }, 
				
               function () {
				  if(!$(this).hasClass('current')){
					  $(this).parent().not('.sub-menu li').addClass('nav-holder');
                  $(this).parent().not('.sub-menu li').removeClass('nav-selected');
				   }
               }
            );
	
$('.sell_action_wrapper').hover(
				
               function () {
				  
				   $(this).find('img').attr('src', '/wp-content/uploads/2017/05/sell_button.jpg');
               }, 
				
               function () {
				 $(this).find('img').attr('src', '/wp-content/uploads/2017/05/sell_button_blue.png');
               }
            );
	
$('.buy_action_wrapper').hover(
				
               function () {
				  
				   $(this).find('img').attr('src', '/wp-content/uploads/2017/05/yellow_buy_button.png');
               }, 
				
               function () {
				 $(this).find('img').attr('src', '/wp-content/uploads/2017/05/buy_button.jpg');
               }
            );
	
$('.search_action_wrapper').hover(
				
               function () {
				  
				   $(this).find('img').attr('src', '/wp-content/uploads/2017/05/yellow_search_button.png');
               }, 
				
               function () {
				 $(this).find('img').attr('src', '/wp-content/uploads/2017/05/search_button.jpg');
               }
            );
	

	
function go_link(link){
	window.location.href = link;
}

$('.mob-ul li').click(function(){
	 var link = $(this).attr('data-link');
	$(this).addClass('mobile-select');
	$('.mob-ul li').not(this).removeClass('mobile-select');
	go_link(link);
});
	
$('.fa-bars').click(function(){
	$( ".mob-nav-wrap" ).animate({
    right: "0"
  }, 300, function() {
    // Animation complete.
  });
});
	
$('.fa-times').click(function(){
	$( ".mob-nav-wrap" ).animate({
    right: "-200"
  }, 300, function() {
    // Animation complete.
  });
});

$(".info-drop > option").each(function() {
var value = this.value.replace(/\//g, '');
var dropref = window.location.pathname.replace(/\//g, '');
if(value === dropref){
	$('.info-drop').val('/' + dropref);
}else if(businessArray.indexOf(dropref) !== -1 && value === 'search-for-businesses-for-sale'){
		$('.info-drop').val('/search-for-businesses-for-sale');
	
	}
});
	
$('.info-drop').on('change', function() {
  var path = window.location.pathname.replace(/\//g, '');
  var ref = this.value.replace(/\//g, '');
	console.log(path);
	console.log(ref);
	if(path !== ref){
  window.location.href = this.value;
	}
});
	
$('.boss-sidebar li').each(function(){
	var path = window.location.pathname.replace(/\//g, '');
	var ref = $(this).parent().attr('href').replace(/\//g, '');
	if(path === ref){
		$(this).addClass('white');
	}
	
	if(businessArray.indexOf(path) > -1 && ref === 'search-for-businesses-for-sale'){
		$(this).addClass('white');
	}
	
	if(path === 'businesses-for-sale' && ref === 'search-for-businesses-for-sale'){
		$(this).addClass('white');
	}
});
	
$('.search_frame .col-md-4').each(function(){
	var path = window.location.pathname.replace(/\//g, '');
	var ref = $(this).parent().attr('href').replace(/\//g, '');
	if(path === ref){
		$(this).addClass('yellow');
	}
});
	
if( $('.blog-insert').length ){
	var curUrl = get_url();
	var info = {
        'action': 'boss_filter',
        'cat': 'Blog'
        
    };
	$.ajax({
        type: "POST",
        url: curUrl + '/wp-admin/admin-ajax.php',
  	    data: info,
        success:function(data){
			 $('.blog-data').html(data);
			   }
          });
	
}
	
if( $('.featured-insert').length ){
	var curUrl = get_url();
	var info = {
        'action': 'feat_detailed_filter',
        'cat': 'Featured'
        
    };
	$.ajax({
        type: "POST",
        url: curUrl + '/wp-admin/admin-ajax.php',
  	    data: info,
        success:function(data){
			 $('.featured-wrap').html(data);
			   }
          });
	
}

	
$('.filter-prof-button').click(function() {
	var filter = $('.prof-select option:selected').val();

	$('.pro-wrap').each(function(){
		$(this).removeClass('hide');
		var profData = $(this).attr('data-prof');
		if(filter !== 'All'){
		if(profData !== filter){
			$(this).addClass('hide');
		}
		}else{
		 $(this).removeClass('hide');	
		}
	});
});
	


});
})(jQuery);