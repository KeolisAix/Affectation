var ladatehistorique;
var periode;
function Menu(menu) {
    if (menu == "Affectation") {
        document.getElementById("divAffectation").style.display = "block"
        document.getElementById("divHistorique").style.display = "none"
        document.getElementById("divRapport").style.display = "none"
        document.getElementById("divHASTUS").style.display = "none"
        document.getElementById("divVehicule").style.display = "none"
        document.getElementById("divDroit").style.display = "none"
    }
    if (menu == "Historique") {
        document.getElementById("divAffectation").style.display = "none"
        document.getElementById("divHistorique").style.display = "block"
        document.getElementById("divRapport").style.display = "none"
        document.getElementById("divHASTUS").style.display = "none"
        document.getElementById("divVehicule").style.display = "none"
        document.getElementById("divDroit").style.display = "none"
    }
    if (menu == "Rapport") {
        document.getElementById("divAffectation").style.display = "none"
        document.getElementById("divHistorique").style.display = "none"
        document.getElementById("divRapport").style.display = "block"
        document.getElementById("divHASTUS").style.display = "none"
        document.getElementById("divVehicule").style.display = "none"
        document.getElementById("divDroit").style.display = "none"
    }
    if (menu == "HASTUS") {
        document.getElementById("divAffectation").style.display = "none"
        document.getElementById("divHistorique").style.display = "none"
        document.getElementById("divRapport").style.display = "none"
        document.getElementById("divHASTUS").style.display = "block"
        document.getElementById("divVehicule").style.display = "none"
        document.getElementById("divDroit").style.display = "none"
    }
    if (menu == "Vehicule") {
        document.getElementById("divAffectation").style.display = "none"
        document.getElementById("divHistorique").style.display = "none"
        document.getElementById("divRapport").style.display = "none"
        document.getElementById("divHASTUS").style.display = "none"
        document.getElementById("divVehicule").style.display = "block"
        document.getElementById("divDroit").style.display = "none"
    }
    if (menu == "Droits") {
        document.getElementById("divAffectation").style.display = "none"
        document.getElementById("divHistorique").style.display = "none"
        document.getElementById("divRapport").style.display = "none"
        document.getElementById("divHASTUS").style.display = "none"
        document.getElementById("divVehicule").style.display = "none"
        document.getElementById("divDroit").style.display = "block"
    }
}
function HistoriqueAcc() {
    if (document.getElementById("lienhistorique").href.indexOf("&") < 0) {
        var ladate = new Date(ladatehistorique)
        var tab_jour = new Array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
        //console.log("Nous sommes un " + tab_jour[ladate.getDay()])
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                periode = xmlhttp.responseText.split(" ")
                document.getElementById("btn_openHistorique").disabled = false;
                document.getElementById("lienhistorique").href = document.getElementById("lienhistorique").href + "&" + document.getElementById("selectversion").options[document.getElementById("selectversion").selectedIndex].value + "&day=" + tab_jour[ladate.getDay()] + "&date=" + ladatehistorique + "&periode=" + periode[1];
                //console.log(xmlhttp.responseText)
            }
        }

        xmlhttp.open("GET", "requete.php?periodeDate=" + ladatehistorique, true);
        xmlhttp.send();
    }
}
function GoAffectation(date) {
    var ladate = new Date(date)
    console.log("ladate.getDay() = " + ladate.getDay() + "<BR>")
    var tab_jour = new Array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
    console.log("Nous sommes un " + tab_jour[ladate.getDay()])
    document.getElementById("LienVersExp").href = "../exp/index.php?day=" + tab_jour[ladate.getDay()] + "&date=" + date
    document.getElementById("LienVersMain").href = "../main/index.php?day=" + tab_jour[ladate.getDay()] + "&date=" + date
    GetPeriode(date)
}
function GetPeriode(date) {
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var periode = xmlhttp.responseText.split(" ")
            document.getElementById("LienVersExp").href = document.getElementById("LienVersExp").href + "&periode=" + periode[1]
            document.getElementById("LienVersMain").href = document.getElementById("LienVersMain").href + "&periode=" + periode[1]
            console.log(xmlhttp.responseText)
        }
    }

    xmlhttp.open("GET", "requete.php?periodeDate=" + date, true);
    xmlhttp.send();
}