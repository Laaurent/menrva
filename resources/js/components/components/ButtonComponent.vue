<template>
   <a class="btn" :class="getClassButton()" :href="url">{{ text }}</a>
</template>

<script>
export default {
   props: ["text", "type", "url"],
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
$myblack: #102347;
$myprimary: #286bee;
$mygrey: #fefefe;
$mywhite: #ffffff;
$mygrey2: #e7ecee;
$mygrey3: #f6f6f6;
$mydarkgrey: #7a868c;
.btn {
   width: 120px;
   font-size: 14px;
   padding: 8px 16px;
   border: none;
   border-radius: 30px;
}
.btn-primary {
   color: $mywhite;
   background-color: $myprimary;
}
.btn-empty {
   background: none;
}
.btn-outline-primary {
   background: none;
   border: 2px solid $myprimary;
}
.btn-outline-secondary {
   background: none;
   border: 2px solid $mydarkgrey;
}
</style>
