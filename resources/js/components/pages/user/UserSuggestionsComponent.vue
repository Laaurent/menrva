<template>
   <div class="pt-8 xl:pt-0">
      <article class="flex justify-between">
         <h5>SUGGESTIONS</h5>
         <a class="hidden xl:block" href="/">voir tout</a>
      </article>
      <article v-if="!user_suggestions || (user_suggestions && user_suggestions.length == 0)" class="text-mydarkgrey italic text-sm my-2">
         Aucune suggestion...
      </article>
      <article v-else class="flex justify-between items-center py-2" v-for="(user, index) in user_suggestions" :key="'user_sugg_' + index">
         <div class="flex gap-3">
            <div class="w-12 h-12 rounded-full overflow-hidden">
               <img class="w-full h-full object-cover" :src="`/img/avatars/${user.id}/avatar.png`" />
            </div>
            <div class="flex flex-col flex-1">
               <h5>{{ user.name.toUpperCase() }} {{ user.first_name }}</h5>
               <span class="text-secondary" v-if="user.city && user.city_department">{{ user.city }} ({{ user.city_department }})</span>
               <span v-else class="text-mydarkgrey italic text-sm">Aucune localisation</span>
            </div>
         </div>

         <a class="no-underline" :href="`/profil/${user.id}`"> > </a>
      </article>
   </div>
</template>

<script>
export default {
   props: ["user_id"],
   data() {
      return {
         user_suggestions: null,
      };
   },
   mounted() {
      this.getSuggestion();
   },
   methods: {
      async getSuggestion() {
         try {
            let result = await axios.get(`/users/suggestions/${this.user_id}`);
            this.user_suggestions = result.data.data;
            this.error_code = 200;
            this.user_loaded = false;
         } catch (error) {
            this.error_code = error.response.status;
         }
      },
   },
};
</script>

<style></style>
