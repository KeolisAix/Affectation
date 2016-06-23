var nbfonctionnement = "";
function HideMe(vehicule) {
    if(vehicule == "Citaro"){
        if (document.getElementById("citaroON").checked == false) {
            document.getElementById("tableCitaro").style.display = "none"
        }
        else {
            document.getElementById("tableCitaro").style.display = "block"
        }
    }
    if (vehicule == "City") {
        if (document.getElementById("cityON").checked == false) {
            document.getElementById("tableCity").style.display = "none"
        }
        else {
            document.getElementById("tableCity").style.display = "block"
        }
    }
    if (vehicule == "Crossway") {
        if (document.getElementById("crosswayON").checked == false) {
            document.getElementById("tableCrossway").style.display = "none"
        }
        else {
            document.getElementById("tableCrossway").style.display = "block"
        }
    }
    if (vehicule == "GX") {
        if (document.getElementById("gxON").checked == false) {
            document.getElementById("tableGX").style.display = "none"
        }
        else {
            document.getElementById("tableGX").style.display = "block"
        }
    }
    if (vehicule == "Setra") {
        if (document.getElementById("setraON").checked == false) {
            document.getElementById("tableSetra").style.display = "none"
        }
        else {
            document.getElementById("tableSetra").style.display = "block"
        }
    }
    
}

function AddCell(service) {
    for (var i = document.getElementById(service).cells.length; i < 74; i++) {
        document.getElementById(service).innerHTML = document.getElementById(service).innerHTML + '<td class="redips-mark"></td>'
    }
    var nbfonction = document.getElementById(service).getElementsByTagName("td").length - document.getElementById(service).getElementsByClassName("redips-mark").length
    document.getElementById(service).getElementsByTagName("td")[73].innerHTML = nbfonction
}

function dateDiff(date1, date2) {
    dateun = new Date('2016-02-19 '+date1);
    datedeux = new Date('2016-02-19 ' + date2);
    recupminute = 0;


    var diff = {}                           // Initialisation du retour
    var tmp = datedeux - dateun;

    tmp = Math.floor(tmp / 1000);             // Nombre de secondes entre les 2 dates
    diff.sec = tmp % 60;                    // Extraction du nombre de secondes

    tmp = Math.floor((tmp - diff.sec) / 60);    // Nombre de minutes (partie entière)
    diff.min = tmp % 60;                    // Extraction du nombre de minutes

    if (diff.min >= 15 && diff.min < 30) {
        recupminute = 1
    }
    if (diff.min >= 30 && diff.min < 45) {
        recupminute = 2
    }
    if (diff.min >= 45 && diff.min <= 59) {
        recupminute = 3
    }

    tmp = Math.floor((tmp - diff.min) / 60);    // Nombre d'heures (entières)
    diff.hour = tmp % 24;                   // Extraction du nombre d'heures

    tmp = Math.floor((tmp - diff.hour) / 24);   // Nombre de jours restants
    diff.day = tmp;

    tmp = Math.floor((diff.hour) *4);
    diff.quart = tmp + recupminute

    return diff.quart;
}

function mySaveContent(tbl, type) {
    var query = '',      // define query parameter
        tbl_start,       // table loop starts from tbl_start parameter
        tbl_end,         // table loop ends on tbl_end parameter
        tbl_rows,        // number of table rows
        cells,           // number of cells in the current row
        tbl_cell,        // reference to the table cell
        cn,              // reference to the child node
        id, r, c, d, i,  // variables used in for loops
        inputField,      // input field reference inside DIV element
        JSONarray,       // array of values for JSON object
        JSONobj = [],    // prepare JSON object
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
        }
        else {
            // cut last '&' from query string
            query = query.substring(0, query.length - 1);
        }
    }
    // return prepared parameters (if tables are empty, returned value could be empty too) 
    console.log(query);
    var encodebtoa = btoa(query);
    insertHistorique(encodebtoa);
    return encodebtoa;
};

function testdrop(me) {
    try{
    nbfonctionnement = document.getElementById(me).parentElement.parentElement.getElementsByTagName("td")[73].innerHTML
    var taillediv = nbfonctionnement * 23.80
    document.getElementById(me).style.width = taillediv + "px"
    
    //document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement")[0].innerHTML = "<div id=" + me + " class=\"redips-drag ui-widget-content\" onmouseout=\"testdrop('" + me + "')\" style=\"border-style: solid; cursor: move; width : " + taillediv + "px\">" + me + "</div>"
    document.getElementById(me).parentElement.parentElement.getElementsByClassName("fonctionnement")[0].appendChild(document.getElementById(me))
    }
    catch(error){
        return true;
    }
}
function insertHistorique(chaine) {

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
        }
    }

    xmlhttp.open("GET", "requete.php?chaine="+chaine, true);
    xmlhttp.send();
}