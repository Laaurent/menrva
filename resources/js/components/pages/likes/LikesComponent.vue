<template>
   <section class="mt-2">
      <!-- Header -->
      <article class="flex items-center gap-2 mb-4">
         <h2 class="text-uppercase font-bold">Mes listes</h2>
         <button>
            <span class="flex items-center gap-1">
               <IconComponent type="plus" :size="12"></IconComponent>
               Nouveau
            </span>
         </button>
      </article>
      <!-- en attente -->
      <article class="">
         <h5>En attente</h5>
         <div>
            <!--  empty state -->
            <div v-if="pending.data && pending.data.length == 0" class="h-40 w-40 flex justify-center items-center">vide</div>
            <div v-if="pending.loading" class="my-2">
               <SpinnerComponent></SpinnerComponent>
            </div>
            <div v-else class="flex flex-row overflow-x-scroll gap-3 py-2">
               <HomeUserCardComponent v-for="(like, index) in pending.data" :key="index" :user="like.user_liked" :width="true"></HomeUserCardComponent>
            </div>
         </div>
      </article>
   </section>
</template>

<script>
import IconComponent from "../../components/svg/IconComponent.vue";
import AlertComponent from "../../components/AlertComponent.vue";
export default {
   props: {
      user_id: {
         required: true,
      },
   },
   components: { IconComponent, AlertComponent },
   data() {
      return {
         user_tmp: null,
         error_code: 200,
         pending: {
            user_tmp: null,
            error_code: 200,
            loading: false,
            data: null,
         },
      };
   },
   mounted() {
      this.getLikes();
   },
   methods: {
      async getLikes() {
         this.pending.loading = true;
         try {
            const result = await axios.get(`/likes?user_id=${this.user_id}`);
            this.pending.data = result.data;
            this.pending.error_code = result.data ? 200 : 500;
         } catch (error) {
            this.pending.error_code = error.response.status;
         } finally {
            this.pending.loading = false;
         }
      },
   },
};
</script>

<style></style>
