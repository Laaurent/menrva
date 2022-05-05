<template>
   <section class="flex flex-col gap-6">
      <article class="flex flex-col items-center mt-4 lg:bg-mywhite rounded-lg py-6">
         <h2 class="mb-4 text-center">Des étudiants qualifiés pour le futur du notorariat</h2>
         <div class="">
            <SearchbarComponent :search_button="true" @submitForm="searchUsers($event)"></SearchbarComponent>
         </div>
         <div class="mt-6">
            <p class="text-center text-sm lg:px-36">
               Avec <b>Menrva</b>, que vous soyez étudiant dans le domaine juridique ou un professionnel à la recherche de la pépite, vous trouverez ce que vous
               cherchez. Rencontrez la personne parfaite répondant à vos besoins les plus techniques. Vous êtes étudiant ?
               <a href="/register">inscrivez-vous</a> sur la plateforme directement.
            </p>
         </div>
      </article>

      <article>
         <h4 class="text-lg">Les nouveaux diplômés</h4>
         <div v-if="users.loading" class="my-2">
            <SpinnerComponent></SpinnerComponent>
         </div>
         <div v-else class="flex flex-col lg:flex-row lg:overflow-x-scroll gap-3 py-2">
            <HomeUserCardComponent v-for="(user, index) in users.data" :key="index" :user="user" :width="true"></HomeUserCardComponent>
         </div>
      </article>
   </section>
</template>

<script>
import SearchbarComponent from "../../components/SearchbarComponent.vue";
import HomeUserCardComponent from "../home/HomeUserCardComponent.vue";
import SpinnerComponent from "../../components/SpinnerComponent.vue";
export default {
   components: { SearchbarComponent, HomeUserCardComponent, SpinnerComponent },
   data() {
      return {
         users: {
            page: 1,
            last_page: 1,
            total: null,
            loading: false,
            data: [],
            status: null,
            error: false,
         },
      };
   },
   mounted() {
      this.getAllUsers();
   },
   methods: {
      async getAllUsers() {
         this.users.loading = true;
         let result = null;
         try {
            result = await axios.get(`/users/lastformation`);
            this.users.data = result.data;
         } catch (error) {
            result = error.response;
            console.error(error);
            this.users.error = true;
         } finally {
            this.users.status = result.status;
            this.users.loading = false;
         }
      },
      searchUsers(event) {
         console.log(event);
         window.location = `/rechercher?pattern=${event.pattern}&place=${event.place}`;
      },
   },
};
</script>

<style></style>
