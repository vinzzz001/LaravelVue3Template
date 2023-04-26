//User
export interface User {
  id: number;
  first_name: string;
  last_name: string;
  full_name?: string;
  email: string;
  is_admin: boolean;
  telephone_number: number;
}

export interface NewUser extends User {
  first_name: string;
  last_name: string;
  email: string;
  password: string;
  telephone_number: number;
}
