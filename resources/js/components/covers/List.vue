<template>

    <div class="row">
        <div class="col-md-2 mb-5" v-if="covers.length > 0" v-for="cover in covers">
            <div :class="'card border_'+cover.type">
                <div class="card-header">
                    <div>{{ cover.name }}</div>
                    <!-- <div v-if="cover.special_issue">{{ cover.special_issue }}</div>
                    <div v-if="cover.cover_variant">Cover {{ cover.cover_variant }}</div> -->
                </div>

                <div class="card-body text-center">
                    <a :href="'/items/'+cover.id"><img :src="cover.images[0].path" style="width:100px;"></a>
                </div>

                <div class="card-header text-center">
                    <!-- Likes -->
                    <i v-if="mylikes[cover.id]" @click.prevent="unlike(cover.id)" class="fa fa-cubes" style="color:green;cursor:pointer;" title="Ownership"></i>
                    <i v-else  @click.prevent="like(cover.id)" class="fa fa-cubes text-muted" style="cursor:pointer;" title="Ownership"></i>
                    &nbsp;
                    <!-- Favorites -->
                    <i v-if="myfavorites[cover.id]" @click.prevent="unfavorite(cover.id)" class="fa fa-heart" style="color:red;cursor:pointer;" title="Favorite"></i>
                    <i v-else @click.prevent="favorite(cover.id)" class="fa fa-heart text-muted" style="cursor:pointer;" title="Favorite"></i>
                    &nbsp;
                    <!-- Wishlist -->
                    <i v-if="mywishlists[cover.id]" @click.prevent="unwishlist(cover.id)" class="fa fa-bookmark" style="color:blue;cursor:pointer;" title="Favorite"></i>
                    <i v-else @click.prevent="wishlist(cover.id)" class="fa fa-bookmark text-muted" style="cursor:pointer;" title="Favorite"></i>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'list',
        mounted() {
            if (! this.covers.length) {
                this.$store.dispatch('getCovers');
            }
            if (! this.mylikes.length) {
                this.$store.dispatch('getMyLikes');
            }
            if (! this.myfavorites.length) {
                this.$store.dispatch('getMyFavorites');
            }
            if (! this.mywishlists.length) {
                this.$store.dispatch('getMyWishlists');
            }
        },
        computed: {
            covers() {
                return this.$store.getters.covers;
            },
            mylikes() {
                return this.$store.getters.mylikes;
            },
            myfavorites() {
                return this.$store.getters.myfavorites;
            },
            mywishlists() {
                return this.$store.getters.mywishlists;
            }
        },
        methods: {
            like: function(item_id)
            {
                this.$store.dispatch('like',{
                    item_id: item_id
                });
            },
            unlike: function(item_id)
            {
                this.$store.dispatch('unlike',{
                    item_id: item_id
                });
            },
            favorite: function(item_id)
            {
                this.$store.dispatch('favorite',{
                    item_id: item_id
                });
            },
            unfavorite: function(item_id)
            {
                this.$store.dispatch('unfavorite',{
                    item_id: item_id
                });
            },
            wishlist: function(item_id)
            {
                this.$store.dispatch('wishlist',{
                    item_id: item_id
                });
            },
            unwishlist: function(item_id)
            {
                this.$store.dispatch('unwishlist',{
                    item_id: item_id
                });
            },
        }
    }
</script>

<style scoped>
    .btn-wrapper {
        text-align: right;
        margin-bottom: 20px;
    }
</style>