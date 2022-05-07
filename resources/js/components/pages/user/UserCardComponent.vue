<template>
   <div class="card-container xl:min-h-[360px]" :class="card_type[type].size == 1 ? 'maw-w-full lg:!w-[360px]' : 'flex-1'">
      <!-- TITLE -->
      <div class="card-container_title mb-2">
         <h4>{{ card_type[type].name }}</h4>
         <template v-if="is_editable">
            <EditButtonComponent v-if="type == 'resume'" :edit="edit" :loading="loading" @update:click="edit = !edit" :size="16"></EditButtonComponent>
            <button v-if="type == 'formation' || type == 'experience'" @click="edit = !edit">
               <IconComponent :type="edit ? 'close' : 'edit'" :size="16"></IconComponent></button
         ></template>
      </div>
      <!-- BODY RESUME -->
      <div v-if="type == 'resume'" :class="!form.resume.resume ? 'unknown' : ''">
         <template v-if="loading">
            <VueSkeletonLoader class="skeleton skeleton_full" type="rect" :height="13" animation="fade" rounded />
            <VueSkeletonLoader class="skeleton skeleton_full" type="rect" :height="13" animation="fade" rounded />
            <VueSkeletonLoader class="skeleton" type="rect" :width="150" :height="13" animation="fade" rounded
         /></template>
         <template v-else>
            <div v-if="!edit">
               <p v-html="form.resume.resume === '' ? 'Ne possède pas encore de biographie...' : formatResume"></p>
            </div>

            <form @submit.prevent="updateUserProfil('resume', form[type])" v-else class="input-form">
               <textarea-autosize
                  class="card-container_textarea myinput"
                  placeholder="Ne possède pas encore de biographie..."
                  ref="myTextarea"
                  v-model="form.resume.resume"
                  :min-height="30"
                  :max-height="350"
               />
               <button class="w-full lg:w-auto btn btn-primary">
                  <span class="flex justify-center items-center gap-2"><IconComponent type="save" color="white" size="12"></IconComponent>Modifier </span>
               </button>
            </form>
         </template>
      </div>
      <!-- BODY FORMATION -->
      <div v-else-if="type == 'formation'">
         <ul>
            <li v-for="(formation, index) in formations_data" :key="'formation_' + index">
               <div class="my-2 flex justify-between items-center">
                  <div class="w-full">
                     <h5 class="name break-words">{{ formation.name }}</h5>
                     <p class="text-primary">
                        {{ month_format(formation.start_date) }} -
                        <span :class="!formation.end_date ? 'italic' : ''">{{ formation.end_date ? month_format(formation.end_date) : "Aujourd'hui" }}</span>
                     </p>
                     <p class="flex items-center text-secondary">
                        <IconComponent type="place" size="12" color="grey"></IconComponent> {{ formation.city }} - ({{ formation.city_department }})
                     </p>
                  </div>
                  <div class="flex gap-2">
                     <button @click="$emit('select:row', formation)"><IconComponent type="info" :size="16"></IconComponent></button>
                     <button v-if="edit" @click="deleteRow('formation', formation.id, index)">
                        <IconComponent type="trash" :size="16" color="red"></IconComponent>
                     </button>
                  </div>
               </div>
            </li>
            <li v-if="edit">
               <h6>Nouvelle formation</h6>
               <form @submit.prevent="updateUserProfil('formation', form[type])" class="flex flex-col input-form gap-2">
                  <input required class="myinput" v-model="form.formation.name" type="text" placeholder="Intitulé de la formation" />
                  <div class="flex w-full gap-2 flex-col lg:flex-row">
                     <input required class="flex-1 myinput" v-model="form.formation.start_date" type="month" />
                     <span class="hidden lg:inline">-</span>
                     <input class="flex-1 myinput" v-model="form.formation.end_date" type="month" />
                  </div>
                  <input required class="myinput" v-model="form.formation.city" type="text" placeholder="Lieu de la formation" />
                  <SelectDepartmentComponent @update:department="form.formation.city_department = $event"></SelectDepartmentComponent>
                  <textarea
                     class="myinput"
                     name="resume"
                     v-model="form.formation.resume"
                     id=""
                     cols="30"
                     rows="5"
                     placeholder="Résumé de votre expérience"
                  ></textarea>
                  <button class="btn btn-primary">
                     <span class="flex justify-center"><IconComponent type="plus_add" color="white"></IconComponent>Ajouter </span>
                  </button>
               </form>
            </li>
         </ul>
      </div>
      <!-- BODY EXPERIENCE -->
      <div v-else-if="type == 'experience'">
         <ul>
            <li v-for="(experience, index) in experiences_data" :key="'experience_' + index">
               <div class="my-2 flex justify-between items-center">
                  <div class="w-full">
                     <h5 class="name break-words">{{ experience.name }}</h5>
                     <p class="text-primary">
                        {{ month_format(experience.start_date) }} -
                        <span :class="!experience.end_date ? 'italic' : ''">{{ experience.end_date ? month_format(experience.end_date) : "Aujourd'hui" }}</span>
                     </p>
                     <p class="flex items-center text-secondary">
                        <IconComponent type="place" size="12" color="grey"></IconComponent> {{ experience.city }} - ({{ experience.city_department }})
                     </p>
                  </div>
                  <div class="flex gap-2">
                     <button @click="$emit('select:row', experience)"><IconComponent type="info" :size="16"></IconComponent></button>
                     <button v-if="edit" @click="deleteRow('experience', experience.id, index)">
                        <IconComponent type="trash" :size="16" color="red"></IconComponent>
                     </button>
                  </div>
               </div>
            </li>
            <li v-if="edit">
               <h6>Nouvelle expérience</h6>
               <form @submit.prevent="updateUserProfil('experience', form[type])" class="flex flex-col input-form gap-2">
                  <input required class="myinput" v-model="form.experience.name" type="text" placeholder="Intitulé de l'expérience" />
                  <div class="flex w-full gap-2 flex-col lg:flex-row">
                     <input required class="flex-1 myinput" v-model="form.experience.start_date" type="month" />
                     <span class="hidden lg:inline">-</span>
                     <input class="flex-1 myinput" v-model="form.experience.end_date" type="month" />
                  </div>
                  <input required class="myinput" v-model="form.experience.city" type="text" placeholder="Lieu de l'expérience" />
                  <SelectDepartmentComponent @update:department="form.experience.city_department = $event"></SelectDepartmentComponent>
                  <textarea
                     class="myinput"
                     name="resume"
                     v-model="form.experience.resume"
                     id=""
                     cols="30"
                     rows="5"
                     placeholder="Résumé de votre expérience"
                  ></textarea>
                  <button class="btn btn-primary">
                     <span class="flex justify-center"><IconComponent type="plus_add" color="white"></IconComponent>Ajouter </span>
                  </button>
               </form>
            </li>
         </ul>
      </div>
      <!-- BODY OTHER -->
      <div v-else>wip</div>
   </div>
