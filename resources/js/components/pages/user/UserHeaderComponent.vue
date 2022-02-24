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
                     <h1>{{ fullname }}</h1>
                     <div>
                        <CertifiedComponent></CertifiedComponent>
                     </div>
                  </template>
               </div>
               <div class="infos__main_place">
                  <VueSkeletonLoader v-if="user_loaded" class="skeleton" type="rect" :width="150" :height="16" animation="fade" rounded />
                  <template v-else>
                     <PlaceComponent size="12"></PlaceComponent>
                     <h6 :style="!place ? 'font-style: italic' : ''">{{ place ? place : "non renseigné" }}</h6>
                  </template>
               </div>
            </div>
            <div class="infos__main_button">
               <CommentComponent></CommentComponent>
               <LikeComponent></LikeComponent>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
import VueSkeletonLoader from "skeleton-loader-vue";
import CertifiedComponent from "../../components/svg/CertifiedComponent.vue";
import PlaceComponent from "../../components/svg/PlaceComponent.vue";
import CommentComponent from "../../components/svg/CommentComponent.vue";
import LikeComponent from "../../components/svg/LikeComponent.vue";
export default {
   components: { CertifiedComponent, PlaceComponent, CommentComponent, LikeComponent, VueSkeletonLoader },
   props: ["id", "first_name", "last_name", "user_loaded", "place"],
   data() {
      return {};
   },
   computed: {
      fullname() {
         return this.last_name?.toUpperCase() + " " + this.first_name;
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
               gap: 16px;
            }
         }
      }
   }
}
@media only screen and (max-width: 900px) {
   /*   .user-header-container__infos_img {
       width: 80px !important;
      height: 80px !important;
   } */
   .user-header-container__infos {
      gap: 16px !important;
      padding: 0 16px !important;
      .user-header-container__infos_main {
         flex-direction: column;
      }
   }
}
</style>
