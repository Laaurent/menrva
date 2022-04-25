<template>
   <!-- PAGINATION START -->
   <div class="flex items-center gap-2">
      <section class="w-8 h-8 rounded-lg border-2">
         <button :disabled="current == 1" class="rounded flex justify-center items-center w-full h-full hover:bg-mygrey2" @click="prev" aria-label="Previous">
            <IconComponent type="left" size="18"></IconComponent>
         </button>
      </section>
      <section class="w-8 h-8 bg-myprimary rounded-lg flex justify-center items-center text-xl text-mywhite">
         <span>{{ current }}</span>
      </section>
      <section class="w-8 h-8 rounded-lg border-2">
         <button
            :disabled="current == last_page"
            class="rounded flex justify-center items-center w-full h-full hover:bg-mygrey2"
            @click="next()"
            aria-label="Next"
         >
            <IconComponent type="right" size="18"></IconComponent>
         </button>
      </section>
      <section class="w-8 h-8 rounded-lg">
         <button class="rounded flex justify-center items-center text-xl hover:bg-mygrey2 w-full h-full" @click="last()" aria-label="Next">
            {{ last_page }}
         </button>
      </section>
   </div>
   <!--end col-->
   <!-- PAGINATION END -->
</template>

<script>
import IconComponent from "./svg/IconComponent.vue";
export default {
   props: {
      page: { required: true },
      last_page: { required: false },
   },
   components: { IconComponent },
   data() {
      return {
         current: this.page,
         pageSize: 4,
         matchingJobs: {},
      };
   },
   methods: {
      prev() {
         if (this.current > 1) this.current--;
         this.$emit("page:update", this.current);
      },
      next() {
         if (this.current < this.last_page) this.current++;
         this.$emit("page:update", this.current);
      },
      last() {
         this.current = this.last_page;
         this.$emit("page:update", this.last_page);
      },
   },
   components: { IconComponent },
};
</script>

<style></style>