</template>

<script>
import VueSkeletonLoader from "skeleton-loader-vue";
import EditButtonComponent from "../../components/EditButtonComponent.vue";
import SelectDepartmentComponent from "../../components/SelectDepartmentComponent.vue";
import IconComponent from "../../components/svg/IconComponent.vue";
import moment from "moment";
import "moment/locale/fr";
export default {
   props: {
      id: { required: true },
      type: { required: true },
      user_loaded: { required: true },
      resume: { required: false },
      formations: { required: false },
      experiences: { required: false },
      is_editable: { required: true },
   },
   components: { VueSkeletonLoader, IconComponent, EditButtonComponent, SelectDepartmentComponent },
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
         experiences_data: null,
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
               city_department: null,
               resume: null,
            },
            experience: {
               name: null,
               user_id: null,
               start_date: null,
               end_date: null,
               city: null,
               city: null,
               city_department: null,
               resume: null,
            },
         },
      };
   },
   computed: {
      updated() {
         return this.resume + this.formations?.join() + this.experiences?.join();
      },
      formatResume() {
         return this.form.resume.resume?.replaceAll("\n", "<br/>");
      },
   },
   watch: {
      updated() {
         this.form.resume.resume = this.resume;
         this.form.formation.user_id = this.id;
         this.formations_data = this.formations?.sort((a, b) => {
            return new Date(b.start_date) - new Date(a.start_date);
         });
         this.form.experience.user_id = this.id;
         this.experiences_data = this.experiences?.sort((a, b) => {
            return new Date(b.start_date) - new Date(a.start_date);
         });
      },
   },
   methods: {
      month_format(value) {
         return moment(value).format("MMMM YYYY");
      },
      async updateUserProfil(type, form) {
         this.loading = true;
         try {
            let result = null;
            if (type == "resume") {
               result = await axios.post(`https://menrva-jgpnn.ondigitalocean.app/user/${this.id}/update`, form);
               this.edit = false;
            }
            if (type == "formation") {
               result = await axios.post(`https://menrva-jgpnn.ondigitalocean.app/formation/store`, this.form.formation);
               const formation_tmp = { ...this.form.formation };
               this.formations_data.push(formation_tmp);
               this.resetFormation();
            }
            if (type == "experience") {
               result = await axios.post(`https://menrva-jgpnn.ondigitalocean.app/experience/store`, this.form.experience);
               const experience_tmp = { ...this.form.experience };
               this.experiences_data.push(experience_tmp);
               this.resetExperience();
            }
            this.loading = false;
         } catch (error) {
            console.error(error);
         }
      },
      async deleteRow(type, id, index) {
         this.loading = true;
         let result = null;
         try {
            if (type == "experience") {
               result = await axios.post(`https://menrva-jgpnn.ondigitalocean.app/experience/delete`, { id: id });
               this.experiences_data = this.experiences_data.splice(index, 1);
            }
            if (type == "formation") {
               result = await axios.post(`https://menrva-jgpnn.ondigitalocean.app/formation/delete`, { id: id });
               this.formations_data = this.formations_data.splice(index, 1);
            }
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
         this.form.formation.resume = null;
         this.form.formation.city_department = null;
      },
      resetExperience() {
         this.form.experience.name = null;
         this.form.experience.start_date = null;
         this.form.experience.end_date = null;
         this.form.experience.city = null;
         this.form.experience.resume = null;
         this.form.experience.city_department = null;
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
