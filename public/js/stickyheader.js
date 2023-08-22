/* Called whenever the user scrolls */
$(window).scroll(function() {
	updateScrollProgress();
	headerTransition();
});

$(".sticky-toggle").click(function(event) {
	//Kill click event.
	event.stopPropagation();

	//Dropdown list
	var gameDropdown = $("#game-dropdown");
	var supportDropdown = $("#support-dropdown");
	var accountDropdown = $("#account-dropdown");

	//Store the data-toggle attribute
	var toggleId = $(this).attr("data-toggle");

	//Grabs our targeted dropdown menu by ID
	var toggleTarget = $("#" + toggleId);

	if (gameDropdown.attr("is-toggled") == "true") {
		gameDropdown.attr("is-toggled", "false");
		gameDropdown.fadeToggle(350);
		if (toggleTarget.attr("id") != gameDropdown.attr("id")) {
			toggleTarget.attr("is-toggled", "true");
			toggleTarget.fadeToggle(350);
		}
	} else if (supportDropdown.attr("is-toggled") == "true") {
		supportDropdown.attr("is-toggled", "false");
		supportDropdown.fadeToggle(350);
		if (toggleTarget.attr("id") != supportDropdown.attr("id")) {
			toggleTarget.attr("is-toggled", "true");
			toggleTarget.fadeToggle(350);
		}
	} else if (accountDropdown.attr("is-toggled") == "true") {
		accountDropdown.attr("is-toggled", "false");
		accountDropdown.fadeToggle(350);
		if (toggleTarget.attr("id") != accountDropdown.attr("id")) {
			toggleTarget.attr("is-toggled", "true");
			toggleTarget.fadeToggle(350);
		}
	} else {
		toggleTarget.attr("is-toggled", "true");
		toggleTarget.fadeToggle(350);
	}
});

$('#page-wrapper, .ucp .temp-fix-for-header').click(function () {
	var toggleTarget = $(".dropdown-menu[is-toggled='true']");
	toggleTarget.attr("is-toggled", "false");
	toggleTarget.fadeOut(350);
});

/* Quickly retrieve information on how far the user has scrolled */
function getScrollPercentage() {
	var scrollPercent =
		(100 * $(window).scrollTop()) / ($(document).height() - $(window).height());
	return scrollPercent;
}

/* Used to update the scroll progress bar */
function updateScrollProgress() {
	var scrollPercent = getScrollPercentage();
	var convertedPercent = scrollPercent.toFixed(1) + "%";
}

function headerTransition() {
	var scrollPercent = getScrollPercentage();
	var header = $("header");
	var ascheader = $(".asc-navbar");

	if (scrollPercent < 1) {
		if (header.hasClass("sticky-header")) {
			header.removeClass("sticky-header");
			if (!ascheader.hasClass("asc-sticky-header"))
				ascheader.addClass("asc-sticky-header");
		}
	} else {
		if (!header.hasClass("sticky-header")) {
			header.addClass("sticky-header");
			ascheader.removeClass("asc-sticky-header");
		}
	}
}
