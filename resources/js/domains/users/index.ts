// #region store
import type { User } from "./types";
import { storeModuleFactory } from "services/store";
export const userStore = storeModuleFactory<User>("users");
// #endregion
