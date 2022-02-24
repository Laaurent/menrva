<template>
   <div class="user-container__content">
      <AlertComponent v-if="error_code != 200" :code="error_code"></AlertComponent>
      <div>
         <UserHeaderComponent
            :id="user_tmp ? user_tmp.data.id : null"
            :first_name="user_tmp ? user_tmp.data.first_name : null"
            :last_name="user_tmp ? user_tmp.data.name : null"
            :place="user_tmp ? user_tmp.data.place : null"
            :user_loaded="user_loaded"
         ></UserHeaderComponent>

         <div class="user-cards-container">
            <div class="user-cards_row">
               <UserCardComponent type="resume" :resume="user_tmp ? user_tmp.data.resume : null" :user_loaded="user_loaded"></UserCardComponent>
               <UserCardComponent type="formation" :user_loaded="user_loaded"></UserCardComponent>
            </div>
            <div class="user-cards_row">
               <UserCardComponent type="other" :user_loaded="user_loaded"></UserCardComponent>
               <UserCardComponent type="experience" :user_loaded="user_loaded"></UserCardComponent>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
import axios from "axios";
import UserHeaderComponent from "./UserHeaderComponent.vue";
import AlertComponent from "../../components/AlertComponent.vue";
export default {
   components: { UserHeaderComponent, AlertComponent },
   props: ["user"],
   data() {
      return {
         user_tmp: null,
         error_code: 200,

         user_loaded: true,
      };
   },
   mounted() {
      this.readUser();
   },
   methods: {
      async readUser() {
         try {
            this.user_tmp = await axios.get(`/user/${this.user.id}`);
            this.error_code = this.user_tmp.data ? 200 : 404;
            this.user_loaded = this.user_tmp.data ? false : true;
         } catch (error) {
            this.error_code = 500;
         }
      },
   },
};
</script>

<style></style>
