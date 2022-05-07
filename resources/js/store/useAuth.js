import { defineStore } from "pinia";
import axios from "axios";

export const useAuth = defineStore("auth", {
   state: () => ({
      user_log: this.userLog(),
   }),

   getters: {},

   actions: {
      async userLog() {
         try {
            const user_log = await axios.get("https://menrva-jgpnn.ondigitalocean.app/user/auth");
            this.user_log = user_log;
            return true;
         } catch (error) {
            console.error(error);
            return false;
         }
      },
   },
});
