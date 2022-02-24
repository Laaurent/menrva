<template>
   <div class="alert" :class="code_type[code].class">
      {{ code_type[code].text }}
   </div>
</template>

<script>
export default {
   props: ["code"],
   data() {
      return {
         code_type: {
            200: { text: "Opération réussie", class: "success" },
            404: { text: "Nous n'avons malheureusement pas réussi a trouver ce que vous cherchez...", class: "danger" },
            500: { text: "Aïe... Une erreur est survenue, merci de réessayer...", class: "danger" },
         },
      };
   },
};
</script>

<style lang="scss" scoped>
$myblack: #102347;
$myprimary: #286bee;
$mygrey: #fefefe;
$mywhite: #ffffff;
$mygrey2: #e7ecee;
$mygrey3: #f6f6f6;
$mydarkgrey: #7a868c;

$myred: #eb4f4f;
$mygreen: #0acf83;
.danger {
   background-color: rgba($myred, 0.3);
   color: $myred;
}
.success {
   background-color: rgba($mygreen, 0.3);
}
</style>
