import Home from './components/Home.vue';
import Login from './components/auth/Login.vue';

import CustomersMain from './components/customers/Main.vue';
import CustomersList from './components/customers/List.vue';
import CustomersNew from './components/customers/New.vue';
import Customer from './components/customers/Show.vue';

import ArtistsMain from './components/artists/Main.vue';
import ArtistsList from './components/artists/List.vue';
import Artist from './components/artists/Show.vue';

import CoversMain from './components/covers/Main.vue';
import CoversList from './components/covers/List.vue';
import Cover from './components/covers/Show.vue';

export const routes = [
    {
        path: '/',
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/customers',
        component: CustomersMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: CustomersList
            },
            {
                path: 'new',
                component: CustomersNew
            },
            {
                path: ':id',
                component: Customer
            }
        ]
    },
    {
        path: '/artists',
        component: ArtistsMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: ArtistsList
            },
            {
                path: ':id',
                component: Artist
            }
        ]
    },
    {
        path: '/covers',
        component: CoversMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: CoversList
            },
            {
                path: ':id',
                component: Cover
            }
        ]
    }
];