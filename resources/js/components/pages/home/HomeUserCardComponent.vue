<template>
   <section :style="width ? 'min-width: 300px' : ''" class="bg-mygrey2 rounded-lg px-6 py-4 xl:w-96 h-72 flex flex-col justify-center">
      <article class="flex items-center gap-3 h-16">
         <img class="w-16 h-16 rounded-full object-cover" :src="`/img/avatars/${user.id}/avatar.png`" alt="user image" />
         <div>
            <h3 class="text-black text-lg mb-0">{{ user.name.toUpperCase() }} {{ user.first_name }}</h3>
            <h6 class="leading-none text-myprimary my-0" v-if="user.last_formation[0]">
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
         <div class="flex justify-end items-center gap-2">
            <button
               v-if="user_log && !is_student"
               class="btn p-0"
               @click="
                  liked = !liked;
                  $emit('update:like', { liked: liked, user_id: user.id });
               "
            >
               <IconComponent v-if="!liked" type="like" color="primary"></IconComponent>
               <IconComponent v-else type="liked" color="primary"></IconComponent>
            </button>
            <form v-if="editable && user_log" class="input-form">
               <select
                  v-model="playlist_tmp"
                  class="myinput px-1 !rounded-full !w-10"
                  @change="$emit('add:playlist', { user_id: user.id, playlist_id: playlist_tmp })"
               >
                  <option value="" disabled></option>
                  <option v-for="(playlist, index) in playlists_list" :key="'playlist_' + index" :value="playlist.id">
                     {{ playlist.name ? playlist.name : "Playlist " + playlist.id }}
                  </option>
               </select>
            </form>

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
      user_log: {
         default: 0,
      },
      like_view: {
         default: false,
      },
      playlists_list: {
         default: null,
      },
      editable: {
         default: false,
      },
      is_student: {
         default: false,
      },
   },
   data() {
      return {
         liked: this.user.isLikedByAuthUser,
         playlist_tmp: "",
      };
   },
   watch: {
      "user.isLikedByAuthUser": function () {
         this.liked = this.user.isLikedByAuthUser;
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
