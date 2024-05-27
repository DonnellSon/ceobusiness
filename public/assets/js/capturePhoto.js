(function () {

    document.addEventListener('DOMContentLoaded', function () {
        const webcamModal = document.getElementById('webcamModal');
        const importPhotoBtn = document.getElementById('importPhotoBtn')
        const photoInput = document.getElementById('photoInput');
        const avatarPreview=document.getElementById('user-avatar-preview-img')

        importPhotoBtn.addEventListener('click',function(){
            photoInput.click()
        })
        photoInput.addEventListener('change',(e)=>{
            avatarPreview.src=URL.createObjectURL(e.target.files[0])
            console.log(avatarPreview,'avatar')
        })

        

        webcamModal.addEventListener('shown.bs.modal', function () {
            const form = document.getElementById('user-registration-form');
            const video = document.getElementById('previewVideo');
            const canvas = document.getElementById('photoCanvas');
            const ctx = canvas.getContext('2d');
            const takePhotoBtn = document.getElementById('takePhotoBtn');
             // Ajouté pour référence

            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    video.srcObject = stream;
                    video.onloadedmetadata = function (e) {
                        video.play();
                    };
                })
                .catch(function (err) {
                    console.log("An error occurred: " + err);
                });

            function stopCapture() {
                const mediaStream = video.srcObject;
                const tracks = mediaStream.getTracks();
                tracks.forEach(track => track.stop());
            }

            webcamModal.addEventListener('hidden.bs.modal', function () {
                stopCapture()
            })

            takePhotoBtn.addEventListener('click', function () {
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                let imgData = canvas.toDataURL('image/png');

                // Création d'un objet File à partir des données de l'image
                photoInput.value = ''
                let blob = dataURItoBlob(imgData);
                let file = new File([blob], "ceobusiness_forum_io_photo.png", { type: "image/png" });

                const dataTransfer = new DataTransfer();

                // Add your file to the file list of the object
                dataTransfer.items.add(file);

                // Save the file list to a new variable
                const fileList = dataTransfer.files;

                // Set your input `files` to the file list
                photoInput.files = fileList;
                $(webcamModal).modal('hide')
                avatarPreview.src=URL.createObjectURL(photoInput.files[0])
            });
        })

    });

    // Fonction pour convertir les données URI en Blob
    function dataURItoBlob(dataURI) {
        var byteString = atob(dataURI.split(',')[1]);
        var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]
        var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(ab);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
        return new Blob([ab], { type: mimeString });
    }
})()