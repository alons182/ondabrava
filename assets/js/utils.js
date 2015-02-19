function getScrollerWidth() {
	var scr = null;
	var inn = null;
	var wNoScroll = 0;
	var wScroll = 0;

	// Outer scrolling div
	scr = document.createElement('div');
	scr.style.position = 'absolute';
	scr.style.top = '-1000px';
	scr.style.left = '-1000px';
	scr.style.width = '100px';
	scr.style.height = '50px';
	// Start with no scrollbar
	scr.style.overflow = 'hidden';

	// Inner content div
	inn = document.createElement('div');
	inn.style.width = '100%';
	inn.style.height = '200px';

	// Put the inner div in the scrolling div
	scr.appendChild(inn);
	// Append the scrolling div to the doc
	document.body.appendChild(scr);

	// Width of the inner div sans scrollbar
	wNoScroll = inn.offsetWidth;
	// Add the scrollbar
	scr.style.overflow = 'auto';
	// Width of the inner div width scrollbar
	wScroll = inn.offsetWidth;

	// Remove the scrolling div from the doc
	document.body.removeChild(
		document.body.lastChild);

	// Pixel width of the scroller
	return (wNoScroll - wScroll);
}

function getWindowHeight() {
	var windowHeight=0;
	if (typeof(window.innerHeight)=='number') {
		windowHeight=window.innerHeight;
	} else {
		if (document.documentElement && document.documentElement.clientHeight) {
			windowHeight = document.documentElement.clientHeight;
		} else {
			if (document.body && document.body.clientHeight) {
				windowHeight=document.body.clientHeight;
			}
		}
	}
	return windowHeight;
}

function getWindowWidth() {
	var windowWidth=0;
	if (typeof(window.innerWidth)=='number') {
		windowWidth=window.innerWidth;
	} else {
		if (document.documentElement && document.documentElement.clientWidth) {
			windowWidth = document.documentElement.clientWidth;
		} else {
			if (document.body && document.body.clientWidth) {
				windowWidth=document.body.clientWidth;
			}
		}
	}
	return windowWidth;
}



