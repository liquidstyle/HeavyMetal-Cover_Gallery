<template>
    <div>
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Created</th>
                <th>Updated</th>
            </thead>
            <tbody>
                <template v-if="!artists.length">
                    <tr>
                        <td colspan="4" class="text-center">No Artists Available</td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="artist in artists" :key="artist.id">
                        <td>
                            <router-link :to="`/artists/${artist.id}`">{{ artist.name }}</router-link>
                        </td>
                        <td>{{ artist.created_at }}</td>
                        <td>{{ artist.updated_at }}</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'list',
        mounted() {
            if (this.artists.length) {
                return;
            }
            
            this.$store.dispatch('getArtists');
        },
        computed: {
            artists() {
                return this.$store.getters.artists;
            }
        }
    }
</script>

<style scoped>
    .btn-wrapper {
        text-align: right;
        margin-bottom: 20px;
    }
</style>