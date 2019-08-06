'use strict';

function admin() {
	
	const setDefault = document.querySelector('.voss-set-default input[type=checkbox]');
	if (setDefault != null) {
		if (setDefault.checked == false) {
			setDefault.click();
		}
	}
	
	const dataBg = document.querySelectorAll('[data-bg]');
	dataBg.forEach( function(el) {
		var attr = el.getAttribute('data-bg')
		el.style.backgroundImage = 'url('+ attr +')';
	});
	
	const dataColor = document.querySelectorAll('[data-color]');
	dataColor.forEach( function(el) {
		var attr = el.getAttribute('data-color')
		el.style.backgroundColor = ''+ attr +'';
	});
	    
}

function ready(fn) {
	if (document.readyState != 'loading') {
		fn();
    } else {
		document.addEventListener('DOMContentLoaded', fn);
	}
}

function completeAjax(fn) {
	const send = XMLHttpRequest.prototype.send
    XMLHttpRequest.prototype.send = function() { 
        this.addEventListener('load', function() {
            fn();
        })
        return send.apply(this, arguments)
    }
}

window.ready( function() {
    admin();
});

window.completeAjax( function() {
    admin();
});
