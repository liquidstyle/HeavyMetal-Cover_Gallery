<template>
    
    <div class="row">
        <div class="col-md-2 mb-5" v-if="covers.length > 0" v-for="cover in covers">
                <div class="card">
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
        data() {
            return {
                auth_user: auth_user,
                mylikes : {},
                myfavorites : {},
                mywishlists : {},
                covers : [
                    {
                        id              : '',
                        name            : '',
                        special_issue   : '',
                        cover_variant   : '',
                        month           : '',
                        year            : '',
                        yearmonth       : '',
                        liked           : '',
                        images : [
                            {
                                id      : '',
                                key     : '',
                                name    : '',
                                lowres  : '',
                                path    : '',
                            }
                        ]
                    }
                ]
            }
        },
        beforeMount(){
            this.fetchItems()
            this.fetchLikes()
            this.fetchFavorites()
            this.fetchWishlists()
        },
        mounted() {
            
        },
        methods: {

            like: function (item_id)
            {
                var $this = this;

                let url = '/api/items/'+item_id+'/like';
                axios.post(url)
                    .then( function(res) {
                        $this.fetchLikes()
                    }) .then( function() {
                        console.log($this.mylikes)
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            unlike: function (item_id)
            {
                var $this = this;
                let url = '/api/items/'+item_id+'/like';
                axios.delete(url)
                    .then( function(res) {
                        $this.fetchLikes()
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
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

            fetchItems: function()
            {
                var $this = this;

                $this.covers = []
                let url = '/api/items?with=images&perpage=250';
                axios.get(url)
                    .then( function(res) {
                        $this.covers = []
                        $this.covers = res.data.data
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            fetchLikes: function()
            {
                var $this = this;

                axios.get('/api/users/'+auth_user.id+'/liked')
                    .then(function(res) {
                            $this.mylikes = res.data
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
