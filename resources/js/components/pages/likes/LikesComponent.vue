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
            <div class="h-40 w-40 flex justify-center items-center">vide</div>
         </div>
      </article>
   </section>
</template>

<script>
import IconComponent from "../../components/svg/IconComponent.vue";
export default {
   components: { IconComponent },
};
</script>

<style></style>
