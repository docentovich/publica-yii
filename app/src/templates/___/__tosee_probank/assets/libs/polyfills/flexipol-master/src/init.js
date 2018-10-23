document.addEventListener('DOMContentLoaded', function onDOMReady(event) {

	var handleId,
	    called = 0,
	    links,
	    link,
	    i;

	window.pel = document.getElementById('demo1');
	window.chi = document.getElementsByClassName('flex-item')[0];
alert("1");
	// Do nothing on browsers that support flex
	if (typeof document.body.style.flex !== 'undefined') {
		return;
	}
	alert("1");

	links = document.getElementsByTagName('link');

	function addClass(selectors, className, attributes, debug) {

		var elements,
		    name,
		    ori,
		    el,
		    i,
		    j;

		for (i = 0; i < selectors.length; i++) {

			elements = document.querySelectorAll(selectors[i]);

			for (j = 0; j < elements.length; j++) {
				ori = (elements[j].className||'').trim();
				ori = (ori + ' ' + className).trim();

				elements[j].className = ori;

				for (name in attributes) {
					elements[j].setAttribute('data-flex-' + name, attributes[name]);
				}
			}
		}
	};

	window.addEventListener('resize', function() {

		if (handleId) {
			clearTimeout(handleId);
		}

		handleId = setTimeout(whenDone, 200);
	}, true);

	function whenDone() {

		var parents,
		    i;

		called++;

		if (called < links.length) {
			return;
		}

		parents = document.getElementsByClassName('js-p-flexParent');

		console.time('Applied Flexipol');
		for (var i = 0; i < parents.length; i++) {
			new FlexParent(parents[i]);
		}
		console.timeEnd('Applied Flexipol');
	}

	for (i = 0; i < links.length; i++) {
		(function(link) {

			var request = new XMLHttpRequest();

			request.onload = function loaded() {

				var i;

				code = ParseCSS(this.responseText);

				code.stylesheet.rules.forEach(function eachRule(rule) {

					if (rule.type !== 'rule') {
						return;
					}

					rule.declarations.forEach(function eachDeclaration(dec) {

						// Found one!
						if (dec.property == 'display' && dec.value == 'flex') {
							var a = $( rule.selectors[0] );
							var b = $( rule.selectors[0] ).attr('class');
							if( !$( rule.selectors[0] ).hasClass('js-p-flexParent') )
							addClass(rule.selectors, 'js-p-flexParent');
							// alert(" !rule.selectors! = " + JSON.stringify(rule.selectors) );
						} else if (dec.property == 'flex') {
							var a = $( rule.selectors[0] );
							var b = $( rule.selectors[0] ).attr('class');
							if( !$( rule.selectors[0] ).hasClass('js-p-flexChild') )
							addClass(rule.selectors, 'js-p-flexChild', {flex: dec.value}, true);
						} else if (dec.property == 'order') {
							var a = $( rule.selectors[0] );
							var b = $( rule.selectors[0] ).attr('class');
							if( !$( rule.selectors[0] ).hasClass('js-p-flexOrder') )
							addClass(rule.selectors, 'js-p-flexOrder', {order: dec.value});
						} else if (dec.property == 'flex-flow') {
							
							var a = $( rule.selectors[0] );
							var b = $( rule.selectors[0] ).attr('class');
							if( !$( rule.selectors[0] ).hasClass('js-p-flexFlow') )
							addClass(rule.selectors, 'js-p-flexFlow', {flow: dec.value});
						} else if (dec.property == 'justify-content') {

							var a = $( rule.selectors[0] );
							var b = $( rule.selectors[0] ).attr('class');
							if( !$( rule.selectors[0] ).hasClass('js-p-flexJustify') )
							addClass(rule.selectors, 'js-p-flexJustify', {justify: dec.value});
						} else if (dec.property == 'align-items') {

							var a = $( rule.selectors[0] );
							var b = $( rule.selectors[0] ).attr('class');
							if( !$( rule.selectors[0] ).hasClass('js-p-flexAlignItems') )
							addClass(rule.selectors, 'js-p-flexAlignItems', {'align-items': dec.value});
						}
						
						
					});
				});

				whenDone();
			};

			request.open('get', link.href, true);
			request.send();

		}(links[i]));
	}

});