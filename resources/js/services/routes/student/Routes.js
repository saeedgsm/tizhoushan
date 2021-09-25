import Loader from "../../../components/student/Loader";
import Dashboard from "../../../components/student/Dashboard.vue";
import Panel from "../../../components/student/Panel.vue";
const allUrl = [
    {
        path: '/student', component: Loader, redirect: '/student/dashboard',
        children:[
            {path:'dashboard',name:'Dashboard',component:Dashboard},
            {path:'test',name:'Panel',component:Panel},
            ]
    }
];

export default allUrl;
