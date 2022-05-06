<template>
   <div v-if="is_open" class="fixed top-0 bottom-0 left-0 right-0 flex justify-center z-30 items-center bg-myblack/25">
      <div class="text-center bg-mywhite min-h-72 w-300 px-10 z-40 py-4 rounded-lg flex flex-col justify-between items-center">
         <div class="pt-4">
            <h6>{{ data.type }}</h6>
            <h4 class="">{{ data.name }}</h4>
            <p class="text-primary mb-2">
               {{ month_format(data.start_date) }} -
               <span :class="!data.end_date ? 'italic' : ''">{{ data.end_date ? month_format(data.end_date) : "Aujourd'hui" }}</span>
            </p>
            <p>{{ data.resume }}</p>
         </div>

         <button class="btn" @click="$emit('close:modal')">
            <span class="flex gap-2 items-center"><IconComponent type="close" :size="14"></IconComponent> Fermer</span>
         </button>
      </div>
   </div>
</template>

<script>
import IconComponent from "./svg/IconComponent.vue";
import moment from "moment";
import "moment/locale/fr";
export default {
   components: { IconComponent },
   props: {
      is_open: {
         default: false,
      },
      data: {
         required: true,
      },
   },
   methods: {
      month_format(value) {
         return moment(value).format("MMMM YYYY");
      },
   },
};
</script>
