module.exports = {
   content: ["./storage/framework/views/*.php", "./resources/**/*.blade.php", "./resources/**/*.js", "./resources/**/*.vue"],
   darkMode: false, // or 'media' or 'class'
   theme: {
      extend: {
         colors: {
            myblack: "#102347",
            myprimary: "#286BEE",
            mygrey: "#FEFEFE",
            mywhite: "#FFFFFF",
            mygrey2: "#E7ECEE",
            mygrey3: "#F6F6F6",
            mydarkgrey: "#7A868C",
            myred: "#EB4F4F",
            mygreen: "#0acf83",
         },
         zIndex: {
            negative: -1,
         },
         width: {
            1500: "70rem",
            900: "50rem",
            800: "48rem",
            700: "42rem",
            650: "40rem",
            600: "38rem",
            500: "32rem",
            300: "20rem",
         },
         minHeight: {
            72: "18rem",
         },
      },
   },
   variants: {
      extend: {},
   },
   plugins: [
      require("flowbite/plugin"),
      require("@tailwindcss/line-clamp"),
      // ...
   ],
};
