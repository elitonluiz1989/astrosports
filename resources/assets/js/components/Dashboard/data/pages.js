import DashboardUsers from '../Users/Index';
import DashboardSchedules from '../Schedules/Index';


export const pages =  {
    usuarios: {
        active: true,
        component: DashboardUsers,
        icon: 'users',
        link: '/dashboard/usuarios',
        text: 'Usuários',
        userGrant: 2
    },

    institucional: {
        active: false,
        component: null,
        icon: 'book',
        link: '/dashboard/institucional',
        text: 'Institucional'
    },

    noticias: {
        active: false,
        component: null,
        icon: 'newspaper-o',
        link: '/dashboard/noticias',
        text: 'Notícias'
    },

    fotos: {
        active: false,
        component: null,
        icon: 'image',
        link: '/dashboard/fotos',
        text: 'Fotos'
    },

    horarios: {
        active: true,
        component: DashboardSchedules,
        icon: 'calendar',
        link: '/dashboard/horarios',
        text: 'Horários'
    },

    logout: {
        active: true,
        component: null,
        icon: 'sign-out',
        link: '/logout',
        text: 'Sair'
    }
};