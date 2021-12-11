<template>
   <button class="btn" :class="getClassButton()">{{ text }}</button>
</template>

<script>
export default {
   props: ["text", "type"],
   methods: {
      getClassButton() {
         return {
            "btn-primary": this.type == "primary",
            "btn-empty": this.type == "empty",
            "btn-outline-primary": this.type == "outline-primary",
            "btn-outline-secondary": this.type == "outline-secondary",
         };
      },
   },
};
</script>

<style lang="scss" scoped>
.btn {
   font-size: 14px;
   padding: 8px 32px;
   border: none;
   border-radius: 30px;
}
.btn-primary {
   color: #fff;
   background-color: #000;
}
.btn-empty {
   background: none;
}
.btn-outline-primary {
   background: none;
   border: 2px solid #000;
}
.btn-outline-secondary {
   background: none;
   border: 2px solid #888888;
}
</style>
