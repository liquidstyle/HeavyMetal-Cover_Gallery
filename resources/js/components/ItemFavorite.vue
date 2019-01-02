<template>
    <i v-if="favorited" class="fa fa-heart" style="color:red;" title="Favorite"></i>
    <i v-else class="fa fa-heart text-muted" title="Favorite"></i>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        computed: {
            favorited: function(item_id)
            {
                return 0;
            }
        },
        methods: {
            favorite: function()
            {
                return TRUE;
            }
        }
    }
</script>