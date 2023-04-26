export interface Credentials {
  email: string;
  password: string;
  passwordConfirmation?: string;
}
export interface ResetCredentials extends Credentials {
  token?: string;
}

//User
// export interface User {
//   id: number;
//   first_name: string;
//   last_name: string;
//   full_name: string;
//   email: string;
//   is_admin: boolean;
//   telephone_number: number;
// }
