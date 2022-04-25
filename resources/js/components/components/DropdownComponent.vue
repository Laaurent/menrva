<template>
   <section class="relative">
      <button
         :class="type == 'action' ? 'w-7 h-7' : ''"
         @click="show = !show"
         class="lg:w-9 lg:h-9 rounded-lg flex justify-center items-center border-2 hover:bg-mygrey2"
      >
         <IconComponent v-if="type == 'action'" type="action"></IconComponent>
         <span v-if="type == 'filter'" class="px-2 py-1 flex items-center gap-2">
            <IconComponent type="filter" size="16"></IconComponent> <span class="lg:hidden">Filtre</span></span
         >
      </button>
      <article
         v-if="show"
         @mouseleave="show = false"
         :class="type == 'filter' ? 'w-40' : ''"
         class="z-10 right-0 absolute bg-mywhite rounded text-mydarkgrey drop-shadow-xl px-4 py-2"
      >
         <form @submit.prevent="">
            <ul class="mb-0 p-0 text-left" v-if="type == 'action'">
               <li class="py-1">
                  <button class="hover:text-myblack hover:font-semibold flex gap-2 items-center" @click="$emit('project:select')">
                     <IconComponent type="info" size="16"></IconComponent> Informations
                  </button>
               </li>
               <li class="py-1">
                  <button class="hover:text-myblack hover:font-semibold flex gap-2 items-center">
                     <IconComponent type="archive" size="16"></IconComponent> Archiver
                  </button>
               </li>
               <li class="py-1 text-myred">
                  <button class="hover:font-semibold flex gap-2 items-center">
                     <IconComponent type="trash" color="myred" size="16"></IconComponent> Supprimer
                  </button>
               </li>
            </ul>
            <!-- FILTER -->
            <ul class="mb-0 p-0 text-left" v-if="type == 'filter'">
               <li class="py-1">
                  <button
                     :class="order.by == 'id' ? 'font-semibold text-myblack' : ''"
                     class="hover:text-myblack hover:font-semibold flex gap-2 items-center"
                     @click="$emit('order:update', { by: 'id', type: order.type == 'DESC' ? 'ASC' : 'DESC' })"
                  >
                     N° de dossier
                     <IconComponent v-if="order.by == 'id' && order.type == 'DESC'" type="arrow_down" size="16"></IconComponent>
                     <IconComponent v-if="order.by == 'id' && order.type == 'ASC'" type="arrow_up" size="16"></IconComponent>
                  </button>
               </li>
               <li class="py-1">
                  <button
                     :class="order.by == 'amount' && order.type == 'DESC' ? 'font-semibold text-myblack' : ''"
                     class="hover:text-myblack hover:font-semibold flex gap-2 items-center"
                     @click="$emit('order:update', { by: 'amount', type: order.type == 'DESC' ? 'ASC' : 'DESC' })"
                  >
                     Créance
                     <IconComponent v-if="order.by == 'amount' && order.type == 'DESC'" type="arrow_down" size="16"></IconComponent>
                     <IconComponent v-if="order.by == 'amount' && order.type == 'ASC'" type="arrow_up" size="16"></IconComponent>
                  </button>
               </li>
            </ul>
         </form>
      </article>
   </section>
</template>

<script>
import IconComponent from "./svg/IconComponent.vue";
export default {
   props: {
      type: { required: true },
      order: { required: false },
   },
   components: { IconComponent },
   data() {
      return {
         show: false,
      };
   },
};
</script>
