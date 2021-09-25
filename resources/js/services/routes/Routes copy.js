import Loader from "../../components/admin/Loader";
//const Foo = () => import(/* webpackChunkName: "group-foo" */ './Foo.vue')
//let Dashboard = () => import('../../components/admin/Dashboard.vue');

import Dashboard from "../../components/admin/Dashboard.vue";
import AllBases from "../../components/admin/pages/bases/AllBases";
import BaseClasses from "../../components/admin/pages/classes/BaseClasses";


let BaseClasses = resolve => {
    require.ensure(['../../components/admin/pages/classes/BaseClasses'],()=>{
        resolve(require('../../components/admin/pages/classes/BaseClasses'));
    });
};
let Fields = resolve => {
    require.ensure(['../../components/admin/pages/customFields/Fields'],()=>{
        resolve(require('../../components/admin/pages/customFields/Fields'));
    });
};
let FieldCreate = resolve => {
    require.ensure(['../../components/admin/pages/customFields/FieldCreate'],()=>{
        resolve(require('../../components/admin/pages/customFields/FieldCreate'));
    });
};
let FieldEdit = resolve => {
    require.ensure(['../../components/admin/pages/customFields/FieldEdit'],()=>{
        resolve(require('../../components/admin/pages/customFields/FieldEdit'));
    });
};
let FieldOptions = resolve => {
    require.ensure(['../../components/admin/pages/customFields/options/Options'],()=>{
        resolve(require('../../components/admin/pages/customFields/options/Options'));
    });
};
let OptionCreate = resolve => {
    require.ensure(['../../components/admin/pages/customFields/options/OptionCreate'],()=>{
        resolve(require('../../components/admin/pages/customFields/options/OptionCreate'));
    });
};
let OptionEdit = resolve => {
    require.ensure(['../../components/admin/pages/customFields/options/OptionEdit'],()=>{
        resolve(require('../../components/admin/pages/customFields/options/OptionEdit'));
    });
};
let StudentEdit = resolve => {
    require.ensure(['../../components/admin/pages/students/StudentEdit'],()=>{
        resolve(require('../../components/admin/pages/students/StudentEdit'));
    });
};
let Courses = resolve => {
    require.ensure(['../../components/admin/pages/courses/Courses'],()=>{
        resolve(require('../../components/admin/pages/courses/Courses'));
    });
};
let CourseCreate = resolve => {
    require.ensure(['../../components/admin/pages/courses/CourseCreate'],()=>{
        resolve(require('../../components/admin/pages/courses/CourseCreate'));
    });
};
let CourseEdit = resolve => {
    require.ensure(['../../components/admin/pages/courses/CourseEdit'],()=>{
        resolve(require('../../components/admin/pages/courses/CourseEdit'));
    });
};
let CourseClasses = resolve => {
    require.ensure(['../../components/admin/pages/courses/courseClasses/CourseClasses'],()=>{
        resolve(require('../../components/admin/pages/courses/courseClasses/CourseClasses'));
    });
};
let CourseClassCreate = resolve => {
    require.ensure(['../../components/admin/pages/courses/courseClasses/CourseClassCreate'],()=>{
        resolve(require('../../components/admin/pages/courses/courseClasses/CourseClassCreate'));
    });
};
let TariffBases = resolve => {
    require.ensure(['../../components/admin/pages/tariffsBases/TariffBases'],()=>{
        resolve(require('../../components/admin/pages/tariffsBases/TariffBases'));
    });
};
let TariffBaseCreate = resolve => {
    require.ensure(['../../components/admin/pages/tariffsBases/TariffBaseCreate'],()=>{
        resolve(require('../../components/admin/pages/tariffsBases/TariffBaseCreate'));
    });
};
let VuetifyStudents = resolve => {
    require.ensure(['../../components/admin/pages/courses/courseStudents/VuetifyStudents'],()=>{
        resolve(require('../../components/admin/pages/courses/courseStudents/VuetifyStudents'));
    });
};
let ActiveCourseStudents = resolve => {
    require.ensure(['../../components/admin/pages/students/ActiveCourseStudents'],()=>{
        resolve(require('../../components/admin/pages/students/ActiveCourseStudents'));
    });
};
let StudentQuickRegister = resolve => {
    require.ensure(['../../components/admin/pages/students/StudentQuickRegister'],()=>{
        resolve(require('../../components/admin/pages/students/StudentQuickRegister'));
    });
};
let StudentShow = resolve => {
    require.ensure(['../../components/admin/pages/students/StudentShow'],()=>{
        resolve(require('../../components/admin/pages/students/StudentShow'));
    });
};
let Azmoons = resolve => {
    require.ensure(['../../components/admin/pages/azmoon/azmoons/Azmoons'],()=>{
        resolve(require('../../components/admin/pages/azmoon/azmoons/Azmoons'));
    });
};
let AzmoonCreate = resolve => {
    require.ensure(['../../components/admin/pages/azmoon/azmoons/AzmoonCreate'],()=>{
        resolve(require('../../components/admin/pages/azmoon/azmoons/AzmoonCreate'));
    });
};
let AzmoonShow = resolve => {
    require.ensure(['../../components/admin/pages/azmoon/azmoons/AzmoonShow'],()=>{
        resolve(require('../../components/admin/pages/azmoon/azmoons/AzmoonShow'));
    });
};
let AzmoonEdit = resolve => {
    require.ensure(['../../components/admin/pages/azmoon/azmoons/AzmoonEdit'],()=>{
        resolve(require('../../components/admin/pages/azmoon/azmoons/AzmoonEdit'));
    });
};
let AzmoonDateEdit = resolve => {
    require.ensure(['../../components/admin/pages/azmoon/azmoons/AzmoonDateEdit'],()=>{
        resolve(require('../../components/admin/pages/azmoon/azmoons/AzmoonDateEdit'));
    });
};
let AnalyticalReport = resolve => {
    require.ensure(['../../components/admin/pages/azmoon/azmoons/AnalyticalReport'],()=>{
        resolve(require('../../components/admin/pages/azmoon/azmoons/AnalyticalReport'));
    });
};
let SMSGroupClasses = resolve => {
    require.ensure(['../../components/admin/pages/SMS/SMSGroups/SMSGroupClasses'],()=>{
        resolve(require('../../components/admin/pages/SMS/SMSGroups/SMSGroupClasses'));
    });
};
let ImportExcelStudents = resolve => {
    require.ensure(['../../components/admin/pages/students/ImportExcelStudents'],()=>{
        resolve(require('../../components/admin/pages/students/ImportExcelStudents'));
    });
};

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

            {path:'course-students',name:'ActiveCourseStudents',component:ActiveCourseStudents},

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

            {path:'sms-group-form',name:'SMSGroupClasses',component:SMSGroupClasses},
        ],
    },
];

export default allUrl;
