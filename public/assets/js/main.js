/*
	Radius by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
*/

(function($) {

	skel.breakpoints({
		xlarge:	'(max-width: 1680px)',
		large:	'(max-width: 1280px)',
		medium:	'(max-width: 980px)',
		small:	'(max-width: 736px)',
		xsmall:	'(max-width: 480px)'
	});

	$(function() {

		var	$window = $(window),
			$body = $('body'),
			$header = $('#header'),
			$footer = $('#footer');

		// Disable animations/transitions until the page has loaded.
			$body.addClass('is-loading');

			$window.on('load', function() {
				window.setTimeout(function() {
					$body.removeClass('is-loading');
				}, 100);
			});

		// Fix: Placeholder polyfill.
			$('form').placeholder();

		// Prioritize "important" elements on medium.
			skel.on('+medium -medium', function() {
				$.prioritize(
					'.important\\28 medium\\29',
					skel.breakpoint('medium').active
				);
			});

		// Header.
			$header.each( function() {

				var t 		= jQuery(this),
					button 	= t.find('.button');

				button.click(function(e) {

					t.toggleClass('hide');

					if ( t.hasClass('preview') ) {
						return true;
					} else {
						e.preventDefault();
					}

				});

			});

		// Footer.
			$footer.each( function() {

				var t 		= jQuery(this),
					inner 	= t.find('.inner'),
					button 	= t.find('.info');

				button.click(function(e) {
					t.toggleClass('show');
					e.preventDefault();
				});

			});

	});

})(jQuery);


/* javascript for the date count down*/

var startDate = new Date("8/1/2020");
var endDate = new Date("4/24/2021");

var dif = endDate.getTime() - startDate.getTime();
var difToSecond = dif / 1000;
var defaultPercent = 0;


$(function() {
    $('#counter').countdown({
        until: endDate,
        layout: '<div></div>',
        onTick: updateBar
    });

    $('a[rel=tooltip]').tooltip();
    $('div[rel=tooltip]').tooltip();
});

function updateBar(periods) {

    fillSecondBar(periods[6]);
    fillMinuteBar(periods[5]);
    fillHourBar(periods[4]);
    fillDayBar(periods[3]);

    fillTotalbar(periods[6] + periods[5] * 60 + periods[4] * 60 * 60 + periods[3] * 60 * 60 * 24);
}

function fillSecondBar(percent) {
    $('#second-number').html(percent);
    $('#second-bar').css('width', percent * 100 / 60 + '%');
}

function fillMinuteBar(percent) {
    $('#minute-number').html(percent);
    $('#minute-bar').css('width', percent * 100 / 60 + '%');
}

function fillHourBar(percent) {
    $('#hour-number').html(percent);
    $('#hour-bar').css('width', percent * 100 / 24 + '%');
}

function fillDayBar(percent) {
    $('#day-number').html(percent);
    $('#day-bar').css('width', percent * 100 / 365 + '%');
}

function fillTotalbar(percent) {
    defaultPercent = 100 - 100 * percent / difToSecond;

    if (defaultPercent >= 10) {
        currentPercent = defaultPercent.toString().substr(0, 5);
    } else {
        currentPercent = defaultPercent.toString().substr(0, 4);
    }

    $('#total-bar').css('width', defaultPercent + '%').html(currentPercent + '%');
}