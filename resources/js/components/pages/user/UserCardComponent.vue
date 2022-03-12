<template>
   <div class="card-container" :style="'flex:' + card_type[type].size">
      <div class="card-container_title">
         <h4>{{ card_type[type].name }}</h4>
         <EditButtonComponent
            :loading="loading_user"
            @update:click="edit = !edit"
            @update:user="updateUserProfil('name', id, form[type])"
            :size="16"
         ></EditButtonComponent>
      </div>
      <p v-if="type == 'resume'" :class="!form.resume.resume ? 'unknown' : ''">
         <template v-if="user_loaded">
            <VueSkeletonLoader class="skeleton skeleton_full" type="rect" :height="13" animation="fade" rounded />
            <VueSkeletonLoader class="skeleton skeleton_full" type="rect" :height="13" animation="fade" rounded />
            <VueSkeletonLoader class="skeleton" type="rect" :width="150" :height="13" animation="fade" rounded
         /></template>
         <template v-else>
            <div v-if="!edit">
               {{ form.resume.resume === "" ? "Ne possède pas encore de résumé..." : form.resume.resume }}
            </div>
            <form v-else class="input-form">
               <textarea class="card-container_textarea myinput" v-model="form.resume.resume"></textarea>
            </form>
         </template>
      </p>
      <p v-else-if="type == 'formation'">
         LOREM IPSUM 1900 - 1900 lorem ipsum LOREM IPSUM 1900 - 1900 lorem ipsum LOREM IPSUM 1900 - 1900 lorem ipsum LOREM IPSUM 1900 - 1900 lorem ipsum
      </p>
      <p v-else-if="type == 'experience'">
         LOREM IPSUM 1900 - 1900 lorem ipsum LOREM IPSUM 1900 - 1900 lorem ipsum LOREM IPSUM 1900 - 1900 lorem ipsum LOREM IPSUM 1900 - 1900 lorem ipsum
      </p>
      <p v-else>wip</p>
   </div>
</template>

<script>
import VueSkeletonLoader from "skeleton-loader-vue";
import EditButtonComponent from "../../components/EditButtonComponent.vue";
import IconComponent from "../../components/svg/IconComponent.vue";
import { useUser } from "../../../store/useUser";
import { mapActions, mapState } from "pinia";
export default {
   props: {
      id: { required: true },
      type: { required: true },
      user_loaded: { required: true },
      resume: { required: false },
   },
   components: { VueSkeletonLoader, IconComponent, EditButtonComponent },
   data() {
      return {
         card_type: {
            resume: { name: "Résumé", size: 2 },
            formation: { name: "Formation", size: 1 },
            other: { name: "other", size: 2 },
            experience: { name: "Expérience", size: 1 },
         },

         edit: false,
         loading: false,

         form: {
            resume: {
               resume: null,
            },
         },
      };
   },
   watch: {
      resume() {
         this.form.resume.resume = this.resume;
      },
   },
   computed: {
      ...mapState(useUser, ["loading_user"]),
   },
   methods: {
      ...mapActions(useUser, ["updateUserProfil"]),
   },
};
</script>

<style scoped lang="scss">
@import "resources/sass/_variables.scss";
.card-container {
   padding: 32px 42px;
   background-color: $mygrey2;
   border-radius: 8px;
   .card-container_textarea {
      width: 100%;
      resize: none;
      height: 100%;
   }
}
.card-container_title {
   align-items: center;
   display: flex;
   gap: 8px;
}
</style>
