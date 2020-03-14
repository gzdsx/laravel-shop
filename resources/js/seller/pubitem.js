const imgapp = new Vue({
    el: '#itemImages',
    data: {
        images: images
    },
    methods: {
        pickImage: () => {
            Widget.showImagePicker((data) => {
                const {thumb, image} = data;
                imgapp.images.push({
                    id: 0,
                    thumb,
                    image
                });
                //console.log(imgapp.images);
            });
        },
        delImage: (idx) => {
            DSXUI.showConfirm('确认要删除图片吗?',() => {
                imgapp.images = imgapp.images.filter((image, index) => {
                    if (idx != index) {
                        return image;
                    }
                });
            });
        }
    }
});

$(".dsxui-uploader-files").sortable();
