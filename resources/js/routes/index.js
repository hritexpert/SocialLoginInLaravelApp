import Homepage from '../pages/Homepage.vue'
import About from '../pages/Userslist.vue'
import Contact from '../pages/Contact.vue'

export default {
    mode: 'history',
    routes: [
        {
            path: '/home2',
            name: 'home',
            component: Homepage,
        },
        {
            path: '/users/list',
            name: 'users',
            component: Userslist,
        },
        {
            path: '/contact',
            name: 'contact',
            component: Contact,
        },
    ]
}
