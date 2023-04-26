// #region Store
import type { Note } from "./types";
import { storeModuleFactory } from "services/store";
import { ticketStore } from "domains/tickets";
import { postRequest } from "../../services/http";

const baseNoteStore = storeModuleFactory<Note>("notes");

export const noteStore = {
  getters: baseNoteStore.getters,
  setters: baseNoteStore.setters,
  actions: {
    ...baseNoteStore.actions,

    // The notetore needs to update the tickettore? Could this be different?
    create: async (note: Omit<Note, "id">) => {
      const { data } = await postRequest(`notes/${note.ticket_id}`, note);

      if (!data) return;
      ticketStore.setters.setById(data);
    },
  },
};

// #endregion
