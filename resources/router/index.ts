import { ticketRoutes } from "domains/tickets";
import { authRoutes } from "domains/auth";
import { categoryRoutes } from "domains/categories";
import { userRoutes } from "domains/users";

export const routes = [
  ...authRoutes,
  ...categoryRoutes,
  // ...responseRoutes,
  ...ticketRoutes,
  ...userRoutes,
];
