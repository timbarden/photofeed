<template>
    <div class="gallery">
        <p>Gallery</p>
        <ul>
            <GalleryItem
                v-for="item in this.objImages"
                :key="item.id"
                :id="item.id"
                :image="item.image"
            />
        </ul>
    </div>
</template>

<script>
import GalleryItem from "./../components/GalleryItem";

export default {
    name: "Gallery",
    data() {
        return {
            objImages: [
                {
                    image: String,
                },
            ],
        };
    },
    components: {
        GalleryItem,
    },
    props: {},
    methods: {},
    mounted() {},
};
</script>

<style lang="scss">
.gallery {
    margin-top: 2em;
    ul {
        list-style: none;
        margin: -0.5em;
        padding: 0;
        li {
            width: 25%;
            padding: 0.5em;
            aspect-ratio: 1;
            display: inline-block;
            vertical-align: bottom;
            > div {
                height: 100%;
                background: #eee;
            }
            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }
    }
}
</style>
