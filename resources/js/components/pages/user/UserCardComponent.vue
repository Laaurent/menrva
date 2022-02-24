<template>
   <div class="card-container" :style="'flex:' + card_type[type].size">
      <h4>{{ card_type[type].name }}</h4>
      <p v-if="type == 'resume'" :class="!resume ? 'unknown' : ''">
         <template v-if="user_loaded">
            <VueSkeletonLoader class="skeleton skeleton_full" type="rect" :height="13" animation="fade" rounded />
            <VueSkeletonLoader class="skeleton skeleton_full" type="rect" :height="13" animation="fade" rounded />
            <VueSkeletonLoader class="skeleton" type="rect" :width="150" :height="13" animation="fade" rounded
         /></template>
         <template v-else>
            {{ resume === "" ? resume : "Ne possède pas encore de résumé..." }}
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
export default {
   props: {
      type: { required: true },
      user_loaded: { required: true },
      resume: { required: false },
   },
   components: { VueSkeletonLoader },
   data() {
      return {
         card_type: {
            resume: { name: "Résumé", size: 2 },
            formation: { name: "Formation", size: 1 },
            other: { name: "other", size: 2 },
            experience: { name: "Expérience", size: 1 },
         },
      };
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
.card-container {
   padding: 32px 42px;
   background-color: $mygrey2;
   border-radius: 8px;
}
</style>
