import Loader from "../../components/admin/Loader";
import Dashboard from "../../components/admin/Dashboard.vue";
import AllBases from "../../components/admin/pages/bases/AllBases";
import BaseClasses from "../../components/admin/pages/classes/BaseClasses";
import Fields from "../../components/admin/pages/customFields/Fields";
import FieldCreate from "../../components/admin/pages/customFields/FieldCreate";
import FieldEdit from "../../components/admin/pages/customFields/FieldEdit";
import FieldOptions from "../../components/admin/pages/customFields/options/Options";
import OptionCreate from "../../components/admin/pages/customFields/options/OptionCreate";
import OptionEdit from "../../components/admin/pages/customFields/options/OptionEdit";
import StudentEdit from "../../components/admin/pages/students/StudentEdit";
import Courses from "../../components/admin/pages/courses/Courses";
import CourseEdit from "../../components/admin/pages/courses/CourseEdit";
import CourseCreate from "../../components/admin/pages/courses/CourseCreate";
import CourseClasses from "../../components/admin/pages/courses/courseClasses/CourseClasses";
import CourseClassCreate from "../../components/admin/pages/courses/courseClasses/CourseClassCreate";
import TariffBases from "../../components/admin/pages/tariffsBases/TariffBases";
import TariffBaseCreate from "../../components/admin/pages/tariffsBases/TariffBaseCreate";
import VuetifyStudents from "../../components/admin/pages/courses/courseStudents/VuetifyStudents";
import ActiveCourseStudents from "../../components/admin/pages/students/ActiveCourseStudents";
import StudentQuickRegister from "../../components/admin/pages/students/StudentQuickRegister";
import StudentShow from "../../components/admin/pages/students/StudentShow";
import Azmoons from "../../components/admin/pages/azmoon/azmoons/Azmoons";
import AzmoonCreate from "../../components/admin/pages/azmoon/azmoons/AzmoonCreate";
import AzmoonShow from "../../components/admin/pages/azmoon/azmoons/AzmoonShow";
import AzmoonEdit from "../../components/admin/pages/azmoon/azmoons/AzmoonEdit";
import AzmoonDateEdit from "../../components/admin/pages/azmoon/azmoons/AzmoonDateEdit";
import AnalyticalReport from "../../components/admin/pages/azmoon/azmoons/AnalyticalReport";
import SMSGroupClasses from "../../components/admin/pages/SMS/SMSGroups/SMSGroupClasses";
import ImportExcelStudents from "../../components/admin/pages/students/ImportExcelStudents";
import MomentReport from "../../components/admin/pages/azmoon/azmoons/MomentReport";
import Students from "../../components/admin/pages/students/Students";
import Books from "../../components/admin/pages/books/Books";

const allUrl = [
    {path:'/admin',component:Loader,redirect:'/admin/dashboard',
        children:[
            {path:'dashboard',name:'Dashboard',component:Dashboard},
            {path:'Bases-all',name:'AllBases',component:AllBases},
            {path:'base-classes/:id',name:'BaseClasses',component:BaseClasses},
            {path:'fields',name:'Fields',component:Fields},
            {path:'field/create',name:'FieldCreate',component:FieldCreate},
            {path:'field/edit/:id',name:'FieldEdit',component:FieldEdit},
            {path:'field/options/:id',name:'FieldOptions',component:FieldOptions},
            {path:'field/option/create/:id',name:'OptionCreate',component:OptionCreate},
            {path:'field/option/edit/:id',name:'OptionEdit',component:OptionEdit},

            {path:'active-course-students',name:'ActiveCourseStudents',component:ActiveCourseStudents},

            {path:'student-all',name:'Students',component:Students},
            {path:'student-import-excel',name:'ImportExcelStudents',component:ImportExcelStudents},
            {path:'student-quick-register',name:'StudentQuickRegister',component:StudentQuickRegister},
            {path:'student-edit/:id',name:'StudentEdit',component:StudentEdit},
            {path:'student-show/:id',name:'StudentShow',component:StudentShow},

            {path:'courses-all',name:'Courses',component:Courses},
            {path:'course-create',name:'CourseCreate',component:CourseCreate},

            {path:'course-edit/:id',name:'CourseEdit',component:CourseEdit},

            {path:'course-classes/:id',name:'CourseClasses',component:CourseClasses},
            {path:'course-class/create/:id',name:'CourseClassCreate',component:CourseClassCreate},

            {path:'vuetify-students/:id',name:'VuetifyStudents',component:VuetifyStudents},

            {path:'tariff-bases',name:'TariffBases',component:TariffBases},
            {path:'tariff-base/create',name:'TariffBaseCreate',component:TariffBaseCreate},

            {path:'azmoons-all',name:'Azmoons',component:Azmoons},
            {path:'azmoon-create',name:'AzmoonCreate',component:AzmoonCreate},
            {path:'azmoon-show/:id',name:'AzmoonShow',component:AzmoonShow},
            {path:'azmoon-edit/:id',name:'AzmoonEdit',component:AzmoonEdit},
            {path:'azmoon-date-edit/:id',name:'AzmoonDateEdit',component:AzmoonDateEdit},
            {path:'analytical-report/:id',name:'AnalyticalReport',component:AnalyticalReport},
            {path:'moment-report/:id',name:'MomentReport',component:MomentReport},

            {path:'sms-group-form',name:'SMSGroupClasses',component:SMSGroupClasses},

            {path:'books-all',name:'Books',component:Books},
        ],
    },
];

export default allUrl;
