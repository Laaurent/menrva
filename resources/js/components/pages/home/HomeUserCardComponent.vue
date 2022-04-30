<template>
   <section :style="width ? 'min-width: 350px' : ''" class="bg-mygrey2 rounded-lg px-6 py-4 xl:w-96 h-72 flex flex-col justify-center">
      <article class="flex items-center gap-3 h-16">
         <img class="w-16 h-16 rounded-full object-cover" :src="`/storage/avatars/${user.id}/avatar.png`" alt="user image" />
         <div>
            <h3 class="text-black text-lg">{{ user.name.toUpperCase() }} {{ user.first_name }}</h3>
            <h6 class="leading-none" v-if="user.last_formation[0]">
               {{ user.last_formation[0].name }}
            </h6>
            <div class="flex items-center mt-2 text-mydarkgrey" v-if="this.user.city">
               <IconComponent type="place" size="16" color="grey"></IconComponent>
               <p class="text-xs">{{ formatedPlace }}</p>
            </div>
         </div>
      </article>
      <article class="flex flex-col w-full">
         <p class="text-sm line-clamp-3 my-4 h-14" :class="!user.resume ? 'text-mydarkgrey text-xs' : ''">
            {{ user.resume ? user.resume : "Aucune information supplémentaire..." }}
         </p>
         <div class="flex justify-end">
            <a :href="`/profil/${user.id}`" class="no-underline text-myblack bg-white rounded-full px-3 py-1 flex items-center gap-2">
               En savoir plus<IconComponent type="right" size="16"></IconComponent>
            </a>
         </div>
      </article>
   </section>
</template>

<script>
import IconComponent from "../../components/svg/IconComponent.vue";
export default {
   props: {
      user: {
         required: true,
      },
      width: {
         default: false,
      },
   },
   components: { IconComponent },
   computed: {
      formatedPlace() {
         let string = this.user.city + " " + (this.user.city_department ? "(" + this.user.city_department + ")" : "");
         return string;
      },
   },
};
</script>

<style></style>
