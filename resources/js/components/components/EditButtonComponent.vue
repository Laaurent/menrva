<template>
   <button class="edit-button" @click="$emit('update:click')">
      <template v-if="!loading">
         <IconComponent v-if="edit_tmp" class="edit-button_edit-icon" type="edit" :size="size"></IconComponent>
      </template>
      <half-circle-spinner v-else :animation-duration="1000" :size="size" color="#286BEE" />
   </button>
</template>

<script>
import { HalfCircleSpinner } from "epic-spinners";
import IconComponent from "../components/svg/IconComponent.vue";
export default {
   props: {
      size: { default: 24 },
      loading: { default: true },
      edit: { default: false },
   },
   components: { IconComponent, HalfCircleSpinner },
   data() {
      return {};
   },
   computed: {
      edit_tmp() {
         return !this.edit;
      },
   },
   methods: {},
};
</script>

<style lang="scss">
@import "resources/sass/_variables.scss";
.edit-button {
   &:hover {
      svg {
         transform: scale(1);
         .edit-button_edit-icon {
            fill: $myblack;
         }
         .edit-button_save-icon {
            stroke: $myblack;
         }
      }
   }
   svg {
      transform: scale(0.9);
      .edit-button_edit-icon {
         fill: $myblack;
      }
      .edit-button_save-icon {
         stroke: $myblack;
      }
   }
}
</style>
