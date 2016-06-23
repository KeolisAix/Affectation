/*jslint white: true, browser: true, undef: true, nomen: true, eqeqeq: true, plusplus: false, bitwise: true, regexp: true, strict: true, newcap: true, immed: true, maxerr: 14 */
/*global window: false, REDIPS: true */

/* enable strict mode */
"use strict";

// define headerInit and default indexURL / redipsURL variable
var headerInit,
	redipsURL = redipsURL || '/javascript/drag-and-drop-table-content/',
	indexURL = indexURL || '../';

// header initialization
headerInit = function () { 
	var header = document.createElement('div'),
		title = document.title;
	// add "header" DIV element
	document.body.insertBefore(header, document.body.firstChild);
	// apply inner HTML
	header.innerHTML = '<div style="background-color:#eee;padding:10px;text-align:center;font-size:20px;font-weight:bold">' + title + '</div><div id="date_heure"></div><div style="background-color:#eee"><center><button class="HideOnPrint" style="background-color: #eee;padding: 10px;text-align: center;font-weight: bold;" onclick="window.location=\'../../v0.8/login/test.php\'"><img src="../config/css/img/23.png">        Retour au menu</button><button class="HideOnPrint" style="background-color: #eee;padding: 10px;text-align: center;font-weight: bold;" onclick="mySaveContent(contenue);"><img src="../config/css/img/disk.png">        Sauvegarder l\'affectation</button><button class="HideOnPrint" style="background-color: #eee;padding: 10px;text-align: center;font-weight: bold;" onclick="window.print();"><img src="../config/css/img/imprimante.gif">        Imprimer l\'affectation</button></div></center>';
};
// add onload event listener
if (window.addEventListener) {
	window.addEventListener('load', headerInit, false);
}
else if (window.attachEvent) {
	window.attachEvent('onload', headerInit);
}

