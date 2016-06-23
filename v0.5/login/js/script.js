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
        document.getElementById("lienhistorique").href = document.getElementById("lienhistorique").href + "&" + document.getElementById("selectversion").options[document.getElementById("selectversion").selectedIndex].value
    }
}