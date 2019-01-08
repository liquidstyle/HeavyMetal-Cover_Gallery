<template>
    <i v-if="mylikes[cover_id]" @click.prevent="unlike(cover_id)" class="fa fa-cubes" style="color:green;cursor:pointer;" title="Ownership"></i>
    <i v-else  @click.prevent="like(cover_id)" class="fa fa-cubes text-muted" style="cursor:pointer;" title="Ownership"></i>
</template>

<script>
    export default {
        data() {
            return {
                mylikes : {},
            }
        },
        beforeMount(){
            this.fetchLikes()
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
            fetchLikes: function()
            {
                var $this = this;

                axios.get('/api/items/'+cover_id+'/liked')
                    .then(function(res) {
                            $this.mylikes = res.data
                        })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
        }
    }
</script>