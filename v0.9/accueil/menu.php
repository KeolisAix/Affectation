<?php $Utilisateur="" ; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr-fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>KeoAffect › Bienvenue</title>
    <link rel="stylesheet" id="buttons-css" href="../config/css/buttons.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="login-css" href="../config/css/login.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="custom-login-css" href="../config/css/bootstrap.min.css" type="text/css" media="all">
    <link rel="stylesheet" href="../config/css/fileinput.min.css" type="text/css" media="all">
    <link rel="stylesheet" href="../config/css/fileinput.css" type="text/css" media="all">
    <link href="../config/css/simple-sidebar.css" rel="stylesheet">
    <script src="../config/js/login.js"></script>
    <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
</head>

<body class="login login-action-login wp-core-ui  locale-fr-fr">
    <div id="login">
        <h1><a href="" title="KeoAffect" tabindex="-1">Outil d'Affectation</a></h1>
        <div id="wrapper">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav" style="border-right-style: ridge">
                    <li>
                        <a href="#" onclick="Menu(this.name);" name="Affectation">Affectation</a>
                    </li>
                    <li>
                        <a href="#" onclick="Menu(this.name);" name="Historique">Historique</a>
                    </li>
                    <li>
                        <a href="#" onclick="Menu(this.name);" name="Rapport">Rapport</a>
                    </li>
                    <li>
                        <a href="#" onclick="Menu(this.name);" name="HASTUS">Intégration HASTUS</a>
                    </li>
                    <li>
                        <a href="#" onclick="Menu(this.name);" name="Vehicule">Intégration Vehicule</a>
                    </li>
                    <li>
                        <a href="#" onclick="Menu(this.name);" name="Import">Import</a>
                    </li>
                    <li>
                        <a href="#" onclick="Menu(this.name);" name="Déconnexion">Déconnexion</a>
                    </li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid" id="divAffectation">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1>Outil Affectation</h1>
                            <p>
                                <br>
                                <form class="form-horizontal" role="form" style="background: transparent">
                                    <p>
                                        <br> Cet outil permet l'édition des affectations afin d'avoir un lien en continu entre l'exploitation et la maintenance.
                                        <br> Deux interfaces métiers sont disponible afin de répondre aux besoins :
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Date :</label>
                                            <div class="col-sm-10">
                                                <div class="input-group" style="display:inline">
                                                    <input type="date" class="form-control" id="date" style="text-align: center" onChange="GoAffectation(this.value)">
                                                    <br>
                                                    <a id="LienVersExp" href="../exploitation/index.php">
                                                        <button type="button" class="btn btn-info" style="margin-top : 2%">Accès Exploitation</button>
                                                    </a>
                                                    <a href="../maintenance/index.php" id="LienVersMain">
                                                        <button type="button" class="btn btn-warning" style="margin-left : 2%;margin-top : 2%">Accès Maintenance</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid" id="divHistorique">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1>Accès Historique</h1>
                            <form class="form-horizontal" role="form" style="background: transparent">
                                <p>
                                    <br> Chaque journée d'affectation est archivé afin d'avoir un historique :
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Date :</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="datehistorique" style="text-align: center" onchange="RechercheHistorique(this.value)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Affectation du Jour :</label>
                                        <div class="col-sm-10">
                                            <select class=form-control style="text-indent: 42%" id="selectversion" onchange="HistoriqueAcc(ladatehistorique);">
                                                <option value="defaut">Choisir un jour</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <a id="lienhistorique" href="../maintenance/index.php?save=1">
                                                <button type="button" id="btn_openHistorique" class="btn btn-default" disabled>Ouvrir</button>
                                            </a>
                                        </div>
                                    </div>
                            </form>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="container-fluid" id="divImport">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1>Import d'une Affectation</h1>
                            <form class="form-horizontal" role="form" style="background: transparent">
                                <p>
                                    <br>Ce procédé permet de recréer une affectation théorique depuis un fichier CSV :
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Fichier Vehicule :</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                        <span class="btn btn-primary btn-file">
                                                        Parcourir<input type="file" accept=".csv" id="uploadImport" />
                                                        </span>
                                                </span>
                                                <input type="text" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="button" class="btn btn-default" id="BtnImporterCSV" disabled=true onclick="document.location.href='../importation/index.php'">Importer</button>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid" id="divRapport">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1>Génération des Rapports</h1>
                            <p>
                                <form class="form-horizontal" role="form" style="background: transparent">
                                    <p>
                                        <br> Interface de génération de rapport :
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Date :</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="date" style="text-align: center">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Type de Rapport:</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="typeRapport" placeholder="A définir..." style="text-align: center">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="button" class="btn btn-default">Générer</button>
                                            </div>
                                        </div>
                                </form>
                                </p>
                        </div>
                    </div>
                </div>
                <div class="container-fluid" id="divHASTUS">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1>Test Hastus</h1>
                            <form class="form-horizontal" role="form" style="background: transparent">
                                <p>
                                    <br> Importation de la Base Hastus, Attention ce n'est pas réversible :
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Fichier Hastus :</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-btn">
<span class="btn btn-primary btn-file">
Parcourir<input type="file">
</span>
                                                </span>
                                                <input type="text" class="form-control" readonly>
                                            </div>
                                            <script>
                                                $(document).on('change', '.btn-file :file', function() {
                                                    var input = $(this),
                                                        numFiles = input.get(0).files ? input.get(0).files.length : 1,
                                                        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                                                    input.trigger('fileselect', [numFiles, label]);
                                                });

                                                $(document).ready(function() {
                                                    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

                                                        var input = $(this).parents('.input-group').find(':text'),
                                                            log = numFiles > 1 ? numFiles + ' files selected' : label;

                                                        if (input.length) {
                                                            input.val(log);
                                                        } else {
                                                            if (log) alert(log);
                                                        }

                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Période :</label>
                                        <div class="col-sm-10">
                                            <select class=form-control style="text-indent: 42%">
                                                <option value=un>Scolaire</option>
                                                <option value=deux>Vacances</option>
                                                <option value=trois>Été</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="button" class="btn btn-default">Générer</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container-fluid" id="divVehicule">
                    <div class="row">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1>Importation Vehicule</h1>
                                <form class="form-horizontal" role="form" style="background: transparent">
                                    <p>
                                        <br> Importation de la Base Véhicule depuis un fichier de central parc, Attention ce n'est pas réversible :
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Fichier Vehicule :</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <span class="btn btn-primary btn-file">
                                                        Parcourir<input type="file" accept=".csv" id="uploadfiles" />
                                                        </span>
                                                    </span>
                                                    <input type="text" class="form-control" readonly>
                                                </div>
                                                <script>
                                                    $(document).on('change', '.btn-file :file', function() {
                                                        var input = $(this),
                                                            numFiles = input.get(0).files ? input.get(0).files.length : 1,
                                                            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                                                        input.trigger('fileselect', [numFiles, label]);
                                                    });

                                                    $(document).ready(function() {
                                                        $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

                                                            var input = $(this).parents('.input-group').find(':text'),
                                                                log = numFiles > 1 ? numFiles + ' files selected' : label;

                                                            if (input.length) {
                                                                input.val(log);
                                                            } else {
                                                                if (log) alert(log);
                                                            }

                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="button" class="btn btn-default">Importer</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /#page-content-wrapper -->
            </div>
        </div>
        <div class="clear"></div>
</body>
<script>
    Menu('Affectation');

    function RechercheHistorique(ladate) {
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var x = document.getElementById("selectversion");
                document.getElementById('selectversion').innerHTML = xmlhttp.responseText;
                ladatehistorique = document.getElementById("datehistorique").value;
            }
        }
        xmlhttp.open("GET", "requete.php?ladate=" + ladate, true);
        xmlhttp.send();
    }
</script>
<script src="../config/js/upload_login.js"></script>
</html>