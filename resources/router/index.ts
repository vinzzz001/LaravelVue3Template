//todo: create some paths
import ticketOverviewPage from "../js/pages/tickets/overview.vue";
import ticketShowPage from "../js/pages/tickets/show.vue"
import ticketCreatePage from "../js/pages/tickets/create.vue"

import loginPage from "../js/pages/users/index.vue"

// { path: string, name: string, component: Component, props ?: boolean }
export const routes = [

    { path: '/tickets', name: 'Tickets', component: ticketOverviewPage },
    { path: '/tickets/:id', name: 'TicketShow', component: ticketShowPage },
    { path: '/tickets-create', name: 'TicketCreate', component: ticketCreatePage },



    { path: '/login', name: 'Login', component: loginPage },
];