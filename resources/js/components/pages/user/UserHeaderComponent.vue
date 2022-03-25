<template>
   <div class="user-header-container">
      <div class="user-header-container__background"></div>
      <div class="user-header-container__infos">
         <div v-if="!edit" class="user-header-container__infos_img lg:h-32 lg:w-32 h-16 w-16 overflow-hidden">
            <img class="w-full h-full" :src="form.profil_image ? form.profil_image : `/storage/avatars/${id}/avatar.png`" alt="" />
         </div>
         <div v-else class="grid grid-cols-1">
            <div class="flex items-center justify-center w-full relative">
               <img class="absolute lg:h-32 lg:w-32 h-16 w-16 rounded-full" :src="form.profil_image" />
               <label
                  class="flex z-10 flex-col border-4 border-dashed lg:h-32 lg:w-32 h-16 w-16 hover:bg-mygrey3/70 bg-white/70 hover:border-myprimary group rounded-full"
               >
                  <div class="flex flex-col items-center justify-center w-100 h-100">
                     <svg
                        class="w-6 h-6 lg:w-10 lg:h-10 text-mydarkgrey group-hover:text-myprimary"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                     >
                        <path
                           stroke-linecap="round"
                           stroke-linejoin="round"
                           stroke-width="2"
                           d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                        ></path>
                     </svg>
                  </div>
                  <input type="file" @change="onFileChange($event)" class="hidden" />
               </label>
            </div>
         </div>
         <div class="user-header-container__infos_main items-center">
            <div class="infos__main_text w-full">
               <div class="infos__main_name">
                  <VueSkeletonLoader v-if="loading" class="skeleton" type="rect" :width="300" :height="32" animation="fade" rounded />
                  <template v-else>
                     <form @submit.prevent="updateUserProfil(form)" class="input-form flex flex-col lg:flex-row gap-2 input-form" v-if="edit">
                        <div class="flex flex-1 flex-col w-full">
                           <div class="flex w-full gap-1">
                              <input class="myinput flex-1 sm:text-xs" v-model="lastNameUppercase" placeholder="NOM" type="text" />
                              <input class="myinput flex-1 sm:text-xs" v-model="form.first_name" placeholder="Prénom" type="text" />
                           </div>
                           <div class="flex flex-1 gap-1">
                              <input class="myinput sm:text-xs" v-model="form.city" placeholder="Ville" type="text" />
                              <SelectDepartmentComponent @update:department="form.city_department = $event"></SelectDepartmentComponent>
                           </div>
                        </div>

                        <button class="btn btn-primary py-1">
                           <span class="flex justify-center items-center gap-2"
                              ><IconComponent type="save" color="white" size="12"></IconComponent>Modifier
                           </span>
                        </button>
                     </form>
                     <div v-else class="flex flex-col md:flex-row items-start lg:justify-between lg:items-center">
                        <div class="flex flex-col items-start">
                           <h1>{{ fullname }}</h1>
                           <div class="flex items-center">
                              <IconComponent type="place" size="12" color="grey"></IconComponent>
                              <h6 :style="!city ? 'font-style: italic' : ''">
                                 {{ form.city ? form.city + " (" + form.city_department + ")" : "non renseigné" }}
                              </h6>
                           </div>
                        </div>
                        <div v-if="is_editable" class="flex items-center">
                           <EditButtonComponent :loading="loading" @update:click="edit = !edit" @update:user="updateUserProfil(form)"></EditButtonComponent>
                           <IconComponent type="certified"></IconComponent>
                        </div>
                     </div>
                  </template>
               </div>
            </div>
            <div v-if="!is_editable" class="infos__main_button flex">
               <IconComponent type="comment"></IconComponent>
               <IconComponent type="like"></IconComponent>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
import VueSkeletonLoader from "skeleton-loader-vue";
import SelectDepartmentComponent from "../../components/SelectDepartmentComponent.vue";
import EditButtonComponent from "../../components/EditButtonComponent.vue";
import IconComponent from "../../components/svg/IconComponent.vue";
export default {
   components: { IconComponent, EditButtonComponent, VueSkeletonLoader, SelectDepartmentComponent },
   props: ["id", "first_name", "last_name", "user_loaded", "city", "city_department", "is_editable"],
   data() {
      return {
         is_user_logged: true,
         edit: false,
         loading: false,
         form: {
            profil_file: null,
            profil_image: null,
            first_name: null,
            name: null,
            city: null,
            city_department: null,
         },
      };
   },
   watch: {
      first_name() {
         this.form.first_name = this.first_name;
         this.form.name = this.last_name;
         this.form.city = this.city;
         this.form.city_department = this.city_department;
      },
   },
   computed: {
      fullname() {
         return this.form.name?.toUpperCase() + " " + this.form.first_name;
      },
      lastNameUppercase: {
         set(last_name) {
            this.form.name = last_name.charAt(0).toUpperCase() + last_name.slice(1).toLowerCase();
         },
         get() {
            return this.form.name.toUpperCase();
         },
      },
   },
   methods: {
      async updateUserProfil(form) {
         this.loading = true;
         let formData = new FormData();
         formData.append("image", this.form.profil_file);
         formData.append("first_name", this.form.first_name);
         formData.append("name", this.form.name);
         formData.append("city", this.form.city);
         formData.append("city_department", this.form.city_department);

         try {
            const result = await axios.post(`/user/${this.id}/update/`, formData);
            this.loading = false;
            this.edit = false;
         } catch (error) {
            console.error(error);
         }
      },
      onFileChange: function (e) {
         var files = e.target.files || e.dataTransfer.files;
         if (!files.length) return;
         this.form.profil_file = files[0];
         this.createImage(files[0]);
      },
      createImage(file) {
         var image = new Image();
         var reader = new FileReader();
         var vm = this;

         reader.onload = (e) => {
            vm.form.profil_image = e.target.result;
         };
         reader.readAsDataURL(file);
      },
   },
};
</script>

<style scoped lang="scss">
$myblack: #102347;
$myprimary: #286bee;
$mygrey: #fefefe;
$mywhite: #ffffff;
$mygrey2: #e7ecee;
$mygrey3: #f6f6f6;
$mydarkgrey: #7a868c;
.user-header-container {
   padding-bottom: 50px;
   .user-header-container__background {
      background-color: $mygrey2;
      height: 144px;
      border-radius: 8px;
      width: 100%;
      /* position: relative; */
      z-index: 1;
   }
   .user-header-container__infos {
      display: flex;
      gap: 40px;
      padding: 0 32px;
      margin-top: -20px;
      align-items: center;
      /* position: absolute; */
      top: 250px;
      z-index: 2;
      /* width: 100%; */
      .user-header-container__infos_img {
         background-color: $mywhite;
         border-radius: 50%;
      }
      .user-header-container__infos_main {
         flex: 1;
         display: flex;
         justify-content: space-between;

         .infos__main_text {
            h1 {
               margin: 0;
            }
            .infos__main_name {
               .input-form {
                  .big-input {
                     margin: 2px 0;
                     display: inline;
                     font-size: 24px;
                  }
               }
               gap: 16px;
            }
         }
      }
   }
}
@media only screen and (max-width: 1024px) {
   .user-header-container__infos {
      gap: 16px !important;
      padding: 0 16px !important;
      .user-header-container__infos_main {
         flex-direction: column;

         .infos__main_text {
            .infos__main_name {
               h1 {
                  font-size: 24px !important;
                  line-height: 24px;
                  word-break: break-word;
               }
               .input-form {
                  .myinput {
                     font-size: 13px !important;
                  }
               }
            }
         }
      }
   }
}
</style>
