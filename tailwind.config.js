module.exports = {
   content: ["./storage/framework/views/*.php", "./resources/**/*.blade.php", "./resources/**/*.js", "./resources/**/*.vue"],
   darkMode: false, // or 'media' or 'class'
   theme: {
      extend: {
         colors: {
            myblack: "#1a3463",
            myprimary: "#286BEE",
            mygrey: "#FEFEFE",
            mywhite: "#FFFFFF",
            mygrey2: "#E7ECEE",
            mygrey3: "#F6F6F6",
            mydarkgrey: "#7A868C",
            myred: "#eb4f4f",
            mygreen: "#0acf83",
            myblue: "#3069AC",

            mylightyellow: "#FBF7D7",
            mylightred: "#fff4f4",
            mylightgreen: "#ebfdeb",
            mylightblue: "#EAEFF9",
            mylightpink: "#FFE9FF",
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
