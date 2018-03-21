export const dashboardNavItems = {
    state: {
        dashboardNavItems: {
          users: {
              link: '/dashboard/usuarios',
              text: 'Usuários',
              active: true
          },

          institutional: {
              link: '/dashboard/institucional',
              text: 'Institucional',
              active: false
          },

          news: {
              link: '/dashboard/noticias',
              text: 'Notícias',
              active: false
          },

          photos: {
              link: '/dashboard/fotos',
              text: 'Fotos',
              active: false
          },

          schedules: {
              link: '/dashboard/horarios',
              text: 'Horários',
              active: false
          },

          logout: {
              link: '/logout',
              text: 'Sair',
              active: true
          }
      }
    },

    getters: {
        getDashboardNavItems(state) {
            return state.dashboardNavItems;
        }
    }
};