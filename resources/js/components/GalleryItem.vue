<template>
    <li class="gallery__item" :id="id">
        <div>
            <img :src="image" :alt="id" />
            <div class="gallery__item__txt"></div>
        </div>
    </li>
</template>

<script>
//import * as ExifReader from "exifreader";

export default {
    // data() {
    //   return {
    //     exifData: null,
    //   };
    // },
    name: "GalleryItem",
    props: ["id", "image"],
    // async mounted() {
    //   const data = await ExifReader.load(this.image);
    //   console.log("data", data);
    //   let strExif = "";
    //   data.DateTimeOriginal != undefined &&
    //     (strExif += data.DateTimeOriginal.description);
    //   data.Model != undefined &&
    //     (strExif += "<br><small>" + data.Model.description + "</small>");
    //   this.exifData = strExif;
    // },
};
</script>

<style lang="scss"></style>
