<template>
   <section>
      <!-- HEADER -->
      <article class="flex flex-col xl:flex-row py-4">
         <div class="flex xl:items-center flex-col xl:flex-row gap-2">
            <form class="w-full flex-1 flex items-center gap-3" @submit.prevent="getAllUsers()">
               <div class="w-full relative text-gray-600 focus-within:text-gray-400 bg-mygrey3 rounded-md flex">
                  <div class="flex items-center">
                     <IconComponent type="place" size="16" color="grey"></IconComponent>
                     <input
                        v-model="users.place"
                        type="search"
                        name="p"
                        class="xl:w-36 w-full py-2 text-sm pr-10 focus:outline-none focus:text-gray-900 bg-mygrey3 rounded-md"
                        placeholder="Localisation..."
                        autocomplete="off"
                     />
                  </div>
                  <div class="flex items-center">
                     <IconComponent type="flag" size="16" color="grey"></IconComponent>
                     <input
                        v-model="users.pattern"
                        type="search"
                        name="q"
                        class="xl:w-96 w-full py-2 text-sm pr-10 focus:outline-none focus:text-gray-900 bg-mygrey3 rounded-md"
                        placeholder="Mots clés..."
                        autocomplete="off"
                     />
                  </div>

                  <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                     <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                        <IconComponent type="search" size="16"></IconComponent>
                     </button>
                  </span>
               </div>
            </form>
            <div class="flex justify-between items-center gap-2">
               <p class="text-mydarkgrey text-xs">{{ users.data ? users.data.length : 0 }} Résultat(s)</p>
               <!-- <DropdownComponent type="filter"></DropdownComponent> -->
            </div>
         </div>
      </article>

      <article class="flex flex-col gap-2">
         <!--  EMPTY STATE -->
         <div v-if="users.data.length == 0" class="flex flex-col justify-center items-center gap-2 py-4 h-96">
            <p class="text-mydarkgrey font-medium text-sm">Aucun utilisateur...</p>
         </div>
         <div class="flex flex-col xl:flex-row xl:flex-wrap items-center justify-center gap-2 w-full" v-else>
            <HomeUserCardComponent class="w-full" v-for="(user, index) in users.data" :key="'userCard_' + index" :user="user"></HomeUserCardComponent>
         </div>
         <article v-if="users.data.length > 0" class="flex justify-center xl:justify-end py-4">
            <PaginationComponent :last_page="users.last_page" :page="users.page" @page:update="getAllUsers($event)"></PaginationComponent>
         </article>
      </article>
   </section>
</template>

<script>
import DropdownComponent from "../../components/DropdownComponent.vue";
import HomeUserCardComponent from "./HomeUserCardComponent.vue";
import PaginationComponent from "../../components/PaginationComponent.vue";
export default {
   components: { DropdownComponent, HomeUserCardComponent, PaginationComponent },
   data() {
      return {
         users: {
            pattern: "",
            place: "",
            order: {
               by: "id",
               type: "DESC",
            },
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
   },
};
</script>

<style></style>
