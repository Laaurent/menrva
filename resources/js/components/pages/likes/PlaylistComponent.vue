<template>
   <article class="mb-4">
      <div class="flex items-center gap-2">
         <form v-if="edit" class="input-form flex items-center gap-2">
            <input class="myinput" type="text" v-model="name" placeholder="Nom de la playlist" />
            <button class="btn p-0">
               <IconComponent type="save" size="16"></IconComponent>
            </button>
         </form>
         <div v-else class="flex items-center gap-2">
            <h5>En attente</h5>
            <button v-if="editable" class="btn p-0" @click="edit = true">
               <IconComponent type="edit" size="16"></IconComponent>
            </button>
            <button v-if="editable" class="btn p-0" @click="$emit('destroy:playlist', id)">
               <IconComponent type="trash" size="16" color="red"></IconComponent>
            </button>
         </div>
      </div>

      <div>
         <!--  empty state -->
         <div v-if="data && data.length == 0" class="h-40 w-full flex justify-center items-center">
            <span class="italic color-mydarkgrey">Aucun utilisateur...</span>
         </div>
         <div v-if="loading" class="my-2">
            <SpinnerComponent></SpinnerComponent>
         </div>
         <div v-else class="flex flex-row overflow-x-scroll gap-3 py-2">
            <HomeUserCardComponent v-for="(like, index) in data" :key="index" :user="like.user_liked" :width="true"></HomeUserCardComponent>
         </div>
      </div>
   </article>
</template>

<script>
import IconComponent from "../../components/svg/IconComponent.vue";
export default {
   props: {
      editable: {
         default: true,
      },
      data: {
         required: true,
      },
      id: {
         default: null,
      },
   },
   data() {
      return {
         error_code: 200,
         loading: false,
         name: null,
         edit: false,
      };
   },
   components: { IconComponent },
   methods: {},
};
</script>

<style></style>
