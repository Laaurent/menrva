<template>
   <section>
      <!-- HEADER -->
      <article class="flex flex-col xl:flex-row py-4">
         <div class="flex xl:items-center flex-col xl:flex-row gap-2">
            <SearchbarComponent
               :pattern_text="pattern != 'null' ? pattern : ''"
               :place_text="place != 'null' ? place : ''"
               @submitForm="
                  users.pattern = $event.pattern;
                  users.place = $event.place;
                  getAllUsers();
               "
            ></SearchbarComponent>

            <div class="flex justify-between items-center gap-2">
               <p class="text-mydarkgrey text-xs">{{ users.data ? users.total : 0 }} Résultat(s)</p>
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
import SearchbarComponent from "../../components/SearchbarComponent.vue";
export default {
   props: {
      place: {
         type: String,
         required: true,
      },
      pattern: {
         type: String,
         required: true,
      },
   },
   components: { DropdownComponent, HomeUserCardComponent, PaginationComponent, SearchbarComponent },
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
      this.pattern != "null" && (this.users.pattern = this.pattern);
      this.place != "null" && (this.users.place = this.place);
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
