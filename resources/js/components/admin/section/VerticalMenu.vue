<template>
    <div class="vertical-menu">
        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">منو</li>

                    <li>
                        <router-link :to="{name:'Dashboard'}"><div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                            <span>داشبرد</span></router-link>
                    </li>


                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-comment-message"></i></div>
                            <span>مدیریت دوره ها</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <router-link :to="{name:'Courses'}">دوره ها</router-link>
                            <router-link :to="{name:'AddCourse'}">افزودن دوره </router-link>
                        </ul>
                    </li>

                </ul>

            </div>
            <!-- Sidebar -->
        </div>
    </div>


</template>

<script>
    function verticalMenu() {

    }

    export default {
        name: "VerticalMenu",

    }
</script>

<style scoped>

</style>
