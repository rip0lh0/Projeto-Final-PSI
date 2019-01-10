$(document).on("ready", function () {
    var $el1 = $("#input-705");
    $el1.fileinput({
        uploadUrl: "/file-upload-batch/2",
        uploadAsync: false,
        showUpload: false, // hide upload button
        showRemove: false, // hide remove button
        overwriteInitial: false, // append files to initial preview
        minFileCount: 1,
        maxFileCount: 5,
        initialPreviewAsData: true,
    }).on("filebatchselected", function (event, files) {
        $el1.fileinput("upload");
    });
});