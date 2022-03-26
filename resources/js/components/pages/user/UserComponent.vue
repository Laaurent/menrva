<template>
   <div class="user-container__content">
      <AlertComponent v-if="error_code != 200" :code="error_code"></AlertComponent>
      <div v-if="error_code != 404">
         <UserHeaderComponent
            :id="user_tmp ? user_tmp.data.id : null"
            :first_name="user_tmp ? user_tmp.data.first_name : null"
            :last_name="user_tmp ? user_tmp.data.name : null"
            :city="user_tmp ? user_tmp.data.city : null"
            :city_department="user_tmp ? user_tmp.data.city_department : null"
            :user_loaded="user_loaded"
            :is_editable="is_user_logged"
         ></UserHeaderComponent>

         <div class="user-cards-container">
            <div class="user-cards_row">
               <UserCardComponent
                  type="resume"
                  :id="user_tmp ? user_tmp.data.id : null"
                  :resume="user_tmp ? user_tmp.data.resume : null"
                  :user_loaded="user_loaded"
                  :is_editable="is_user_logged"
               ></UserCardComponent>
               <UserCardComponent
                  type="formation"
                  :formations="user_tmp ? user_tmp.data.formations : null"
                  :id="user_tmp ? user_tmp.data.id : null"
                  :user_loaded="user_loaded"
                  :is_editable="is_user_logged"
               ></UserCardComponent>
            </div>
            <div class="user-cards_row">
               <!-- <UserCardComponent
                  type="other"
                  :id="user_tmp ? user_tmp.data.id : null"
                  :user_loaded="user_loaded"
                  :is_editable="is_user_logged"
               ></UserCardComponent> -->
               <UserCardComponent
                  :experiences="user_tmp ? user_tmp.data.experiences : null"
                  type="experience"
                  :id="user_tmp ? user_tmp.data.id : null"
                  :user_loaded="user_loaded"
                  :is_editable="is_user_logged"
               ></UserCardComponent>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
import axios from "axios";
import UserHeaderComponent from "./UserHeaderComponent.vue";
import AlertComponent from "../../components/AlertComponent.vue";
import { useAuth } from "../../../store/useAuth";
import { mapActions, mapState } from "pinia";
export default {
   components: { UserHeaderComponent, AlertComponent },
   props: ["user_id", "user_log"],
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
   computed: {
      is_user_logged() {
         return this.user_id == this.user_log;
      },
   },
   methods: {
      async readUser() {
         try {
            this.user_tmp = await axios.get(`/user/${this.user_id}`);
            this.error_code = this.user_tmp.data ? 200 : 404;
            this.user_loaded = this.user_tmp.data ? false : true;
         } catch (error) {
            this.error_code = error.response.status;
         }
      },
   },
};
</script>

<style></style>
