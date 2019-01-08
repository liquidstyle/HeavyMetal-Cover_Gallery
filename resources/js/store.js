import { getLocalUser } from "./helpers/auth";

const user = getLocalUser();

export default {
    state: {
        currentUser: user,
        isLoggedIn: !!user,
        loading: false,
        auth_error: null,
        customers: [],
        artists: [],
        covers: [],
        mylikes: [],
        myfavorites: [],
        mywishlists: [],
    },
    getters: {
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        customers(state) {
            return state.customers;
        },
        artists(state) {
            return state.artists;
        },
        covers(state) {
            return state.covers;
        },
        mylikes(state) {
            return state.mylikes;
        },
        myfavorites(state) {
            return state.myfavorites;
        },
        mywishlists(state) {
            return state.mywishlists;
        }
    },
    mutations:  {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error    = null;
            state.isLoggedIn    = true;
            state.loading       = false;
            state.currentUser   = Object.assign({}, payload.user, {token: payload.access_token}); // append access_token into the user object before we store it
            
            localStorage.setItem("user", JSON.stringify(state.currentUser));
            
            this.dispatch('getMyLikes');
            // this.dispatch('getMyFavorites');
            // this.dispatch('getMyWishlists');
        },
        loginFailed(state,payload) {
            state.loading       = false;
            state.auth_error    = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn    = false;
            state.currentUser   = null;

            // clear this so we get a fresh load
            state.covers        = null;
            state.artists       = null;
            state.mylikes       = null;
            state.myfavorites   = null;
            state.mywishlists   = null;
        },
        updateCustomers(state, payload) {
            state.customers     = payload;
        },
        updateArtists(state, payload) {
            state.artists       = payload;
        },
        updateCovers(state, payload) {
            state.covers        = payload;
        },
        updateMyLikes(state, payload) {
            state.mylikes       = payload;
        },
        updateMyFavorites(state, payload) {
            state.myfavorites   = payload;
        },
        updateMyWishlists(state, payload) {
            state.mywishlists   = payload;
        }
    },
    actions: {
        login(context) {
            context.commit("login");
        },
        getCustomers(context) {
            axios.get('/api/persons')
            .then((response) => {
                context.commit('updateCustomers', response.data.data);
            })
        },
        getArtists(context) {
            axios.get('/api/persons')
            .then((response) => {
                context.commit('updateArtists', response.data.data);
            })
        },
        getCovers(context) {
            axios.get('/api/items?with=images')
            .then((response) => {
                context.commit('updateCovers', response.data.data);
            })
        },
        getMyLikes(context) {
            axios.get('/api/users/'+user.id+'/liked')
            .then(function(response) {
                context.commit('updateMyLikes', response.data);
            })
        },
        getMyFavorites(context) {
            axios.get('/api/users/'+user.id+'/favorited')
            .then(function(response) {
                context.commit('updateMyFavorites', response.data);
            })
        },
        getMyWishlists(context) {
            axios.get('/api/users/'+user.id+'/wishlisted')
            .then(function(response) {
                context.commit('updateMyWishlists', response.data);
            })
        },
        like(context,payload)
        {
            axios.post('/api/items/'+payload.item_id+'/like')
            .then( function(res) {
                getMyLikes(context);
            })
        },
        unlike(context,payload)
        {
            axios.delete('/api/items/'+payload.item_id+'/like')
            .then( function(res) {
                getMyLikes(context);
            })
        },
        favorite(context,payload)
        {
            axios.post('/api/items/'+payload.item_id+'/favorite')
            .then( function(res) {
                getMyFavorites(context);
            })
        },
        unfavorite(context,payload)
        {
            axios.delete('/api/items/'+payload.item_id+'/like')
            .then( function(res) {
                getMyFavorites(context);
            })
        },
        wishlist(context,payload)
        {
            axios.post('/api/items/'+payload.item_id+'/wishlist')
            .then( function(res) {
                getMyFavorites(context);
            })
        },
        unwishlist(context,payload)
        {
            axios.delete('/api/items/'+payload.item_id+'/wishlist')
            .then( function(res) {
                getMyWishlists(context);
            })
        },
    }
};