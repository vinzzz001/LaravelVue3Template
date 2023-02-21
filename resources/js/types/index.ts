import { ConstantTypes } from "@vue/compiler-core";

/**
 * basic @id each Item should have.
 */
export interface Item {
  id: number;
}

/**
 * The category of a ticket.
 */
export interface Category extends Item {
  title: string;
}

/**
 * Response to a ticket
 */
export interface Response extends Item {
  content: Text; //or string?
  user_id: number;
  ticket_id: number;
}

//Status
export interface Status extends Item {
  title: string;
}

//Ticket
export interface Ticket extends Item {
  title: string;
  content: Text; //or string?
  category_id: number;
  status_id: number;
  user_id: number;
  assigned_to: number;
  responses: Response[];
}

//User
export interface User extends Item {
  first_name: string;
  last_name: string;
  full_name: string;
  email: string;
  is_admin: boolean;
  telephone_number: number;
}

//Login.
export interface Credentials {
  email: string;
  password: string;
}

// //# Test
// export type Int = typeof integer;
// const integer = (x: number) => {
//     return x % 1 ? x : false;
// };
