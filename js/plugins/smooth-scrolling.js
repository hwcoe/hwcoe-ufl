jQuery(function($) {
	// Performs a smooth page scroll to an anchor on the same page.
	// https://css-tricks.com/snippets/jquery/smooth-scrolling/
	// updated: https://css-tricks.com/smooth-scrolling-accessibility/

	// Select all links with hashes and exclude the carousel control links
	$('a[href*="#"]:not(.carousel-control)')
  	// Remove links that don't actually link to anything
	.not('[href="#"]')
	.not('[href="#0"]')
	.click(function(event) {
	// On-page links
	if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
		// Figure out element to scroll to
		var target = $(this.hash);
		target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
		// Does a scroll target exist?
		if (target.length) {
			// Only prevent default if animation is actually gonna happen
			event.preventDefault();

			// Animate scrolling
			$("html, body").animate({ scrollTop: target.offset().top - 260}, 500, "linear");

			// set focus in new location
			target.focus();
			if (target.is(":focus")){
				return false;
			} else {
				target.attr("tabindex","-1");
				target.focus();
			}
			return false;
		}
	 }
  });
});