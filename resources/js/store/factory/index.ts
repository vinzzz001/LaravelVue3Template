import { Category, Status, Ticket, User } from "/resources/js/types";
import { storeModuleFactory } from "./factory";

export const ticketStore = storeModuleFactory<Ticket>('tickets');
export const categoryStore = storeModuleFactory<Category>('categories');
export const statusStore = storeModuleFactory<Status>('statuses');
export const userStore = storeModuleFactory<User>('users');

// Create and export stores based on storeModuleFactory
// export const userStore = storeModuleFactory<User>("users");


// Example how to add another function to the bookStore, might be buggy as it is not tested
// bookStore.actions.getByCategoryId = async (categoryId) => {
//     const { data } = await axios.get(`books/${categoryId}/category`);
//     if (!data) return;
//     bookStore.setters.setAll(data);
// };