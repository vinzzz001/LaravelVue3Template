import { Response } from "../responses/types";

export interface Status {
  id: number;
  title: string;
}

export interface Ticket {
  id: number;
  title: string;
  content: string;
  category_id: number;
  status_id: number;
  user_id: number;
  assigned_to: number;
  responses?: Response[];
}
