/**
 * The note on a ticket.
 */
export interface Note {
  id: number;
  content: string;
  ticket_id: number;
  user_id: number;
  created_at?: Date;
  updated_at?: Date;
}
