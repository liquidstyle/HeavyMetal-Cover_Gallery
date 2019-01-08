<template>
    <i v-if="mywishlists[cover.id]" @click.prevent="unwishlist(cover.id)" class="fa fa-bookmark" style="color:blue;cursor:pointer;" title="Favorite"></i>
    <i v-else @click.prevent="wishlist(cover.id)" class="fa fa-bookmark text-muted" style="cursor:pointer;" title="Favorite"></i>
</template>

<script>
    export default {
        data() {
            return {
                mywishlists : {},
            }
        },
        beforeMount(){
            this.fetchWishlists()
        },
        methods: {
            wishlist: function (item_id)
            {
                var $this = this;
                let url = '/api/items/'+item_id+'/wishlist';
                axios.post(url)
                    .then( function(res) {
                        $this.fetchWishlists()
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            unwishlist: function (item_id)
            {
                var $this = this;
                let url = '/api/items/'+item_id+'/wishlist';
                axios.delete(url)
                    .then( function(res) {
                        $this.fetchWishlists()
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            fetchWishlists: function()
            {
                var $this = this;

                axios.get('/api/users/'+auth_user.id+'/wishlisted')
                    .then(function(res) {
                            $this.mywishlists = res.data
                        })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
        }
    }
</script>