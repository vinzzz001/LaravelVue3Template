// #region routes
import Overview from "domains/tickets/pages/overview.vue";
import Create from "domains/tickets/pages/create.vue";
import Edit from "domains/tickets/pages/edit.vue";
import Show from "domains/tickets/pages/show.vue";

// Todo: Use the route creation service.
export const ticketRoutes = [
  { path: "/ticket", name: "ticket.overview", component: Overview },
  { path: "/ticket/create", name: "ticket.create", component: Create },
  { path: "/ticket/edit/:id", name: "ticket.edit", component: Edit },
  { path: "/ticket/:id", name: "ticket.show", component: Show },
];
// #endregion

// #region store
import type { Ticket } from "./types";
import { storeModuleFactory } from "services/store";
import { putRequest } from "services/http";
const baseTicketStore = storeModuleFactory<Ticket>("tickets");

export const ticketStore = {
  getters: baseTicketStore.getters,
  setters: baseTicketStore.setters,
  actions: {
    ...baseTicketStore.actions,

    updateTicketStatus: async (ticket: Ticket) => {
      const { data } = await putRequest(
        `tickets/${ticket.id}/update-ticket-status`,
        ticket
      );
      if (!data) return;
      ticketStore.setters.setById(data);
    },

    updateTicketAssignment: async (ticket: Ticket) => {
      const { data } = await putRequest(
        `tickets/${ticket.id}/update-ticket-assignment`,
        ticket
      );
      if (!data) return;
      ticketStore.setters.setById(data);
    },
  },
};
// #endregion
