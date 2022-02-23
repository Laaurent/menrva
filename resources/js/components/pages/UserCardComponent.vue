<template>
   <div class="card-container" :style="'flex:' + card_type[type].size">
      <h4>{{ card_type[type].name }}</h4>
      <p v-if="type == 'resume'">
         Lorem ipsum dolor sit amet, consectetur adipiscing elit. Convallis est dui neque, vel nulla magna eget mattis amet. Nullam potenti id ultrices urna eu
         vestibulum enim justo. Cursus ut ut tortor diam arcu, auctor feugiat suspendisse. Venenatis vivamus dictum porttitor posuere est egestas sit vestibulum
         facilisis. Turpis vulputate ac sit curabitur massa cursus. Phasellus aliquet arcu mauris nunc, ac. Vehicula congue in mattis enim nunc egestas interdum
         dictum quam. Eget donec leo aliquam at viverra cras tempus. Nisi, nisl eget id arcu ultrices egestas.
      </p>
      <p v-if="type == 'formation'">
         LOREM IPSUM 1900 - 1900 lorem ipsum LOREM IPSUM 1900 - 1900 lorem ipsum LOREM IPSUM 1900 - 1900 lorem ipsum LOREM IPSUM 1900 - 1900 lorem ipsum
      </p>
      <p v-if="type == 'experience'">
         LOREM IPSUM 1900 - 1900 lorem ipsum LOREM IPSUM 1900 - 1900 lorem ipsum LOREM IPSUM 1900 - 1900 lorem ipsum LOREM IPSUM 1900 - 1900 lorem ipsum
      </p>
      <p v-else>wip</p>
   </div>
</template>

<script>
export default {
   props: ["type"],
   data() {
      return {
         card_type: {
            resume: { name: "Résumé", size: 2 },
            formation: { name: "Résumé", size: 1 },
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
