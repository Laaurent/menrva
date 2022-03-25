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
      },
   },
   variants: {
      extend: {},
   },
   plugins: [],
};
