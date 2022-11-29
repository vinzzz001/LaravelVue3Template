import { ref } from "vue";
import axios from "axios";
import { Credentials } from "../types";
import { routes } from "/resources/router";



export const authStore = (
) => {
    const state = ref({
        loggedInUser: {},
        isAdmin: false,
    });



    const getters = {

    };

    /** Set the user login data. */
    const setters = {
        //todo: create a set-data function called from login/logout/me?/refresh
    };

    const actions = {
        login: async (credentials: Credentials) => {
            const { data } = await axios.post('api/login', credentials);
            if (!data) return;


            //Todo: Make an interceptor for errors.
            //todo: set login data.
            console.log(data)
        },

        logout: async () => {
            const { data } = await axios.get('api/logout');
            //todo: set logout data.

        },

        me: async () => {
            const { data } = await axios.get('api/me');
            if (!data) return;


            //todo: set me data
            console.log(data);
        },
    };

    return {
        getters,
        setters,
        actions,
    };
};

// Route::post('login', 'AuthController@login');
// Route::post('logout', 'AuthController@logout');
// Route::post('refresh', 'AuthController@refresh');
// Route::post('me', 'AuthController@me');