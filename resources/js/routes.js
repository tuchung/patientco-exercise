import Login from './components/login/Login'
import Dashboard from './components/app/Dashboard'
import UserRegistration from './components/login/Registration'

export default [
    { path: '/dashboard', component: Dashboard },
    { path: '/', component: Login },
    // { path: '/userfeed', component: UserFeed },
    { path: '/login', component: Login },
    { path: '/login/register', component: UserRegistration },
];