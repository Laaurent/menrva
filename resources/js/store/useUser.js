import { defineStore } from "pinia";
import axios from "axios";

export const useUser = defineStore("user", {
   state: () => ({
      loading_user: false,
   }),

   getters: {},

   actions: {
      async updateUserProfil(type, id, form) {
         this.loading_user = true;

         try {
            const update_user = await axios.post(`/user/${id}/update/`, { form: form });
            this.loading_user = false;
            console.log(update_user);
         } catch (error) {
            console.error(error);
         }
      },
   },
});
