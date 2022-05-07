<template>
   <section class="mt-2">
      <!-- Header -->
      <article class="flex items-center gap-2 mb-4">
         <h2 class="text-uppercase font-bold">Mes listes</h2>
         <button @click="createPlaylist">
            <span class="flex items-center gap-1">
               <IconComponent type="plus" :size="12"></IconComponent>
               Nouveau
            </span>
         </button>
      </article>
      <!-- en attente -->
      <PlaylistComponent
         :data="pending.data"
         :editable="false"
         :playlists_list="playlists.data"
         @add:playlist="addPlaylist($event.user_id, $event.playlist_id)"
         @update:like="updateLike($event)"
      ></PlaylistComponent>
      <!-- Mes playlists -->
      <PlaylistComponent
         v-for="(playlist, index) in playlists.data"
         :id="playlist.id"
         :data="playlist.likes"
         :key="'myplaylist_' + index"
         :name="playlist.name"
         @destroy:playlist="deletePlaylist($event)"
         @update:playlist="renamePlaylist($event.id, $event.name)"
         @update:like="updateLike($event)"
      ></PlaylistComponent>
   </section>
</template>

<script>
import IconComponent from "../../components/svg/IconComponent.vue";
import AlertComponent from "../../components/AlertComponent.vue";
import PlaylistComponent from "./PlaylistComponent.vue";
export default {
   props: {
      user_id: {
         required: true,
      },
   },
   components: { IconComponent, AlertComponent, PlaylistComponent },
   data() {
      return {
         user_tmp: null,
         error_code: 200,
         pending: {
            data: null,
            error_code: 200,
            loading: false,
         },
         playlists: {
            error_code: 200,
            loading: false,
            data: null,
         },
         playlist_tmp: null,
      };
   },
   mounted() {
      this.getLikes();
      this.getPlaylists();
   },
   methods: {
      async getLikes() {
         this.pending.loading = true;
         try {
            const result = await axios.get(`https://menrva-jgpnn.ondigitalocean.app/likes?user_id=${this.user_id}&pending=true`);
            this.pending.data = result.data;
            this.pending.error_code = result.data ? 200 : 500;
         } catch (error) {
            this.pending.error_code = error.response.status;
         } finally {
            this.pending.loading = false;
         }
      },
      async getPlaylists() {
         this.playlists.loading = true;
         try {
            const result = await axios.get(`https://menrva-jgpnn.ondigitalocean.app/playlists?user_id=${this.user_id}`);
            this.playlists.data = result.data;
            this.playlists.error_code = result.data ? 200 : 500;
         } catch (error) {
            this.playlists.error_code = error.response.status;
         } finally {
            this.playlists.loading = false;
         }
      },
      async createPlaylist() {
         this.playlists.loading = true;
         try {
            const result = await axios.post(`https://menrva-jgpnn.ondigitalocean.app/playlists`);
            this.playlists.error_code = result.data ? 200 : 500;
         } catch (error) {
            this.playlists.error_code = error.response.status;
         } finally {
            this.playlists.loading = false;
            this.getPlaylists();
         }
      },
      async deletePlaylist(id) {
         this.playlists.loading = true;
         try {
            const result = await axios.delete(`https://menrva-jgpnn.ondigitalocean.app/playlists/${id}`);
            this.playlists.error_code = result.data ? 200 : 500;
         } catch (error) {
            this.playlists.error_code = error.response.status;
         } finally {
            this.playlists.loading = false;
            this.getLikes();
            this.getPlaylists();
         }
      },
      async renamePlaylist(id, name) {
         this.playlists.loading = true;
         try {
            const result = await axios.put(`https://menrva-jgpnn.ondigitalocean.app/playlists/${id}`, { name: name });
            this.playlists.error_code = result.data ? 200 : 500;
         } catch (error) {
            this.playlists.error_code = error.response.status;
         } finally {
            this.playlists.loading = false;
            this.getPlaylists();
         }
      },
      async addPlaylist(user_id, playlist_id) {
         this.playlists.loading = true;
         try {
            const result = await axios.put(`https://menrva-jgpnn.ondigitalocean.app/likes`, { user_id: user_id, playlist_id: playlist_id });
            this.playlists.error_code = result.data ? 200 : 500;
         } catch (error) {
            this.playlists.error_code = error.response.status;
         } finally {
            this.playlists.loading = false;
            this.getLikes();
            this.getPlaylists();
         }
      },
      async updateLike(event) {
         this.playlists.loading = true;
         try {
            let result = null;
            if (event.liked) {
               result = await axios.post(`https://menrva-jgpnn.ondigitalocean.app/likes`, { user_id: event.user_id });
            } else {
               result = await axios.post(`https://menrva-jgpnn.ondigitalocean.app/likes/delete`, { user_id: event.user_id });
            }
            this.playlists.error_code = result.data ? 200 : 500;
         } catch (error) {
            this.playlists.error_code = error.response.status;
         } finally {
            this.playlists.loading = false;
            this.getLikes();
            this.getPlaylists();
         }
      },
   },
};
</script>

<style></style>
