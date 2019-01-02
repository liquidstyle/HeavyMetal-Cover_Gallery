<template>
    <i v-if="liked(123)" class="fa fa-cubes" style="color:green;" title="Ownership"></i>
    <i v-else class="fa fa-cubes text-muted" title="Ownership"></i>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        computed: {
            likedd: function(item_id)
            {
                // console.log(item_id);
                // let url = '/api/items/'+item_id+'/liked';
                // axios.get(url)
                //     .then( res => {
                //         console.log(res.data)
                //     } )
                //     .catch(function (error) {
                //         console.log(error);
                //     })
            }
        },
        methods: {
            liked: function(item_id)
            {
                console.log();
                return TRUE;
            }
        }
    }
</script>