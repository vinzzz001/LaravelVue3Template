import { Category, Status, Ticket, User } from "/resources/js/types";
import { storeModuleFactory } from "./factory";
import axios from "axios";

// Create and export stores based on storeModuleFactory
const baseTicketStore = storeModuleFactory<Ticket>("tickets");
export const categoryStore = storeModuleFactory<Category>("categories");
export const statusStore = storeModuleFactory<Status>("statuses");
export const userStore = storeModuleFactory<User>("users");

//Extend the actions available to the factoryStore used to create the ticketstore.
export const ticketStore = {
  getters: baseTicketStore.getters,
  setters: baseTicketStore.setters,
  actions: {
    ...baseTicketStore.actions,

    updateTicketStatus: async (ticket: Ticket) => {
      const { data } = await axios.post(
        `api/tickets/${ticket.id}/update-ticket-status`,
        ticket
      );
      if (!data) return;
      ticketStore.setters.setAll(data);
    },

    updateTicketAssignment: async (ticket: Ticket) => {
      const { data } = await axios.post(
        `api/tickets/${ticket.id}/update-ticket-assignment`,
        ticket
      );
      if (!data) return;
      ticketStore.setters.setAll(data);
    },
  },
};
