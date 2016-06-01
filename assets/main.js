dropzone = $('#dropzone');
dropzone[0].ondragover = function () {
    dropzone.addClass('dropzoneHover');
    return false;
};

dropzone[0].ondragleave = function () {
    dropzone.removeClass('dropzoneHover');
    return false;
};
dropzone[0].ondrop = function (event) {
    event.preventDefault();
    if (typeof ($('#uploadimage')[0].files[0]) == 'undefined' || event.dataTransfer.files[0].name != $('#uploadimage')[0].files[0].name && dropzone.not('.noDrop').length != 0)
    {
        dropzone.removeClass('dropzoneHover');
        dropzone.addClass('noDrop');
        $('#uploadIcon').css('display', 'none');
        $('#loadingIcon').css('display', 'inline-block');
        $('#uploadimage')[0].files = event.dataTransfer.files;
    }
};

reader = new FileReader();
reader.onload = function (e) {
    $('#preview-image img').attr('src', e.target.result);
    $('#dropzone').css('display', 'none');
    $('#preview-image').css('display', 'block');
    var img = $('#previewImage');
    var image = document.createElement('img');
    image.addEventListener('load', function () {
        if (image.width > image.height)
        {
            var y1 = 0;
            var y2 = image.height;
            var x1 = (image.width - y2) / 2;
            var x2 = y2 + x1;


        } else if (image.width < image.height)
        {
            var x1 = 0;
            var x2 = image.width;
            var y1 = 0;
            var y2 = x2 + y1;
        } else {
            var x1 = 0;
            var x2 = image.width;
            var y1 = 0;
            var y2 = image.height;
        }
        $('#fileUploadContolBtn').css('display', 'block');
        img.imgAreaSelect({x1: x1, y1: y1, x2: x2, y2: y2, imageHeight: image.height, imageWidth: image.width});
        img.imgAreaSelect({show: true});
        $('#upload-error').html('');
        dropzone.removeClass('noDrop');
        $('#uploadIcon').css('display', 'inline-block');
        $('#loadingIcon').css('display', 'none');
    });
    image.src = $('#previewImage').attr('src');
}

$(document).on('click', '#changeImage', function () {
    $('#dropzone').css('display', 'inline-block');
    $('#preview-image').css('display', 'none');
    $('#fileUploadContolBtn').css('display', 'none');
    $('#preview-image img').attr('src', '');
    $('#uploadImageForm')[0].reset();
    $('#previewImage').imgAreaSelect({hide: true});
});