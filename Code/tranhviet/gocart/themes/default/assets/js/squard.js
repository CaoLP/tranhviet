//Squar'd is a little script written for GoCart to help get the product images squar'd up.

$.fn.squard = function(dim, container){
	
	//dim is the square dimensions you want to match
	img	= $(this);
	
	var newImg=document.createElement("img");

	newImg.setAttribute('src', img.attr('src'));
    newImg.style.width	= dim+'px';

	container.html(newImg);
	
	newImg.onload = function()
	{
		img2	= container.children().eq(0);
	}

};