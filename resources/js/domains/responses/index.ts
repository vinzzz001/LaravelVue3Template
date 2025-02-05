import type { Response } from "./types";
import { storeModuleFactory } from "services/store";
import { postRequest, putRequest } from "../../services/http";
import { ticketStore } from "domains/tickets";

// #region store
const baseResponseStore = storeModuleFactory<Response>("responses");

export const responseStore = {
  getters: baseResponseStore.getters,
  setters: baseResponseStore.setters,
  actions: {
    ...baseResponseStore.actions,

    //The name is intentionally not create, as it might cause confusion since it has different requirements from a normal one?
    createResponse: async (response: Omit<Response, "id">) => {
      const { data } = await postRequest(
        `responses/${response.ticket_id}`,
        response
      );

      if (!data) return;
      ticketStore.setters.setById(data);
    },

    updateResponse: async (response: Response) => {
      const { data } = await putRequest(
        `responses/${response.ticket_id}/update`,
        response
      );

      if (!data) return;
      ticketStore.setters.setById(data);
    },
  },
};
// #endregion
