$(document).ready(function(){
	$('#preload').fadeOut();
	$('.preload').fadeOut('slow');
	$('html, body').animate({scrollTop:0 });

// Global var
var body = $('body,html');
var carousel = $('.carousel, .carousel-inner, .carousel .item');
 var texts = $('.text_slider');

 var page_top = $('#page_top');
 var team = $('#team');
 var testimonials = $('#testimonials');
 var our_work = $('#our_work');
 var nav = $('.navigacija');
 var about = $('#about');
 var bubble = $('.bubble_outer_one, .bubble_outer_two, .bubble_outer_three');

// Var for parallavar x icons
	 var work = $('.work_animate');
	 var work_mob = $('.work_animate_mob');
	
	 var testimonials = $('.testimonial_animate');
	 var testimonials_mob = $('.testimonial_animate_mob');
	
	 var team = $('.team_animate');
	 var team_mob = $('.team_animate_mob');
	
	 var window_height = window.innerHeight;
	
	 var work_top = $('.our_work_image').offset().top;
	 var work_top_mob = $('.our_work_image_mob').offset().top;
	
	 var testimonials_top = $('.testimonials_image').offset().top;
	 var testimonials_top_mob = $('.testimonials_image_mob').offset().top;
	
	 var team_top = $('.our_team_image').offset().top;
	 var team_top_mob = $('.our_team_image_mob').offset().top;
	
	 var parallax_height = $('.our_work_image').height();
	 var parallax_height_mob = $('.our_work_image_mob').height();
	
	 var animate_work = work_top - parallax_height;
	 var animate_work_mob = work_top_mob - parallax_height_mob;
	
	 var animate_testimonials = testimonials_top - parallax_height;
	 var animate_testimonials_mob = testimonials_top_mob - parallax_height_mob;
	
	 var animate_team_mob = team_top_mob - parallax_height_mob;
	 var animate_team = team_top - parallax_height;
// Var for parallax icons END

// Change Easing
jQuery.easing.def = "easeInOutExpo";
// Change Easing END

// Slider
	function phobos_slider(){
	var nav = $(".nav").height();
	var height_carousel = $(window).height() - nav;
	carousel.css('height', height_carousel + 'px').css('width','100%');
	
	$('a.right, a.left, .carousel-indicators').click(function(){
	if(texts === texts.hide()){
		
		texts.fadeIn(2000);
		
	}else{
		
		texts.hide('slow');
	}
})
}phobos_slider();
// Slider END

// page scroll
$('a[href^="#"]').click(function(event) {
		event.preventDefault();
		var id = $(this).attr("href");
		var target = $(id).offset().top;
		body.stop().animate({scrollTop:target -70 }, 1200);
});
// page scroll END

// ON SCROLL FUNCTION
function onscroll(){
	var top = page_top.height();
	// STICKY NAV
	if($(this).scrollTop()>=top){
		body.attr('data-target', '.navbar');
		nav.addClass('navbar-fixed-top');
		page_top.stop().animate({paddingBottom: '73px'},0);
	}

	else{		
		body.attr('data-target', '');
		nav.removeClass('navbar-fixed-top');
		page_top.css('padding-bottom', '0px');
	}
	
	};

// About us 3 icons
bubble.hover(function(){

	$('.bubble',this)
	.stop().animate({width:'130px',height:'130px',left:10, top:10,},500)
	.fadeTo("fast", 0.3);

},function(){

	$('.bubble',this)
	.stop().animate({width:'0px', height:'0px', top:'50%', left:'50%'},500)
	.fadeTo("fast", 0.8);
})
// About us 3 icons END

// nav collapse
function collapse(){
if ($('.navbar-toggle:visible').length) {
		$('.navbar a').click(function () { 
		$(".navbar-collapse").collapse("hide");
		});
	}
}collapse();
	
$(window).resize(function(){
	collapse();
	phobos_slider();
})
// nav collapse END

// About us Article hover
function articleHover(){
	$('.about_us_article').hover(
		function() {
			$('.about_arrow', this).css('display', 'block').stop().animate({top: '5%'}, 1000);
		}, function() {
			$('.about_arrow', this).css('display', 'none').stop().animate({top: '60%'}, 100);
		}
		);
};
articleHover();
// About us Article hover END

// OUR SKILLS
function animateProgress(){

	var position_skills = about.offset().top;
	var scroll = $(this).scrollTop();
	var progressbar = $('.progress-bar');
	
	progressbar.each(function(){
	var width = $(this).data('width');
	if(scroll > position_skills + 50){
	$(this).attr('style', width);
	}else {
		$(this).attr('style', '')
	}

	})
}animateProgress();
// OUR SKILLS END

// PARALLAX ICONS FUNCTION
function paralaksIcon(){

	var scroll = $(this).scrollTop();

	if (scroll > animate_work + 200){
	work.children('i').stop().animate({fontSize:'45px', opacity:0.4},500);
	}	else {
	work.children('i').stop().animate({fontSize:'20px', opacity:0.1},500);
	}
	
	if (scroll > animate_work_mob + 200){
	work_mob.children('i').stop().animate({fontSize:'45px', opacity:0.4},500);
	}  else {
	work_mob.children('i').stop().animate({fontSize:'20px', opacity:0.1},500);
	}
	
	if (scroll > animate_testimonials + 400){
		testimonials.children('i').stop().animate({fontSize:'45px', opacity:0.4},500);
	}else {
	testimonials.children('i').stop().animate({fontSize:'20px', opacity:0.1},500);
	}

	if (scroll > animate_testimonials_mob + 400){
		testimonials_mob.children('i').stop().animate({fontSize:'45px', opacity:0.4},500);
	}else {
	testimonials_mob.children('i').stop().animate({fontSize:'20px', opacity:0.1},500);
	}
	
	if (scroll > animate_team + 600){
		team.children('i').stop().animate({fontSize:'45px', opacity:0.4},500);
	}else {
		team.children('i').stop().animate({fontSize:'20px', opacity:0.1},500);	
	}
	
	if (scroll > animate_team_mob + 600){
		team_mob.children('i').stop().animate({fontSize:'45px', opacity:0.4},500);
	}else {
		team_mob.children('i').stop().animate({fontSize:'20px', opacity:0.1},500);	
	}

}paralaksIcon();
// PARALLAX ICONS FUNCTION END
	
// PARALLAX FUNCTION
function paralaks(){
		var paralaks = $('.our_team_image, .our_work_image, .testimonials_image');
		var Yosa = (-$(window).scrollTop() / paralaks.data('speed'))+300;
		var coords = '0% '+ Yosa + 'px';
		paralaks.css('backgroundPosition', coords);
}
// PARALLAX FUNCTION END

$(window).bind('scroll', function(){
		onscroll();
		paralaks();
		paralaksIcon();
		animateProgress();
	});



// GALLERY
var $gallery = $('.gallery');
var $gallery_frame = $('.big-images');
$gallery_frame.css('backgroundColor', 'white');
var gallery_mob = $('.gallery_mob ul');
var picture = $('.gallery_mob ul li');

function hoverGaleryThumb(){
	// THIS FUNCTION MAKE ANIMATE EFFECT WHEN MOUSE ENTER/LEAVE PICTURE
	$('.img_container').hover(function(){
	$('.gallery_hover', this).stop().animate({top:'-145px'},500,function(){
			var mag = $('.mag',this);
			mag.fadeIn(300);
	});
},function(){
	var mag = $('.mag',this);
			mag.fadeOut(100);
		$('.gallery_hover' , this).stop().delay(100)
		.animate({top:'0px'},500);
});	
}hoverGaleryThumb();

function openGallery(){	
	// THIS FUNCTION OPEN AND CLOSE THE GALERRY
	// AND SET GALLERY TO CENTER OF WINDOW
	var width_gallery = $gallery.width();
	var height_gallery = $gallery.height();
	var width_window = $(window).width();
	$('.mag').on('click', function(){
		
		var position_gallery = $gallery.offset().top;
		var image = $(this).attr('data-image');
		var caption = $(this).attr('data-caption');
		$gallery_frame.children('img').attr('src', image).end().fadeIn();
		$('.img_caption').hide().html(caption);
		$('html, body').animate({scrollTop:position_gallery-250},500);
	})
		$('.close_img').on('click', function(){
		$gallery_frame.children('.img_caption').fadeOut().html('')
		.end().fadeOut('slow').children('img').attr('src', '');
	})
}openGallery();
function responsive(){
	// THIS FUNCTION MAKE GALLERY ON CENTER
		var position_gallery = $gallery.offset();
		var width_gallery = $gallery.width();
		var height_gallery = $gallery.height();
		var marginTop = (height_gallery-400)/8 + 'px';
		$gallery_frame.css('width', width_gallery).css('height', height_gallery)
		.children('img, .img_caption').css('margin-top', marginTop).css('margin-left', '20px');
}
responsive();

$(window).resize(function(){
	// THIS CALL AGAIN FUNCTION TO UPDATE GALLERY POSITION
		responsive();
		
		var item_width = $('.slider ul li').outerWidth();
		var left = item_width * (-1);
		
		testemonialResponsive();


});	
 
	// GALLERY FOR MOBILE DEVICE
$(window).resize(function(){
		// THIS FUNCTION RESIZE WINDOW
		var window_width = window.innerWidth;
		function smallDeviceGall(){
			// FUNCTION SMALL DEVICES CHECK DEVICES
			// AND MAKE SLIDER RESPONSIVE
		    if( window_width <=480 || window_width > 481){
		    	gallery_mob.css('left', '0px').end();
		    	// IF DEVICES MOBILE OR LANDSCAPE
		    	// WE CALL FUNCTION SLIDER MOB AGAIN TO UPDATE POSITION
		    	// IF NOT, HIDE SLIDER AND SHOW FULL GALLERY
		    	sliderMob();
  			}
		}smallDeviceGall();	
		
}) 
  
function sliderMob(){
	// THIS IS FUNCTION FOR GALLERY SLIDER MOBILE
    //INSIDE ARE FUNCTIONS ON SWIPE AND ON CLICK 
    // THIS IS GLOBAL VARIABLE FOR BOTH FUNCTION
	var picture_number = picture.length;
    var picture_width = picture.outerWidth(true);
	var picture_height_mob = picture.outerHeight();
    var slider_width = picture_width * picture_number;
    var paralaks_width = slider_width;
    var count = 0; 
    gallery_mob.width(slider_width);
    gallery_mob.css('height', picture_height_mob);
 
function mobOnClick(){
    	// FUNCTION ON CLICK MOVE SLIDER WHEN CLICK ON ARRAY
        $('#controls_mob_left , #controls_mob_right, #gallery_mob_left, #gallery_mob_right').click(function(){
            var id = this.id;
            if(id === 'controls_mob_right' || id === 'gallery_mob_right' ){
                count ++;

            }else{
                count--;

            }
            if(count === -1){
                count = picture_number - 1;
            }else {
                count = count % picture_number;
            }	
            gallery_mob.stop().animate({left:-count*picture_width},1000,'swing');           
        }) 
        }mobOnClick();            
}sliderMob();
// GALLERY END

// TESTIMONIAL
	var item_height = $('.slider ul li').outerHeight();
	var item_width = $('.slider ul li').outerWidth();
	var left = item_width * (-1);
	$('.slider').height(item_height);
	$('.slider ul').css('left', left);

function testemonialResponsive(){
		var item_width = $('.slider ul li').outerWidth();
		var left = item_width * (-1);
		$('.slider ul').css('left', left);
}testemonialResponsive();

function sliderTestemonial(){
	
	$('.slider ul li:first').before($('.slider ul li:last'));	
	$('.see_more').click(function(){
		var item_width = $('.slider ul li').outerWidth();
		var left = item_width * (-1);
		var width = $('.client_image img').width();
		var height = $('.client_image img').height();
		var sliding = parseInt($('.slider ul').css('left')) - item_width;
		$('.slider ul').stop().animate({'left':sliding}, function(){
			$('.slider li:last').after($('.slider li:first'));
			$('.slider ul').css('left', left);
		})
	})

}sliderTestemonial();
// TESTIMONIAL END

// OUR CLIENT SLIDER
		var itemWidth = parseInt($(".slider_partners ul").children().css('width')); 
    	var leftValue = itemWidth * (-1); 
    	$('.slider_partners ul').children(':first').before($('.slider_partners ul').children(':last'));   
    	$(".slider_partners ul").css({'left' : leftValue});
		function clientResponsive(){
			var itemWidth = $('.slider_partners li').outerWidth();
			var leftValue = itemWidth * (-1);
			$('.slider_partners ul').css('left', leftValue);
		}clientResponsive();
$(window).resize(function(){
 	var itemWidth = $('.slider_partners .client_logo_partners').outerWidth();
	var leftValue = itemWidth * (-1);
		clientResponsive();

 })	

		function slideNext(){

    			var leftIndent = parseInt($('.slider_partners ul').css('left')) - itemWidth;
				$('.slider_partners ul').stop()
				.animate({'left':leftIndent},500,"easeInOutBack",function(){
				$('.slider_partners .client_logo_partners:last').after($('.slider_partners .client_logo_partners:first'));           
        		$('.slider_partners ul').css({'left' : leftValue});		    		
    			});
			}
			
			function slidePrev(){
				var leftIndent = parseInt($('.slider_partners ul').css('left')) + itemWidth;
				$('.slider_partners ul').stop().animate({'left':leftIndent},500,"easeInOutBack",function(){    
       		 	$('.slider_partners .client_logo_partners:first').before($('.slider_partners .client_logo_partners:last'));           
        		$('.slider_partners ul').css({'left' : leftValue});
        	});
				
			}

			$(".slider_partners_arrow").on('click', function(){

				if($(this).data('direction') === 'next') {

					slideNext();
				}

				else {
					slidePrev();
				}				
			})
	

});

