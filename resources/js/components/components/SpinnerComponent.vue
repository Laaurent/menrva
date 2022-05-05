<template>
   <section class="flex" :class="position == 'center' ? 'justify-center' : ''">
      <article class="flex flex-col items-center text-sm text-mydarkgrey">
         <div class="w-12 h-12">
            <!-- Outer Ring-->
            <div class="w-12 h-12 rounded-full absolute border-2 border-solid border-gray-200"></div>

            <!-- Inner Ring -->
            <div class="w-12 h-12 rounded-full animate-spin absolute border-2 border-solid border-myprimary border-t-transparent"></div>
         </div>
         <p class="mt-2 flex">Un instant... <EmojiComponent type="rocket" size="18"></EmojiComponent></p>
      </article>
   </section>
</template>

<script>
import EmojiComponent from "./EmojiComponent.vue";
export default {
   props: {
      position: { default: "center" },
   },
   components: { EmojiComponent },
};
</script>

<style></style>
