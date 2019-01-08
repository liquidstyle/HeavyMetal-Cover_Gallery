<template>
    <i v-if="mywishlists[cover.id]" @click.prevent="unwishlist(cover.id)" class="fa fa-bookmark" style="color:blue;cursor:pointer;" title="Favorite"></i>
    <i v-else @click.prevent="wishlist(cover.id)" class="fa fa-bookmark text-muted" style="cursor:pointer;" title="Favorite"></i>
</template>

<script>
    export default {
        data() {
            return {
                myfavorites : {},
            }
        },
        beforeMount(){
            this.fetchFavorites()
        },
        methods: {
            favorite: function (item_id)
            {
                var $this = this;
                let url = '/api/items/'+item_id+'/favorite';
                axios.post(url)
                    .then( function(res) {
                        $this.fetchFavorites()
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            unfavorite: function (item_id)
            {
                var $this = this;
                let url = '/api/items/'+item_id+'/favorite';
                axios.delete(url)
                    .then( function(res) {
                        $this.fetchFavorites()
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            fetchFavorites: function()
            {
                var $this = this;

                axios.get('/api/users/'+auth_user.id+'/favorited')
                    .then(function(res) {
                            $this.myfavorites = res.data
                        })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
        }
    }
</script>