<template>
   <div class="card-container" :style="'flex:' + card_type[type].size">
      <div class="card-container_title">
         <h4>{{ card_type[type].name }}</h4>
         <EditButtonComponent
            v-if="type == 'resume'"
            :loading="loading"
            @update:click="edit = !edit"
            @update:user="updateUserProfil('resume', form[type])"
            :size="16"
         ></EditButtonComponent>
         <button v-if="type == 'formation'" @click="edit = !edit">
            <IconComponent :type="edit ? 'close' : 'edit'" :size="16"></IconComponent>
         </button>
      </div>
      <p v-if="type == 'resume'" :class="!form.resume.resume ? 'unknown' : ''">
         <template v-if="loading">
            <VueSkeletonLoader class="skeleton skeleton_full" type="rect" :height="13" animation="fade" rounded />
            <VueSkeletonLoader class="skeleton skeleton_full" type="rect" :height="13" animation="fade" rounded />
            <VueSkeletonLoader class="skeleton" type="rect" :width="150" :height="13" animation="fade" rounded
         /></template>
         <template v-else>
            <div v-if="!edit">
               <p v-html="form.resume.resume === '' ? 'Ne possède pas encore de biographie...' : formatResume"></p>
            </div>

            <form v-else class="input-form">
               <textarea-autosize
                  class="card-container_textarea myinput"
                  placeholder="Ne possède pas encore de biographie..."
                  ref="myTextarea"
                  v-model="form.resume.resume"
                  :min-height="30"
                  :max-height="350"
               />
            </form>
         </template>
      </p>
      <div v-else-if="type == 'formation'">
         <ul>
            <li v-for="(formation, index) in formations_data" :key="'formation_' + index">
               <form @submit.prevent="deleteFormation(formation.id, index)">
                  {{ formation.name }} {{ formation.start_date }} - {{ formation.end_date }} {{ formation.city }}
                  <button v-if="edit"><IconComponent type="trash" :size="16"></IconComponent></button>
               </form>
            </li>
            <li v-if="edit">
               <form @submit.prevent="updateUserProfil('formation', form[type])">
                  <input v-model="form.formation.name" type="text" />
                  <input v-model="form.formation.start_date" type="date" />
                  <input v-model="form.formation.end_date" type="date" />
                  <input v-model="form.formation.city" type="text" />
                  <button>save</button>
               </form>
            </li>
         </ul>
      </div>
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
export default {
   props: {
      id: { required: true },
      type: { required: true },
      user_loaded: { required: true },
      resume: { required: false },
      formations: { required: false },
   },
   components: { VueSkeletonLoader, IconComponent, EditButtonComponent },
   data() {
      return {
         card_type: {
            resume: { name: "Biographie", size: 2 },
            formation: { name: "Formation", size: 1 },
            other: { name: "other", size: 2 },
            experience: { name: "Expérience", size: 1 },
         },

         edit: false,
         loading: false,
         formations_data: null,
         form: {
            resume: {
               resume: null,
            },
            formation: {
               name: null,
               user_id: null,
               start_date: null,
               end_date: null,
               city: null,
            },
         },
      };
   },
   computed: {
      updated() {
         return this.resume + this.formations?.join();
      },
      formatResume() {
         return this.form.resume.resume?.replaceAll("\n", "<br/>");
      },
   },
   watch: {
      updated() {
         this.form.resume.resume = this.resume;
         this.form.formation.user_id = this.id;
         this.formations_data = this.formations;
      },
   },
   methods: {
      async updateUserProfil(type, form) {
         this.loading = true;
         try {
            console.log(form);
            let result = null;
            if (type == "resume") result = await axios.post(`/user/${this.id}/update/`, { form: form });
            if (type == "formation") {
               result = await axios.post(`/formation/store`, this.form.formation);
               this.formations_data.push(this.form.formation);
               /*  this.resetFormation(); */
            }
            this.loading = false;
         } catch (error) {
            console.error(error);
         }
      },
      async deleteFormation(id, index) {
         this.loading = true;
         try {
            const result = await axios.post(`/formation/delete/`, { id: id });
            this.formations_data = this.formations_data.splice(index, 1);
            this.loading = false;
         } catch (error) {
            console.error(error);
         }
      },
      resetFormation() {
         this.form.formation.name = null;
         this.form.formation.start_date = null;
         this.form.formation.end_date = null;
         this.form.formation.city = null;
      },
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
