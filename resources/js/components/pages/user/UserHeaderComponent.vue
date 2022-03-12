<template>
   <div class="user-header-container">
      <div class="user-header-container__background"></div>
      <div class="user-header-container__infos">
         <div class="user-header-container__infos_img"></div>
         <div class="user-header-container__infos_main">
            <div class="infos__main_text">
               <div class="infos__main_name">
                  <VueSkeletonLoader v-if="user_loaded" class="skeleton" type="rect" :width="300" :height="32" animation="fade" rounded />
                  <template v-else>
                     <form class="infos__main_name_update input-form" v-if="edit">
                        <input class="myinput" v-model="lastNameUppercase" placeholder="NOM" type="text" />
                        <input class="myinput" v-model="form.first_name" placeholder="Prénom" type="text" />
                     </form>
                     <h1 v-else>{{ fullname }}</h1>

                     <div>
                        <EditButtonComponent
                           :loading="loading_user"
                           @update:click="edit = !edit"
                           @update:user="updateUserProfil('name', id, form)"
                        ></EditButtonComponent>
                        <IconComponent type="certified"></IconComponent>
                     </div>
                  </template>
               </div>
               <div class="infos__main_place">
                  <VueSkeletonLoader v-if="user_loaded" class="skeleton" type="rect" :width="150" :height="16" animation="fade" rounded />
                  <template v-else>
                     <form class="infos__main_name_update input-form" v-if="edit">
                        <input class="myinput" v-model="form.city" placeholder="Ville" type="text" />
                     </form>
                     <div v-else>
                        <IconComponent type="place" size="12"></IconComponent>
                        <h6 :style="!city ? 'font-style: italic' : ''">{{ form.city ? form.city : "non renseigné" }}</h6>
                     </div>
                  </template>
               </div>
            </div>
            <div v-if="!is_user_logged" class="infos__main_button">
               <IconComponent type="comment"></IconComponent>
               <IconComponent type="like"></IconComponent>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
import VueSkeletonLoader from "skeleton-loader-vue";
import EditButtonComponent from "../../components/EditButtonComponent.vue";
import IconComponent from "../../components/svg/IconComponent.vue";
import { useAuth } from "../../../store/useAuth";
import { useUser } from "../../../store/useUser";
import { mapActions, mapState } from "pinia";
export default {
   components: { IconComponent, EditButtonComponent, VueSkeletonLoader },
   props: ["id", "first_name", "last_name", "user_loaded", "city"],
   data() {
      return {
         is_user_logged: true,
         edit: false,
         loading: false,
         form: {
            first_name: null,
            name: null,
            city: null,
         },
      };
   },
   watch: {
      first_name() {
         this.form.first_name = this.first_name;
         this.form.name = this.last_name;
         this.form.city = this.city;
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
      ...mapActions(useAuth, {
         async userLogged(store) {
            const user_log = await store.userLog();
            this.is_user_logged = user_log;
            console.log(user_log);
            return user_log;
         },
      }),
      ...mapState(useUser, ["loading_user"]),
   },
   methods: {
      ...mapActions(useUser, ["updateUserProfil"]),
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
         width: 120px;
         background-color: $mywhite;
         border-radius: 50%;
         height: 120px;
      }
      .user-header-container__infos_main {
         flex: 1;
         display: flex;
         justify-content: space-between;

         .infos__main_text {
            h1 {
               margin: 0;
            }
            div {
               display: flex;
               align-items: center;
            }
            .infos__main_name {
               .input-form {
                  .myinput {
                     margin: 2px 0;
                     display: inline;
                     width: 180px;
                     font-size: 24px;
                  }
               }
               gap: 16px;
            }
         }
      }
   }
}
@media only screen and (max-width: 900px) {
   .user-header-container__infos_img {
      width: 100px !important;
      height: 100px !important;
   }
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
                  max-width: 120px;
                  word-break: break-word;
               }
               .input-form {
                  .myinput {
                     width: 120px !important;
                     font-size: 16px !important;
                  }
               }
            }
            .infos__main_place {
               .input-form {
                  .myinput {
                     width: 120px !important;
                     font-size: 13px !important;
                  }
               }
            }
         }
      }
   }
}
</style>
