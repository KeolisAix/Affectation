var nbfonctionnement = "";
var Autorise = 0;
var TRange = null; //findString
var tabRegles = [];
var ChaineSQL = "";
function dateDiff(date1, date2) {
    dateun = new Date('2016-02-19 ' + date1);
    datedeux = new Date('2016-02-19 ' + date2);
    recupminute = 0;
    var diff = {} // Initialisation du retour
    var tmp = datedeux - dateun;
    tmp = Math.floor(tmp / 1000); // Nombre de secondes entre les 2 dates
    diff.sec = tmp % 60; // Extraction du nombre de secondes
    tmp = Math.floor((tmp - diff.sec) / 60); // Nombre de minutes (partie entière)
    diff.min = tmp % 60; // Extraction du nombre de minutes
    if (diff.min >= 15 && diff.min < 30) {
        recupminute = 1
    }
    if (diff.min >= 30 && diff.min < 45) {
        recupminute = 2
    }
    if (diff.min >= 45 && diff.min <= 59) {
        recupminute = 3
    }
    tmp = Math.floor((tmp - diff.min) / 60); // Nombre d'heures (entières)
    diff.hour = tmp % 24; // Extraction du nombre d'heures
    tmp = Math.floor((tmp - diff.hour) / 24); // Nombre de jours restants
    diff.day = tmp;
    tmp = Math.floor((diff.hour) * 4);
    diff.quart = tmp + recupminute
    return diff.quart;
}
function mySaveContent(tbl, type) {
    var query = '', // define query parameter
		tbl_start, // table loop starts from tbl_start parameter
		tbl_end, // table loop ends on tbl_end parameter
		tbl_rows, // number of table rows
		cells, // number of cells in the current row
		tbl_cell, // reference to the table cell
		cn, // reference to the child node
		id, r, c, d, i, // variables used in for loops
		inputField, // input field reference inside DIV element
		JSONarray, // array of values for JSON object
		JSONobj = [], // prepare JSON object
		pname = REDIPS.drag.saveParamName; // set parameter name (default is 'p')
    // if input parameter is string, then set reference to the table
    if (typeof (tbl) === 'string') {
        tbl = document.getElementById(tbl);
    }
    // tbl should be reference to the TABLE object
    if (tbl !== undefined && typeof (tbl) === 'object' && tbl.nodeName === 'TABLE') {
        // define number of table rows
        tbl_rows = tbl.rows.length;
        // iterate through each table row
        for (r = 0; r < tbl_rows; r++) {
            // set the number of cells in the current row
            cells = tbl.rows[r].cells.length;
            // iterate through each table cell
            for (c = 0; c < cells; c++) {
                // set reference to the table cell
                tbl_cell = tbl.rows[r].cells[c];
                // if cells is not empty (no matter is it allowed or denied table cell) 
                if (tbl_cell.childNodes.length > 0) {
                    // cell can contain many DIV elements
                    for (d = 0; d < tbl_cell.childNodes.length; d++) {
                        // set reference to the child node
                        cn = tbl_cell.childNodes[d];
                        // childNode should be DIV with containing drag class name
                        // and yes, it should be uppercase
                        if (cn.nodeName === 'DIV' && cn.className.indexOf('drag') > -1) {
                            // prepare query string
                            query += pname + '[]=' + cn.id + '_' + r + '_' + c;
                            // initialize JSONarray array
                            JSONarray = [cn.id, r, c];
                            // try to find input elements inside DIV element
                            inputField = cn.getElementsByTagName('input');
                            // loop goes through all found input elements
                            for (i = 0; i < inputField.length; i++) {
                                query += '_' + inputField[i].value;
                                JSONarray.push(inputField[i].value);
                            }
                            // add '&' to the data set
                            query += '&';
                            // push values for DIV element as Array to the Array
                            JSONobj.push(JSONarray);
                        }
                    }
                }
            }
        }
        // prepare query string in JSON format (only if array is not empty)
        if (type === 'json' && JSONobj.length > 0) {
            query = JSON.stringify(JSONobj);
        } else {
            // cut last '&' from query string
            query = query.substring(0, query.length - 1);
        }
    }
    // return prepared parameters (if tables are empty, returned value could be empty too) 
    console.log(query);
    var encodebtoa = btoa(query);
    var dataURL
    html2canvas(document.body, {
        onrendered: function(canvas) {
            dataURL = canvas.toDataURL();
            console.log(dataURL);
            insertHistorique(encodebtoa, imgencode);
        }
    });
    var imgencode = btoa(dataURL);
    console.log("image : " + imgencode)
    var imgdecode = atoa(imgencode);
    console.log("image Decode : " + imgdecode)
    return encodebtoa;
};
function GetRegle() {
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //tabRegles = xmlhttp.responseText
            tabRegles = JSON.parse(xmlhttp.responseText);
            console.log(tabRegles)
        }
    }

    xmlhttp.open("GET", "../login/requete.php?regles=1", true);
    xmlhttp.send();
}
function testdrop(me) {
    var MaintenanceON = document.getElementById("MaintenanceON").checked
    if (MaintenanceON == false) {
        try {
            if (document.getElementById(me).parentElement.parentElement.id != document.getElementById(me + "c0").parentElement.parentElement.id) {
                document.getElementById(me + "c0").remove()
                document.getElementById(me + "c1").remove()
            }
        } catch (error) { }
        //SI, La classe du conteneur de ME est differente que 0, que Me n'existe pas deja et que je suis dans Fonctionnement
        if (document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe").length != 0 && document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe")[0].childNodes.length == 0 && document.getElementById(me).parentElement.className == "fonctionnement") {
            var copy1 = document.getElementById(me).cloneNode(true);
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe")[0].appendChild(copy1);
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe")[0].childNodes[0].id = me + "c0";
            if (document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe deux").length != 0) {
                var copy2 = document.getElementById(me).cloneNode(true);
                document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe deux")[0].appendChild(copy2);
                document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe deux")[0].childNodes[0].id = me + "c1";
            }
        }
        //SI, La classe du conteneur de ME est differente que 0, que Me n'existe pas deja et que je suis dans Fonctionnement coupe
        if (document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe").length != 0 && document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe")[0].childNodes.length == 0 && document.getElementById(me).parentElement.className == "fonctionnement coupe" && document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement")[0].childNodes.length == 0) {
            var copy1 = document.getElementById(me).cloneNode(true);
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement")[0].appendChild(copy1);
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement")[0].childNodes[0].id = me + "c0";
            if (document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe deux").length != 0) {
                var copy2 = document.getElementById(me).cloneNode(true);
                document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe deux")[0].appendChild(copy2);
                document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe deux")[0].childNodes[0].id = me + "c1";
            }
        }
        //SI, La classe du conteneur de ME est differente que 0, que Me n'existe pas deja et que je suis dans Fonctionnement coupe
        if (document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe").length != 0 && document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe")[0].childNodes.length == 0 && document.getElementById(me).parentElement.className == "fonctionnement coupe deux" && document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement")[0].childNodes.length == 0 && document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe")[0].childNodes.length == 0) {
            var copy1 = document.getElementById(me).cloneNode(true);
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement")[0].appendChild(copy1);
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement")[0].childNodes[0].id = me + "c0";
            var copy2 = document.getElementById(me).cloneNode(true);
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe")[0].appendChild(copy2);
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe")[0].childNodes[0].id = me + "c1";
        }
        try {
            ReglageCellule(me);
            ReglageCellule(me + "c0");
            ReglageCellule(me + "c1");
        } catch (error) {
            ReglageCellule(me);
        }
        CheckRegle(me);
    }
}
function ReglageCellule(me) {
    Recolor(me)
    CheckRegle(me);
    try{
        RemoveTooltip();
    } catch (error) {

    }
    if (document.getElementById(me).parentElement.className == "fonctionnement") {
        try {
            nbfonctionnement = document.getElementById(me).parentElement.parentElement.getElementsByTagName("td")[1].innerHTML.split("-")[0]
            var taillediv = nbfonctionnement * 20 //23.80
            document.getElementById(me).style.width = taillediv + "px"
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement")[0].appendChild(document.getElementById(me))
        } catch (error) {
            return true;
        }
    }
    if (document.getElementById(me).parentElement.className == "fonctionnement coupe") {
        try {
            nbfonctionnement = document.getElementById(me).parentElement.parentElement.getElementsByTagName("td")[1].innerHTML.split("-")[1]
            var taillediv = nbfonctionnement * 20
            document.getElementById(me).style.width = taillediv + "px"
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe")[0].appendChild(document.getElementById(me))
        } catch (error) {
            return true;
        }
    }
    if (document.getElementById(me).parentElement.className == "fonctionnement coupe deux") {
        try {
            nbfonctionnement = document.getElementById(me).parentElement.parentElement.getElementsByTagName("td")[1].innerHTML.split("-")[2]
            var taillediv = nbfonctionnement * 20
            document.getElementById(me).style.width = taillediv + "px"
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe deux")[0].appendChild(document.getElementById(me))
        } catch (error) {
            return true;
        }
    }
    if (document.getElementById(me).parentElement.className == "reset") {
        ResizeCellule(me);
        document.getElementById(me).style.backgroundColor = document.getElementById(me).parentElement.childNodes[2].style.backgroundColor
        try {
            RangementDesBus(document.getElementById(me).parentElement.id)
        } catch (error) {
            return true;
        }
    }
}
function insertHistorique(chaine, dataURL) {
    var params = "chaine=" + chaine + "&da=" + DateDeAffectation + "&img=" + dataURL + "&fin=0";
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            console.log(xmlhttp.responseText);
            createAlert('', 'Sauvegarde Effectuée!', 'La sauvegarde a bien été enregistrée', 'success', true, true, 'pageMessages');
        }
    }
    xmlhttp.open("POST", "../login/requete.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", params.length);
    xmlhttp.setRequestHeader("Connection", "close");
    console.log("xmlhttp.send("+params+");")
    xmlhttp.send(params);
}
function removeElementsByClass(className) {
    var elements = document.getElementsByClassName(className);
    while (elements.length > 0) {
        elements[0].parentNode.removeChild(elements[0]);
    }
}
function RemoveCell(codetache) {
    var count = $("tr[class*='" + codetache + "']").length;
    for (var i = 1; i < count; i++) {
        $("tr[class*='" + codetache + "']")[i].remove();
    }
}
function Tooltip(etat) {
    $(function () {
        $(document).tooltip({
            items: "[title]",
            disabled: etat,
            content: function () {
                var element = $(this);
                if (element.is("[title]")) {
                    return element.attr("title");
                }
            }

        });
    });
}
function hide(me, tab) {
    me = document.getElementById(me)
    if (me.checked == true) {
        for (var i = 2; i < document.getElementById(tab).childNodes.length; i++) {
            if (document.getElementById(tab).childNodes[i].className != "vehicule") {
                document.getElementById(tab).childNodes[i].style.display = "none"
                console.log(document.getElementById(tab).childNodes[i].className)
            }
        }
    }
    if (me.checked == false) {
        for (var i = 2; i < document.getElementById(tab).childNodes.length; i++) {
            if (document.getElementById(tab).childNodes[i].className != "vehicule") {
                document.getElementById(tab).childNodes[i].style.display = "inline-block"
            }
        }
    }
}
function createAlert(title, summary, details, severity, dismissible, autoDismiss, appendToId) {
    var iconMap = {
        info: "fa fa-info-circle",
        success: "fa fa-thumbs-up",
        warning: "fa fa-exclamation-triangle",
        danger: "fa ffa fa-exclamation-circle"
    };

    var iconAdded = false;

    var alertClasses = ["alert", "animated", "flipInX"];
    alertClasses.push("alert-" + severity.toLowerCase());

    if (dismissible) {
        alertClasses.push("alert-dismissible");
    }

    var msgIcon = $("<i />", {
        "class": iconMap[severity] // you need to quote "class" since it's a reserved keyword
    });

    var msg = $("<div />", {
        "class": alertClasses.join(" ") // you need to quote "class" since it's a reserved keyword
    });

    if (title) {
        var msgTitle = $("<h4 />", {
            html: title
        }).appendTo(msg);

        if (!iconAdded) {
            msgTitle.prepend(msgIcon);
            iconAdded = true;
        }
    }

    if (summary) {
        var msgSummary = $("<strong />", {
            html: summary
        }).appendTo(msg);

        if (!iconAdded) {
            msgSummary.prepend(msgIcon);
            iconAdded = true;
        }
    }

    if (details) {
        var msgDetails = $("<p />", {
            html: details
        }).appendTo(msg);

        if (!iconAdded) {
            msgDetails.prepend(msgIcon);
            iconAdded = true;
        }
    }


    if (dismissible) {
        var msgClose = $("<span />", {
            "class": "close", // you need to quote "class" since it's a reserved keyword
            "data-dismiss": "alert",
            html: "<i class='fa fa-times-circle'></i>"
        }).appendTo(msg);
    }

    $('#' + appendToId).prepend(msg);

    if (autoDismiss) {
        setTimeout(function () {
            msg.addClass("flipOutX");
            setTimeout(function () {
                msg.remove();
            }, 1000);
        }, 5000);
    }
}
function generate_excel(tableid) {
    var table = document.getElementById(tableid);
    var html = table.outerHTML;
    window.open('data:application/vnd.ms-excel;base64,' + base64_encode(html));
    //console.log('data:application/vnd.ms-excel;base64,' + base64_encode(html));
}
function base64_encode(data) {
    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
                ac = 0,
                enc = "",
                tmp_arr = [];

    if (!data) {
        return data;
    }

    do { // pack three octets into four hexets
        o1 = data.charCodeAt(i++);
        o2 = data.charCodeAt(i++);
        o3 = data.charCodeAt(i++);

        bits = o1 << 16 | o2 << 8 | o3;

        h1 = bits >> 18 & 0x3f;
        h2 = bits >> 12 & 0x3f;
        h3 = bits >> 6 & 0x3f;
        h4 = bits & 0x3f;

        // use hexets to index into b64, and append result to encoded string
        tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
    } while (i < data.length);

    enc = tmp_arr.join('');

    var r = data.length % 3;

    return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);

}
function FiltrageParLigne(ligne) {
    var i;
    for (i = 2; i <= document.getElementById("contenue").childNodes[1].childElementCount; i++) {
        if (document.getElementById("contenue").childNodes[1].childNodes[i].childNodes[0].parentElement.style.display == "none") {
            document.getElementById("contenue").childNodes[1].childNodes[i].childNodes[0].parentElement.style.display = "table-row"
        }
        if (document.getElementById("contenue").childNodes[1].childNodes[i].childNodes[0].innerHTML.indexOf("Ligne : " + ligne) < 0 && document.getElementById("contenue").childNodes[1].childNodes[i].childNodes[0].innerHTML.indexOf("-" + ligne) < 0) {
            document.getElementById("contenue").childNodes[1].childNodes[i].childNodes[0].parentElement.style.display = "none"
        }

    }
}
function FiltrageParVehicule(Vehicule) {
    if (parseInt(navigator.appVersion) < 4) return;
    var strFound;
    if (window.find) {

        // CODE FOR BROWSERS THAT SUPPORT window.find

        strFound = self.find(Vehicule);
        if (strFound) {
            for (i = 0; i <= document.getElementsByClassName("bus").length; i++) {
                document.getElementsByClassName("bus")[i].style.display = "none"
                document.getElementById(Vehicule).style.display = "inline-block"
            }
            
        }
        if (!strFound) {
            strFound = self.find(Vehicule, 0, 1);
            while (self.find(Vehicule, 0, 1)) continue;
        }
    }
    else if (navigator.appName.indexOf("Microsoft") != -1) {

        // EXPLORER-SPECIFIC CODE

        if (TRange != null) {
            TRange.collapse(false);
            strFound = TRange.findText(Vehicule);
            if (strFound) TRange.select();
        }
        if (TRange == null || strFound == 0) {
            TRange = self.document.body.createTextRange();
            strFound = TRange.findText(Vehicule);
            if (strFound) TRange.select();
        }
    }
    else if (navigator.appName == "Opera") {
        alert("Opera browsers not supported, sorry...")
        return;
    }
    if (!strFound) {
        for (i = 0; i <= document.getElementsByClassName("bus").length; i++) {
            document.getElementsByClassName("bus")[i].style.display = "inline-block"
        }
    }
    return;
}
function RangementDesBus(hello) {
    var list = document.getElementById(hello);

    var items = list.childNodes;
    var itemsArr = [];
    for (var i in items) {
        if (items[i].nodeType == 1) { // get rid of the whitespace text nodes
            itemsArr.push(items[i]);
        }
    }

    itemsArr.sort(function (a, b) {
        return a.id == b.id
                ? 0
                : (a.id > b.id ? 1 : -1);
    });

    for (i = 0; i < itemsArr.length; ++i) {
        list.appendChild(itemsArr[i]);
    }
}
function ResizeCellule(me) {
    document.getElementById(me).style.width = '136px'
}
function RemoveTooltip() {
    for (var i = 0; i <= document.getElementsByClassName("ui-tooltip ui-widget ui-corner-all ui-widget-content").length; i++) {
        document.getElementsByClassName("ui-tooltip ui-widget ui-corner-all ui-widget-content")[i].remove();
    }

}
function CheckRegle(me) {
    try{
        if (document.getElementById(me).parentElement.parentElement.childNodes[0].innerHTML == Autorise) {
            if (document.getElementById(me).parentElement.parentElement.childNodes[0].innerHTML.split("Ligne : ")[1].indexOf("-") >= 0) {
                var PremiereLigne = document.getElementById(me).parentElement.parentElement.childNodes[0].innerHTML.split("Ligne : ")[1].split("-")[0]
                var DeuxiemeLigne = document.getElementById(me).parentElement.parentElement.childNodes[0].innerHTML.split("Ligne : ")[1].split("-")[1]
                try {
                    var TroisiemeLigne = document.getElementById(me).parentElement.parentElement.childNodes[0].innerHTML.split("Ligne : ")[1].split("-")[2]
                } catch (error) { }
                if (tabRegles[PremiereLigne].indexOf(document.getElementById(me).className.split(" ")[3], 0) >= 0 || tabRegles[DeuxiemeLigne].indexOf(document.getElementById(me).className.split(" ")[3], 0) >= 0 || tabRegles[TroisiemeLigne].indexOf(document.getElementById(me).className.split(" ")[3], 0) >= 0) {
                    document.getElementById(me).style.backgroundColor = "yellow"
                    document.getElementById(me).style.color = "black"
                }
            } else {
                var Ligne = document.getElementById(me).parentElement.parentElement.childNodes[0].innerHTML.split("Ligne : ")[1]
                if (tabRegles[Ligne].indexOf(document.getElementById(me).className.split(" ")[3], 0) >= 0) {
                    document.getElementById(me).style.backgroundColor = "yellow"
                    document.getElementById(me).style.color = "black"
                }
            }
        } else {
            Autorise = document.getElementById(me).parentElement.parentElement.childNodes[0].innerHTML;
        }
    } catch (error) {

    }
}
function Recolor(me) {
    var modele = document.getElementById(me).className.split(" ")[3]
    if (modele == "citaro") { document.getElementById(me).style.backgroundColor = "rgb(245, 245, 220)" }
    if (modele == "city") { document.getElementById(me).style.backgroundColor = "rgb(240, 255, 240)" }
    if (modele == "crossway") { document.getElementById(me).style.backgroundColor = "rgb(230, 230, 250)" }
    if (modele == "gx") { document.getElementById(me).style.backgroundColor = "rgb(255, 250, 205)" }
    if (modele == "setra") { document.getElementById(me).style.backgroundColor = "rgb(211, 211, 211)" }
}
function getRemplacement(me) {
    bootbox.dialog({
        title: "Remplacement de Bus",
        message: '<div class="row">  ' +
            '<div class="col-md-12"> ' +
            '<form class="form-horizontal"> ' +
            '<div class="form-group"> ' +
            '<label class="col-md-5 control-label" for="bus">Numero de bus : </label> ' +
            '<div class="col-md-4"> ' +
            '<input id="bus" name="bus" type="text" placeholder="127001" class="form-control input-md"></div> ' +
            '</div> ' +
            '<div class="form-group"> ' +
            '<label class="col-md-5 control-label" for="heureDebut">Heure de Remplacement :</label> ' +
            '<div class="col-lg-4" style="display: inline-flex;"> ' +
            '<input id="heureDebut" name="heureDebut" type="text" placeholder="12:00" class="form-control input-md"></div><label class="col-md-9 control-label"></div> ' +
            '</div> </div>' +
            '</form> </div>  </div>',
        buttons: {
            success: {
                label: "Remplacer",
                className: "btn-success",
                callback: function () {
                    var BusQuiRemplace = $('#bus').val();
                    var heureDebut = $('#heureDebut').val();
                    var heureFin = document.getElementById(me).parentElement.parentElement.getElementsByClassName("redips-mark fin")[0].innerHTML
                    //var AllService = $("input[name='AllService']:checked").val()
                    var nbdebut = dateDiff("05:00", heureDebut)
                    var nbfin = dateDiff(heureDebut, heureFin) - 1
                    //console.log(me, BusQuiRemplace, nbdebut, nbfin)
                    writeRemplacement(me, BusQuiRemplace, nbdebut, nbfin, heureDebut)
                }
            }
        }
    }
  );
}
function writeRemplacement(me, BusQuiRemplace, debut, fin, heureDebut) {
    if (document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre").length > 0 && document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre deux").length <= 0) {
        var HeureElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre")[0].innerHTML
        if (heureDebut <= HeureElement) { // SI PREMIERE PARTIE DU COUPE
            console.log("ok")
            var finpremier = dateDiff(heureDebut, HeureElement) + 1
            document.getElementById(me).parentElement.parentElement.style.height = "75px"
            document.getElementById(me).style.top = "-15px"
            document.getElementById(me).parentElement.parentElement.getElementsByTagName("td")[debut + 2].appendChild(document.getElementById(BusQuiRemplace))
            document.getElementById(me).style.background = "repeating-linear-gradient(45deg,white,white 10px,#ccc 10px,#ccc 20px)"
            document.getElementById(me).onmouseout = null;
            document.getElementById(BusQuiRemplace).style.width = 20 * finpremier
            document.getElementById(BusQuiRemplace).onmouseout = null;
            //CLONE
            var lenghtElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre").length - 1
            var HeureDebutElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre")[lenghtElement].innerHTML
            var HeureFinElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("fin")[0].innerHTML
            var findeuxieme = dateDiff(HeureDebutElement, HeureFinElement) + 1
            document.getElementById(me).parentElement.parentElement.style.height = "75px"
            document.getElementById(me).style.top = "-15px"
            var copy1 = document.getElementById(BusQuiRemplace).cloneNode(true);
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe")[0].appendChild(copy1)
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe")[0].childNodes[1].id = BusQuiRemplace + "z0";
            document.getElementById(me).style.background = "repeating-linear-gradient(45deg,white,white 10px,#ccc 10px,#ccc 20px)"
            document.getElementById(me).onmouseout = null;
            document.getElementById(BusQuiRemplace + "z0").style.width = 20 * findeuxieme
            document.getElementById(BusQuiRemplace + "z0").onmouseout = null;
            document.getElementById(BusQuiRemplace + "z0").parentElement.childNodes[0].style.background = "repeating-linear-gradient(45deg,white,white 10px,#ccc 10px,#ccc 20px)"
            document.getElementById(BusQuiRemplace).style.top = "15"

        }
        if (heureDebut > HeureElement) { // SI Deuxieme PARTIE DU COUPE
            var HeureFinElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("fin")[0].innerHTML
            var fincoupe = dateDiff(heureDebut, HeureFinElement) + 1
            document.getElementById(me).parentElement.parentElement.style.height = "75px"
            document.getElementById(me).style.top = "-15px"
            document.getElementById(me).parentElement.parentElement.getElementsByTagName("td")[debut + 2].appendChild(document.getElementById(BusQuiRemplace))
            document.getElementById(me).style.background = "repeating-linear-gradient(45deg,white,white 10px,#ccc 10px,#ccc 20px)"
            document.getElementById(me).onmouseout = null;
            document.getElementById(BusQuiRemplace).style.width = 20 * fincoupe
            document.getElementById(BusQuiRemplace).onmouseout = null;
            document.getElementById(BusQuiRemplace).style.top = "15"

        }
    } //SI YA UN COUPE
    if (document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre").length <= 0) { 
        document.getElementById(me).parentElement.parentElement.style.height = "75px"
        document.getElementById(me).style.top = "-15px"
        document.getElementById(me).parentElement.parentElement.getElementsByTagName("td")[debut + 2].appendChild(document.getElementById(BusQuiRemplace))
        document.getElementById(me).style.background = "repeating-linear-gradient(45deg,white,white 10px,#ccc 10px,#ccc 20px)"
        document.getElementById(me).onmouseout = null;
        document.getElementById(BusQuiRemplace).style.top = "15"
        document.getElementById(BusQuiRemplace).style.width = 20 * fin
        document.getElementById(BusQuiRemplace).onmouseout = null;
    } //SI PAS DE COUPE
    if (document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre").length > 0 && document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre deux").length > 0) {
        var HeureElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre")[0].innerHTML
        var lenghtElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre deux").length - 1
        var HeureDebutElementCoupeDeux = document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre deux")[lenghtElement].innerHTML
        if (heureDebut <= HeureElement) { // SI PREMIERE PARTIE DU COUPE
            console.log("1")
            var finpremier = dateDiff(heureDebut, HeureElement) + 1
            document.getElementById(me).parentElement.parentElement.style.height = "75px"
            document.getElementById(me).style.top = "-15px"
            document.getElementById(me).parentElement.parentElement.getElementsByTagName("td")[debut + 2].appendChild(document.getElementById(BusQuiRemplace))
            document.getElementById(me).style.background = "repeating-linear-gradient(45deg,white,white 10px,#ccc 10px,#ccc 20px)"
            document.getElementById(me).onmouseout = null;
            document.getElementById(BusQuiRemplace).style.width = 20 * finpremier
            document.getElementById(BusQuiRemplace).onmouseout = null;
            //CLONE
            var lenghtElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre").length - 1
            var HeureDebutElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre")[lenghtElement].innerHTML
            var HeureFinElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("fin")[0].innerHTML
            var findeuxieme = dateDiff(HeureDebutElement, HeureFinElement) + 1
            var copy1 = document.getElementById(BusQuiRemplace).cloneNode(true);
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe")[0].appendChild(copy1)
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe")[0].childNodes[1].id = BusQuiRemplace + "z0";
            document.getElementById(me).style.background = "repeating-linear-gradient(45deg,white,white 10px,#ccc 10px,#ccc 20px)"
            document.getElementById(me).onmouseout = null;
            document.getElementById(BusQuiRemplace + "z0").style.width = 20 * findeuxieme
            document.getElementById(BusQuiRemplace + "z0").onmouseout = null;
            document.getElementById(BusQuiRemplace + "z0").parentElement.childNodes[0].style.background = "repeating-linear-gradient(45deg,white,white 10px,#ccc 10px,#ccc 20px)"
            //document.getElementById(BusQuiRemplace).style.top = "15"
            //CLONE TRIPLE
            if (document.getElementById(me).parentElement.parentElement.getElementsByClassName("coupe deux").length > 0) {
                var lenghtElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre deux").length - 1
                var HeureDebutElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre deux")[lenghtElement].innerHTML
                var HeureFinElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("fin")[0].innerHTML
                var fintriple = dateDiff(HeureDebutElement, HeureFinElement) + 1
                var copy2 = document.getElementById(BusQuiRemplace).cloneNode(true);
                document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe deux")[0].appendChild(copy2)
                document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe deux")[0].childNodes[1].id = BusQuiRemplace + "z1";
                document.getElementById(me).style.background = "repeating-linear-gradient(45deg,white,white 10px,#ccc 10px,#ccc 20px)"
                document.getElementById(me).onmouseout = null;
                document.getElementById(BusQuiRemplace + "z1").style.width = 20 * fintriple
                document.getElementById(BusQuiRemplace + "z1").onmouseout = null;
                document.getElementById(BusQuiRemplace + "z1").parentElement.childNodes[0].style.background = "repeating-linear-gradient(45deg,white,white 10px,#ccc 10px,#ccc 20px)"
            }

        }
        var lenghtElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre").length - document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre deux").length - 1
        var HeureElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre")[lenghtElement].innerHTML
        var HeureDebutElementCoupeDeux = document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre deux")[0].innerHTML
        console.log("HD=>" + heureDebut + "HE=>" + HeureElement + "HDECD=>" + HeureDebutElementCoupeDeux)
        if (heureDebut > HeureElement && HeureElement < HeureDebutElementCoupeDeux) { // SI Deuxieme PARTIE DU COUPE
            console.log("2")
            var HeureFinElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("fin")[0].innerHTML
            var fincoupe = dateDiff(heureDebut, HeureDebutElementCoupeDeux) + 1
            document.getElementById(me).parentElement.parentElement.style.height = "75px"
            document.getElementById(me).style.top = "-15px"
            document.getElementById(me).parentElement.parentElement.getElementsByTagName("td")[debut + 2].appendChild(document.getElementById(BusQuiRemplace))
            document.getElementById(me).style.background = "repeating-linear-gradient(45deg,white,white 10px,#ccc 10px,#ccc 20px)"
            document.getElementById(me).onmouseout = null;
            document.getElementById(BusQuiRemplace).style.width = 20 * fincoupe
            document.getElementById(BusQuiRemplace).onmouseout = null;
            document.getElementById(BusQuiRemplace).style.top = "15"
            var lenghtElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre deux").length - 1
            var HeureDebutElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("entre deux")[lenghtElement].innerHTML
            var HeureFinElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("fin")[0].innerHTML
            var findeuxieme = dateDiff(HeureDebutElement, HeureFinElement) + 1
            document.getElementById(me).parentElement.parentElement.style.height = "75px"
            var copy1 = document.getElementById(BusQuiRemplace).cloneNode(true);
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe deux")[0].appendChild(copy1)
            document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement coupe deux")[0].childNodes[1].id = BusQuiRemplace + "z0";
            document.getElementById(me).style.background = "repeating-linear-gradient(45deg,white,white 10px,#ccc 10px,#ccc 20px)"
            document.getElementById(me).onmouseout = null;
            document.getElementById(BusQuiRemplace + "z0").style.width = 20 * findeuxieme
            document.getElementById(BusQuiRemplace + "z0").onmouseout = null;
            document.getElementById(BusQuiRemplace + "z0").parentElement.childNodes[0].style.background = "repeating-linear-gradient(45deg,white,white 10px,#ccc 10px,#ccc 20px)"

        }
        if (heureDebut > HeureDebutElementCoupeDeux && HeureElement < HeureDebutElementCoupeDeux) { // SI Troisieme PARTIE DU COUPE
            console.log("3")
            var HeureFinElement = document.getElementById(me).parentElement.parentElement.getElementsByClassName("fin")[0].innerHTML
            var fincoupe = dateDiff(heureDebut, HeureFinElement) + 1
            document.getElementById(me).parentElement.parentElement.style.height = "75px"
            document.getElementById(me).style.top = "-15px"
            document.getElementById(me).parentElement.parentElement.getElementsByTagName("td")[debut + 2].appendChild(document.getElementById(BusQuiRemplace))
            document.getElementById(me).style.background = "repeating-linear-gradient(45deg,white,white 10px,#ccc 10px,#ccc 20px)"
            document.getElementById(me).onmouseout = null;
            document.getElementById(BusQuiRemplace).style.width = 20 * fincoupe
            document.getElementById(BusQuiRemplace).onmouseout = null;
            document.getElementById(BusQuiRemplace).style.top = "15"

        }
    }
}
function getChaine(id) {
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var chaine2 = "";
            var chaineEncoded = xmlhttp.responseText;
            var chaine = atob(chaineEncoded)
            var chainesplit = chaine.split("p[]=")
            var chaineslice = chainesplit.slice(1)
            console.log(chaineslice)
            chaineslice.forEach(function (entry, index) {
                chaine2 = entry.split("_")
                chaine2[2] = chaine2[2].split("&")[0]
                var element = document.getElementById(chaine2[0])
                if (typeof (element) != 'undefined' && element != null) {
                    document.getElementById(chaine2[0]).remove();
                }
                document.getElementById('contenue').rows[chaine2[1]].cells[chaine2[2]].innerHTML = "<div id=" + chaine2[0] + " class=\"redips-drag ui-widget-content\" onmouseout=\"testdrop('" + chaine2[0] + "')\"  onclick=\"getRemplacement('" + chaine2[0] + "')\"  style=\"width: 695px, position: relative; background-color: white\">" + chaine2[0].split("c0")[0].split("c1")[0] + "</div>";
                testdrop(chaine2[0]);
            })
        }
    }

    xmlhttp.open("GET", "../login/requete.php?getChaine=" + id, true);
    xmlhttp.send();
}