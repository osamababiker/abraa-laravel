Dropzone.autoDiscover = false;
// var acceptedFileTypes = "image/*"; //dropzone requires this param be a comma separated list
// imageDataArray variable to set value in crud form
// var acceptedFileTypes = "image/*"; //dropzone requires this param be a comma separated list
// imageDataArray variable to set value in crud form
var fileDataArray = new Array;
// fileList variable to store current files index and name
var fileList = new Array;
var i = 0;
$(function(){

    var route_url = '/';
    var form = $('#my-dropzone').serialize();

    logo_dropzone = new Dropzone("#logo_dropzone",{
        url: route_url,
        data: form,
        uploadMultiple :false,
        acceptedFiles: ".jpeg,.jpg,.png,.pdf",
        addRemoveLinks: true,
        forceFallback: false,
        maxFilesize: 256, // Set the maximum file size to 256 MB
        parallelUploads: 100,
    });//end drop zone

    banner_dropzone = new Dropzone("#banner_dropzone",{
        url: route_url,
        data: form,
        uploadMultiple :false,
        acceptedFiles: ".jpeg,.jpg,.png,.pdf",
        addRemoveLinks: true,
        forceFallback: false,
        maxFilesize: 256, // Set the maximum file size to 256 MB
        parallelUploads: 100,
    });//end drop zone

    // handel banner dropzone
    banner_dropzone.on("success", function(file,response) {
        if(i!=0){
            fileDataArray = parseInt(i+1) +' files';
        }else{
            fileDataArray.push(file.name);
        }
        fileList[i] = {
            "serverFileName": file.name,
            "fileName": file.name,
            "Id": response.id,
            "fileId": i
        };
        i += 1;
    });
    banner_dropzone.on("removedfile", function(file) {
        var rmvFile = "";
        for (var f = 0; f < fileList.length; f++) {
            if (fileList[f].fileName == file.name) {
                // remove file from original array by database image name
                fileDataArray = parseInt(fileList.length-1) +' files';
                // fileDataArray.splice(fileDataArray.indexOf(fileList[f].serverFileName), 1);
                // get removed database file name
                rmvFile = fileList[f].serverFileName;
                var rmvFileId = fileList[f].Id;
                // ajax information
                var dataInfo = {
                    id: rmvFileId
                };
                var url = "/";
                url = url.replace(':id', rmvFileId);
                $.get(url)
                .done(function( data ) {

                });
            }
        }
    });

    // handel logo dropzone
    logo_dropzone.on("success", function(file,response) {
        if(i!=0){
            fileDataArray = parseInt(i+1) +' files';
        }else{
            fileDataArray.push(file.name);
        }
        fileList[i] = {
            "serverFileName": file.name,
            "fileName": file.name,
            "Id": response.id,
            "fileId": i
        };
        i += 1;
    });
    logo_dropzone.on("removedfile", function(file) {
        var rmvFile = "";
        for (var f = 0; f < fileList.length; f++) {
            if (fileList[f].fileName == file.name) {
                // remove file from original array by database image name
                fileDataArray = parseInt(fileList.length-1) +' files';
                // fileDataArray.splice(fileDataArray.indexOf(fileList[f].serverFileName), 1);
                // get removed database file name
                rmvFile = fileList[f].serverFileName;
                var rmvFileId = fileList[f].Id;
                // ajax information
                var dataInfo = {
                    id: rmvFileId
                };
                var url = "/";
                url = url.replace(':id', rmvFileId);
                $.get(url)
                .done(function( data ) {

                });
            }
        }
    });
});



$('#membership_date').hide();
$('input:radio[name="membership"]').change(
function(){
    if ($(this).is(':checked')) {
        if($(this).val() == 'silver' || $(this).val() == 'gold' || $(this).val() == 'platinum'){
            $('#membership_date').show();
        }else {
            $('#membership_date').hide();
        }
    }
});
