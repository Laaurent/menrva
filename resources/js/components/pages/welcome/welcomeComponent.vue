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
         <div class="flex overflow-x-scroll gap-3 py-2">
            <HomeUserCardComponent v-for="(user, index) in users.data" :key="index" :user="user" :width="true"></HomeUserCardComponent>
         </div>
      </article>
   </section>
</template>

<script>
import SearchbarComponent from "../../components/SearchbarComponent.vue";
import HomeUserCardComponent from "../home/HomeUserCardComponent.vue";
export default {
   components: { SearchbarComponent, HomeUserCardComponent },
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
      async getAllUsers(page = 1, pattern = "") {
         this.users.page = page;
         this.users.loading = true;
         let result = null;
         try {
            result = await axios.post(`/users/all?page=${this.users.page}&lastformation`, {
               pattern: this.users.pattern,
               place: this.users.place,
               order: this.users.order,
               is_closed: this.type == "closed" ? 1 : 0,
               client_id: this.client_id,
            });
            this.users.last_page = result.data.last_page;
            this.users.total = result.data.total;
            this.users.data = result.data.data;
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
