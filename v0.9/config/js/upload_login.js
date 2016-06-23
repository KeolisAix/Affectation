/**
 * Created by pmaldi on 17/05/16.
 */
(function () {

    var uploadfiles = document.querySelector('#uploadfiles');
    uploadfiles.addEventListener('change', function () {
        var files = this.files;
        for (var i = 0; i < files.length; i++) {
            uploadFile(this.files[i]);
        }

    }, false);


    /**
     * Upload a file
     * @param file
     */
    function uploadFile(file) {
        var url = "./upload.php";
        var xhr = new XMLHttpRequest();
        var fd = new FormData();
        xhr.open("POST", url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Every thing ok, file uploaded
                console.log(xhr.responseText); // handle response.
            }
        };
        fd.append('uploaded_file', file);
        xhr.send(fd);
    }
}());

(function () {

    var uploadImport = document.querySelector('#uploadImport');
    uploadImport.addEventListener('change', function () {
        var filesImport = this.files;
        for (var i = 0; i < filesImport.length; i++) {
            uploadFileImport(this.files[i]);
        }

    }, false);


    /**
     * Upload a file
     * @param file
     */
    function uploadFileImport(file) {
        var url = "../import/upload.php";
        var xhr = new XMLHttpRequest();
        var fd = new FormData();
        xhr.open("POST", url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Every thing ok, file uploaded
                console.log(xhr.responseText); // handle response.
                document.getElementById("BtnImporterCSV").disabled = false;
            }
        };
        fd.append('uploaded_file', file);
        xhr.send(fd);
    }
}());