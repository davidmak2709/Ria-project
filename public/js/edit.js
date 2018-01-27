function checkFiles(files) {
    if(files.length + controlImages() > 5) {
        document.getElementById("img-status").style.visibility = 'visible';
        files.slice(0,4-controlImages());
        return false;
    }
}

function handleFileSelect(evt) {
    var files = evt.target.files;
    var cnt = controlImages();

    for (var i = 0, f; f = files[i],i < 5-cnt; i++) {
        if (!f.type.match('image.*')) {
            continue;
        }

        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                var img = document.createElement("img");
                img.src = e.target.result;
                img.className = "images";
                img.title = escape(theFile.name);
                document.getElementById('list').insertBefore(img, null);
            };})(f);
        reader.readAsDataURL(f);
    }
}
function controlImages(){
    var countTag = document.getElementsByTagName("img").length;
    return countTag;
}