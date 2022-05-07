<template>
   <div class="user-container__content">
      <AlertComponent v-if="error_code" :type="error_code == 200 ? 'success' : 'danger'" :status="error_code"></AlertComponent>
      <div v-if="error_code != 404">
         <UserHeaderComponent
            :id="user_tmp ? user_tmp.data.id : null"
            :first_name="user_tmp ? user_tmp.data.first_name : null"
            :last_name="user_tmp ? user_tmp.data.name : null"
            :city="user_tmp ? user_tmp.data.city : null"
            :city_department="user_tmp ? user_tmp.data.city_department : null"
            :user_loaded="user_loaded"
            :is_editable="is_user_logged"
            :is_logged="user_log ? true : false"
            :is_student="is_student"
            :is_liked_by_auth_user="user_tmp ? user_tmp.data.isLikedByAuthUser : false"
            @update:like="updateLike($event)"
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
                  @select:row="
                     selected_experience.data = $event;
                     selected_experience.show = true;
                     selected_experience.type = 'Formation';
                  "
               ></UserCardComponent>
            </div>
            <div class="user-cards_row">
               <!--  <UserCardComponent
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
                  @select:row="
                     selected_experience.data = $event;
                     selected_experience.show = true;
                     selected_experience.type = 'Éxperience';
                  "
               ></UserCardComponent>
            </div>
         </div>
      </div>

      <ModaleUserInformation
         :data="selected_experience.data"
         :is_open="selected_experience.show"
         @close:modal="selected_experience.show = false"
      ></ModaleUserInformation>
   </div>
</template>

<script>
import axios from "axios";
import UserHeaderComponent from "./UserHeaderComponent.vue";
import AlertComponent from "../../components/AlertComponent.vue";
import { useAuth } from "../../../store/useAuth";
import { mapActions, mapState } from "pinia";
import ModaleUserInformation from "../../components/ModaleUserInformation.vue";
export default {
   components: { UserHeaderComponent, AlertComponent, ModaleUserInformation },
   props: ["user_id", "user_log", "is_student"],
   data() {
      return {
         user_tmp: null,
         error_code: null,
         user_loaded: true,
         user_suggestions: null,
         selected_experience: {
            data: null,
            show: false,
            type: null,
         },
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
            this.error_code = this.user_tmp.data ? this.error_code : 404;
            this.user_loaded = this.user_tmp.data ? false : true;
         } catch (error) {
            this.error_code = error.response.status;
         }
      },
      async updateLike(event) {
         try {
            let result = null;
            if (event) {
               result = await axios.post(`/likes/`, { user_id: this.user_id });
            } else {
               result = await axios.post(`/likes/delete`, { user_id: this.user_id });
            }
            this.error_code = result.data ? 200 : 500;
         } catch (error) {
            this.error_code = error.response.status;
         } finally {
            this.readUser();
         }
      },
   },
};
</script>

<style></style>
