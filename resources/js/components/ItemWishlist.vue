<template>
    <i v-if="wishlisted" class="fa fa-bookmark" style="color:black;" title="Wishlist"></i>
    <i v-else class="fa fa-bookmark text-muted" title="Wishlist"></i>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        computed: {
            wishlisted: function(item_id)
            {
                return 0;
            }
        },
        methods: {
            wishlist: function()
            {
                return TRUE;
            }
        }
    }
</script>