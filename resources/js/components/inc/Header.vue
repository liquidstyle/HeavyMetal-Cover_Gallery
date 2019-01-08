<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <router-link class="navbar-brand" to="/">Cover Gallery</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <router-link id="navbar" class="nav-link" to="/activity" aria-expanded="false">
                                Activity Feed
                            </router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <router-link id="navbarDropdown" class="nav-link dropdown-toggle" to="#!" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Items 
                            </router-link>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <router-link class="dropdown-item" to="/covers">
                                    Magazines
                                </router-link>
                                <router-link class="dropdown-item" to="/books">
                                    Books
                                </router-link>
                                <router-link class="dropdown-item" to="/comics">
                                    Comics
                                </router-link>
                            </div>
                        </li>
                        <li class="nav-item">
                            <router-link id="navbar" class="nav-link" to="/artists" aria-expanded="false">
                                Artists/Authors
                            </router-link>
                        </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <template v-if="!currentUser">
                        <li>
                            <router-link to="/login" class="nav-link">Login</router-link>
                        </li>
                        <li>
                            <router-link to="/register" class="nav-link">Register</router-link>
                        </li>
                    </template>
                    <template v-else>
                        <li class="nav-item dropdown">
                            <router-link id="navbarDropdown" class="nav-link dropdown-toggle" to="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ currentUser.name }}<span class="caret"></span>
                            </router-link>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <router-link class="dropdown-item" to="/manager/" v-if="currentUser.admin == 1">Data Manager</router-link>
                                <router-link class="dropdown-item" to="/profile">
                                    My Profile
                                </router-link>
                                <router-link class="dropdown-item" to="/mycollection">
                                    My Collection
                                </router-link>
                                <router-link class="dropdown-item" to="/mycollection?filter=notowned">
                                    NOT In My Collection
                                </router-link>
                                <router-link class="dropdown-item" to="/favorites">
                                    My Favorites
                                </router-link>
                                <router-link class="dropdown-item" to="/wishlist">
                                    My Wishlist
                                </router-link>
                                <a href="#!" @click.prevent="logout" class="dropdown-item" style="font-weight:bold;color:red;">Logout</a>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: 'app-header',
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        }
    }
</script>