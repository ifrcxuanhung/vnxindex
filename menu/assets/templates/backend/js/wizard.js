/*
 *
 *
 *                   PROGRESSIVE UPLOAD
 *
 *
 */
// Function that will allow us to know if Ajax uploads are supported
function supportAjaxUploadWithProgress() {
    return supportFileAPI() && supportAjaxUploadProgressEvents() && supportFormData();

    // Is the File API supported?
    function supportFileAPI() {
        var fi = document.createElement('INPUT');
        fi.type = 'file';
        return 'files' in fi;
    };

    // Are progress events supported?
    function supportAjaxUploadProgressEvents() {
        var xhr = new XMLHttpRequest();
        return !! (xhr && ('upload' in xhr) && ('onprogress' in xhr.upload));
    };

    // Is FormData supported?
    function supportFormData() {
        return !! window.FormData;
    }
}

function initAjaxUpload(textId, btnId, loadBtnId, progressId, uploadId, uri){
    var progressBar = document.getElementById(progressId);
    var uploadText = document.getElementById(textId);

    $('#' + loadBtnId).click(function(){
        if ($(this).hasClass('disabled')) return false;

        insertFileToDb($('#' + textId).val(), $('#' + uploadId).attr('name'),$(this), 1);

        $(this).addClass('disabled');
    });

    $('#' + btnId).click(function(){
        if ($(this).hasClass('disabled')) return false;
        var formData = new FormData();

        // FormData only has the file
        var file = document.getElementById(uploadId).files[0];
        formData.append($('#' + uploadId).attr('name'), file);

        // Code common to both variants
        // Get an XMLHttpRequest instance
        var xhr = new XMLHttpRequest();

        // Set up events
        xhr.upload.addEventListener('loadstart', function(evt){
            progressBar.style.visibility = 'visible';
            progressBar.style.width = 1;
        }, false);
        xhr.upload.addEventListener('progress', function(evt){
            progressBar.style.width =  evt.loaded / evt.total * 60 + '%';
        }, false);
        xhr.upload.addEventListener('load', function(){
            progressBar.style.width = '60%';
        }, false);
        xhr.addEventListener('readystatechange', function(evt){
            try {
                status = evt.target.status;
            }
            catch(e) {
                return;
            }
            progressBar.style.visibility = 'hidden';
            uploadText.value = evt.target.responseText;
            $('#' + btnId).removeClass('disabled');
        }, false);

        // Set up request
        xhr.open('POST', uri, true);

        // Fire!
        xhr.send(formData);
        $(this).addClass('disabled');
    });

    $('#' + uploadId).bind('change',function(){
        uploadText.value = getNameFromPath($(this).val());
    });
}

function initAjaxUploadForIE(txtId, btnId, loadBtnId, progressId, uploadId, uploadFrmId, iframeId){
    var progressBar = document.getElementById(progressId);
    var uploadText = document.getElementById(txtId);
    var uploadForm = $('#' + uploadFrmId);

    $('#' + loadBtnId).click(function(){
        if($(this).hasClass('disabled')) return false;
        insertFileToDb($('#' + textId).val(), $('#' + uploadId).attr('name'),$(this), 1);
        $(this).addClass('disabled');
    });

    // finished upload
    $('#' + iframeId).load(function(){
        progressBar.style.visibility = 'hidden';
        uploadText.value = $(this).contents().text();
        $('#' + btnId).removeClass('disabled');
    });

    $('#' + btnId).click(function(){
        if($(this).hasClass('disabled')) return false;
        // display uploading progressbar
        progressBar.style.visibility = 'visible';
        progressBar.style.width = '60%';
        // submit form
        uploadForm.submit();
        $(this).addClass('disabled');
    });

    $('#' + uploadId).bind('change', function(){
        // redirect target of form to iframe
        uploadForm.attr('target', $('#' + iframeId).attr('name'));

        //set textbox content to input upload value
        uploadText.value = getNameFromPath($(this).val());
    });
}

// Function to insert to database
function insertFileToDb(fileName,fileType,caller,truncate) {
    return jQuery.ajax({
        url:$admin_url+'perftrack/processbeforeupload',
        data: {
            truncate        :truncate,
            fileName        :fileName,
            fileType        :fileType,
            nocache         :Math.random()
        },
        beforeSend: function () {
            $('#loader').show();
            $('button.nextButton').addClass('grey');
        },
        success: function(response) {
            $('button.nextButton').removeClass('grey');
            caller.removeClass('disabled');
            $('#loader').hide();
        }
    });
}

function getNameFromPath(strFilepath) {
    var objRE = new RegExp(/([^\/\\]+)$/);
    var strName = objRE.exec(strFilepath);

    if (strName == null) {
        return null;
    }
    else {
        return strName[0];
    }
}