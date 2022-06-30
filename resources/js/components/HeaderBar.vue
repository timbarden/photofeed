<template>
    <header class="header">
        <h1 class="header__title">Photos</h1>
        <div class="header__admin"></div>
    </header>
</template>

<script>
export default {
    name: "HeaderBar",
    methods: {
        // Log the user out
        logout() {
            // this.$auth.logout({
            //     returnTo: window.location.origin,
            // });
        },
    },
};
</script>

<style lang="scss">
.header {
    position: sticky;
    top: 0;
    z-index: 1;
    padding: 1.25em 5%;
    background: #222;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    &__title {
        font-size: 1.5em;
    }
}
.header__admin {
    a,
    button {
        //@extend %btn_reset;
        border-radius: 5px;
        padding: 0.45em 0.7em;
        background: rgba(#fff, 0.12);
        color: skyblue;
        text-decoration: none;
        transition: background 0.1s ease;
        &:hover {
            background: rgba(#fff, 0.18);
        }
        &.btn--sq {
            width: 2em;
            height: 2em;
            padding: 0;
            &:hover {
                background: #ddd;
            }
        }
        img {
            width: 1.25em;
            height: 1.25em;
        }
    }
}
</style>
