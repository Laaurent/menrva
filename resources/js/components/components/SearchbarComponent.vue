<template>
   <form class="w-full flex-1 flex flex-col items-center gap-3" @submit.prevent="$emit('submitForm', { place: place, pattern: keywords })">
      <div class="w-full relative text-gray-600 focus-within:text-gray-400 bg-mygrey2 rounded-md flex">
         <div class="flex items-center">
            <IconComponent type="place" size="16" color="grey"></IconComponent>
            <input
               v-model="place"
               type="search"
               name="p"
               class="border-0 xl:w-36 w-full py-2 text-sm pr-10 focus:outline-none focus:text-gray-900 bg-mygrey2 rounded-md"
               placeholder="Localisation..."
               autocomplete="off"
            />
         </div>
         <div class="flex items-center">
            <IconComponent type="flag" size="16" color="grey"></IconComponent>
            <input
               v-model="keywords"
               type="search"
               name="q"
               class="border-0 xl:w-96 w-full py-2 text-sm pr-10 focus:outline-none focus:text-gray-900 bg-mygrey2 rounded-md"
               placeholder="Mots clés..."
               autocomplete="off"
            />
         </div>

         <span v-if="!search_button" class="absolute inset-y-0 right-0 flex items-center pr-2">
            <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
               <IconComponent type="search" size="16"></IconComponent>
            </button>
         </span>
      </div>
      <div v-if="search_button" class="flex flex-col items-center">
         <button class="btn btn-primary !px-8 !flex items-center gap-2">
            <IconComponent type="search" color="white"></IconComponent>
            <span>Recherche</span>
         </button>
         <!--  <a href="/register">S'inscrire</a> -->
      </div>
   </form>
</template>

<script>
import IconComponentVue from "./svg/IconComponent.vue";
import IconComponent from "./svg/IconComponent.vue";
export default {
   props: {
      search_button: {
         type: Boolean,
         default: false,
      },
      pattern_text: {
         type: String,
         default: "",
      },
      place_text: {
         type: String,
         default: "",
      },
   },
   components: {
      IconComponentVue,
      IconComponent,
   },
   data() {
      return {
         keywords: null,
         place: null,
      };
   },
   mounted() {
      console.log("t", this.pattern_text);
      this.keywords = this.pattern_text;
      this.place = this.place_text;
   },
};
</script>

<style></style>
