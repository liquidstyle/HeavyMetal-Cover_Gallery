<template>
    <div class="artist-view" v-if="artist">
        <div class="user-img">
            <img src="https://www.scottsdaleazestateplanning.com/wp-content/uploads/2018/01/user.png" alt="">
        </div>
        <div class="user-info">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ artist.id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ artist.name }}</td>
                </tr>
                <tr>
                    <th>Website</th>
                    <td>{{ artist.website }}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'show',
        created() {
            if (this.artists.length) {
                this.artist = this.artists.find((artist) => artist.id == this.$route.params.id);
            } else {
                axios.get(`/api/persons/${this.$route.params.id}`)
                    .then((response) => {
                        this.artist = response.data.data
                    });
            }
        },
        data() {
            return {
                artist: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
            artists() {
                return this.$store.getters.artists;
            }
        }
    }
</script>

<style scoped>
    .artist-view {
        display: flex;
        align-items: center;
    }
    .user-img {
        flex: 1;
    }
    .user-img img {
        max-width: 160px;
    }
    .user-info {
        flex: 3;
        overflow-x: scroll;
    }
</style>