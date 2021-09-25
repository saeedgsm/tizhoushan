import Vue from "vue";
import vuelidate from "vuelidate";
import vuelidateErrorExtractor, { templates } from "vuelidate-error-extractor";

Vue.use(vuelidate);
Vue.use(vuelidateErrorExtractor, {
    /**
     * Optionally provide the template in the configuration.
     * or register like so Vue.component("FormField", templates.singleErrorExtractor.foundation6)
     */
    template: templates.singleErrorExtractor.foundation6, // you can also pass your own custom template
    messages: {
        required: " {attribute} اجبازی می باشد!",
    }, // error messages to use
    attributes: { // maps form keys to actual field names
        email: "ایمیل",
        first_name: "اسم کوچک",
        last_name: "نام خانوادگی",
        field_name: "نام فیلد",
        field_name_latin: "نام لاتین فیلد",
    }
});