<template>
    <div class="cover-view" v-if="cover">
        <div class="user-img">
            <img src="https://www.scottsdaleazestateplanning.com/wp-content/uploads/2018/01/user.png" alt="">
        </div>
        <div class="user-info">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ cover.id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ cover.name }}</td>
                </tr>
                <tr>
                    <th>Created</th>
                    <td>{{ cover.created_at }}</td>
                </tr>
                <tr>
                    <th>Updated</th>
                    <td>{{ cover.updated_ate }}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'show',
        created() {
            if (this.covers.length) {
                this.cover = this.covers.find((cover) => cover.id == this.$route.params.id);
            } else {
                axios.get(`/api/items/${this.$route.params.id}`)
                    .then((response) => {
                        this.cover = response.data.data
                    });
            }
        },
        data() {
            return {
                cover: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
            covers() {
                return this.$store.getters.covers;
            }
        }
    }
</script>

<style scoped>
    .cover-view {
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