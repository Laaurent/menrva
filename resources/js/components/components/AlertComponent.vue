<template>
   <section v-if="show" class="flex justify-center py-2">
      <div
         :class="type == 'success' ? 'bg-mylightgreen text-mygreen' : type == 'danger' ? 'bg-mylightred text-myred' : 'bg-mylightblue text-myblue'"
         class="p-2 items-center leading-none rounded-full flex w-600"
         role="alert"
      >
         <span class="flex rounded-full uppercase px-2 py-1 text-xs font-bold mr-3 text-mywhite">
            <IconComponent :type="type" :color="types[type].main"></IconComponent>
         </span>
         <span class="mr-2 text-left flex-auto">{{ text ? text : types[type].text }} {{ status != 200 ? `( ${status} )` : "" }} </span>
         <span class="h-8"></span>
         <!-- <button class="btn" @click="show = false">
            <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
               <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
            </svg>
         </button> -->
      </div>
   </section>
</template>

<script>
import IconComponent from "./svg/IconComponent.vue";
export default {
   props: {
      type: { required: true },
      text: { required: false },
      status: { default: 200 },
   },
   data() {
      return {
         show: true,
         types: {
            success: { main: "mygreen", light: "mylightgreen", text: "L'action à été réalisée avec succés. " },
            danger: { main: "myred", light: "mylightred", text: "Oups... Une erreur est survenue. " },
            info: { main: "myblue", light: "mylightblue", text: "Informations..." },
         },
      };
   },
   components: { IconComponent },
};
</script>

<style></style>
