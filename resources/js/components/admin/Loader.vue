<template>
 <div>
   <transition name="slide-fade">
     <router-view></router-view>
   </transition>

 </div>

</template>

<script>
import Footer from "./section/Footer";
import HeaderCourses from "./section/HeaderCourses";

Vue.component('headerCourses',HeaderCourses);
Vue.component('myFooter',Footer);
    export default {

    }
</script>

<style scoped>

.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .2s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
  /* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}


.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
