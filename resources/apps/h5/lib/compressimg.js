function dataURLtoFile(dataurl, filename) {
    let arr = dataurl.split(',')
    let mime = arr[0].match(/:(.*?);/)[1]
    let suffix = mime.split('/')[1]
    let bstr = atob(arr[1])
    let n = bstr.length
    let u8arr = new Uint8Array(n)
    while (n--) {
        u8arr[n] = bstr.charCodeAt(n)
    }
    return new File([u8arr], `${filename}`, {
        type: mime
    });
}

function compressImage(data, filename) {
    return new Promise((resolve, reject) => {
        let img = new Image();
        let width = 800; //图像大小
        let quality = 0.8; //图像质量
        let canvas = document.createElement("canvas");
        let drawer = canvas.getContext("2d");
        let arr = data.split(',')
        let mime = arr[0].match(/:(.*?);/)[1]
        let suffix = mime.split('/')[1]
        img.src = data;
        img.onload = function () {
            canvas.width = width;
            canvas.height = img.height * (width / img.width);
            drawer.drawImage(img, 0, 0, canvas.width, canvas.height);
            let base64 = canvas.toDataURL(mime, quality);
            let file = dataURLtoFile(base64, filename);
            resolve({base64, file});
        }
    });
}

export {
    compressImage
}
