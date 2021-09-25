
import VueFormulate from '@braid/vue-formulate';

Vue.use(VueFormulate);
Vue.http.options.root = window.location.protocol + "//" + window.location.host + "/";

//Vue.component()
import EditStudent from "../../resources/js/components/student/EditStudent";
Vue.component('tags',EditStudent);

new Vue({
    el:"#app",
    methods:{
        getStudentFields:function (){
            //console.log(Vue.http.options.root);
            axios.get(Vue.http.options.root +'api/student/fields').then(response=>{
                console.log(response.data);

            }).then(rr=>{
                console.log(rr);
            });
        },
        addInputText(){

        }
    },
    created(){
        this.getStudentFields();
        //console.log('test');
    },
    render(createElement) {
        return createElement('custom-button', {
            attrs: {
                type: 'submit'
            },
            props: {
                text: this.buttonText
            }
        });
    }
});