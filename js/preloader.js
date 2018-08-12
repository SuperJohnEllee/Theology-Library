$.fn.carouselBackgroundPreloader = function(a, b){
	var id = 0;
	this.each(function(){
		id++;
		var element = this;
		var preloaderTemplate = '' +
			'<svg class="loading" viewbox="0 0 100 80">' +
			'		<defs>' +
			'			<linearGradient class="gradient" id="gradient_' + id + '" x1="100%" y1="0%" x2="0%" y2="100%">' +
			'				<stop offset="0%" stop-color="#4383b8" />' +
			'				<stop offset="100%" stop-color="#4aa06c" />' +
			'			</linearGradient>' +
			'			<clipPath class="rects" id="rects_' + id + '">' +
			'				<rect class="rect rect1" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect2" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect3" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect4" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect5" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect6" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect7" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'			</clipPath>' +
			'		</defs>' +
			'	<rect class="container" transform="translate(50) scale(0.707, 0.707) rotate(45)" x="0" y="0" width="100" height="100" fill="url(#gradient_' + id + ')" clip-path="url(#rects_' + id + ')">' +
			'	</rect>' +
			'</svg>';
		var container = document.createElement('div');
		var imageUrl = $(element).data('background-image');
		var image = new Image();
		var children = $(element).children();
		$(children).hide();
		$(element).css({
			'background-color':'#000',
		});
		$(container).css({
			'position':'absolute',
			'top':'0',
			'left':'0',
			'width':'100%',
			'height':'100%',
			'display':'flex',
			'align-items':'center',
			'justify-content':'center',
			'z-index':'100'
		})
		.append(preloaderTemplate);
		$(element).append(container);
		if($(element).css('position') == 'static') $(element).css('position', 'relative');
		$(image).on('load', function(){
			$(element).css('background-image', 'url(' + imageUrl + ')');
			$(container).hide();
			$(children).show();
		});
		$(image).on('error', function(){
			$(element).css('background-image', 'url(' + imageUrl + ')');
			$(container).hide();
			$(children).show();
		});
	 image.src = imageUrl;
	});
};
$.fn.imageBackgroundPreloader = function(a, b){
	var id = 0;
	this.each(function(){
		id++;
		var element = this;
		var preloaderTemplate = '' +
			'<svg class="loading" viewbox="0 0 100 80">' +
			'		<defs>' +
			'			<linearGradient class="gradient" id="gradients_' + id + '" x1="100%" y1="0%" x2="0%" y2="100%">' +
			'				<stop offset="0%" stop-color="#4383b8" />' +
			'				<stop offset="100%" stop-color="#4aa06c" />' +
			'			</linearGradient>' +
			'			<clipPath class="rects" id="rectss_' + id + '">' +
			'				<rect class="rect rect1" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect2" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect3" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect4" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect5" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect6" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect7" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'			</clipPath>' +
			'		</defs>' +
			'	<rect class="container" transform="translate(50) scale(0.707, 0.707) rotate(45)" x="0" y="0" width="100" height="100" fill="url(#gradients_' + id + ')" clip-path="url(#rectss_' + id + ')">' +
			'	</rect>' +
			'</svg>';
		var container = document.createElement('div');
		var imageUrl = $(element).data('image');
		var image = new Image();
		var children = $(element).children();
		$(children).hide();
		$(element).css({
			'background-color':'#000',
			'height':'20vh'
		});
		$(container).css({
			'position':'absolute',
			'top':'0',
			'left':'0',
			'width':'100%',
			'height':'100%',
			'display':'flex',
			'align-items':'center',
			'justify-content':'center',
			'z-index':'100'
		})
		.append(preloaderTemplate);
		$(element).append(container);
		if($(element).css('position') == 'static') $(element).css('position', 'relative');
		$(image).on('load', function(){
			$(element).css({
				'background-image':'url(' + imageUrl + ')',
				'height':'auto'
			});
			$(container).hide();
			$(children).show();
		});
		$(image).on('error', function(){
			$(element).css('background-image', 'url(' + imageUrl + ')');
			$(container).hide();
			$(children).show();
		});
		image.src = imageUrl;
	});
};
$.fn.imagePreloader = function(a, b){
	var id = 0;
	this.each(function(){
		id++;
		var element = this;
		var preloaderTemplate = '' +
			'<svg class="loading" viewbox="0 0 100 80">' +
			'		<defs>' +
			'			<linearGradient class="gradient" id="gradientss_' + id + '" x1="100%" y1="0%" x2="0%" y2="100%">' +
			'				<stop offset="0%" stop-color="#4383b8" />' +
			'				<stop offset="100%" stop-color="#4aa06c" />' +
			'			</linearGradient>' +
			'			<clipPath class="rects" id="rectsss_' + id + '">' +
			'				<rect class="rect rect1" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect2" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect3" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect4" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect5" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect6" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'				<rect class="rect rect7" x="0" y="0" width="30" height="30" rx="2" ry="2" />' +
			'			</clipPath>' +
			'		</defs>' +
			'	<rect class="container" transform="translate(50) scale(0.707, 0.707) rotate(45)" x="0" y="0" width="100" height="100" fill="url(#gradientss_' + id + ')" clip-path="url(#rectsss_' + id + ')">' +
			'	</rect>' +
			'</svg>';
		var container = document.createElement('div');
		var imageUrl = $(element).data('asset-image');
		var image = new Image();
		var children = $(element).children();
		$(children).hide();
		$(element).css({
			'background-color':'#000',
		});
		$(container).css({
			'position':'absolute',
			'top':'0',
			'left':'0',
			'width':'100%',
			'height':'100%',
			'display':'flex',
			'align-items':'center',
			'justify-content':'center',
			'z-index':'100'
		})
		.append(preloaderTemplate);
		$(element).append(container);
		if($(element).css('position') == 'static') $(element).css('position', 'relative');
		$(image).on('load', function(){
			$(element).attr("src",imageUrl);
			$(container).hide();
			$(children).show();
		});
		$(image).on('error', function(){
			$(element).attr("src",imageUrl);
			$(container).hide();
			$(children).show();
		});
	 image.src = imageUrl;
	});
};

$(document).ready(function(){
	$('[data-background-image]').carouselBackgroundPreloader();
	$('[data-image]').imageBackgroundPreloader();
	$('[data-asset-image]').imagePreloader();

	document.getElementById("bgvid").onloadstart = function() {
		$('#bgvidpreloader').fadeOut();
	}
});
