import axios from "axios";
import { createApp } from 'vue';
import 'element-plus/dist/index.css';
import ElementPlus from 'element-plus';

import Credit from './components/Credit.vue';
import Home from './components/Home.vue';
import CreatePayment from './components/CreatePayment.vue';
const app = createApp({
    components: {
        'Credit': Credit,
        'Home': Home,
        'CreatePayment': CreatePayment,
    },
    data() {
        return {
            registerModalVisible: false,
            registerForm: {
                name: '',
                email: '',
            },
            rules: {
                email: [
                    { required: true, message: 'Please input your email address', trigger: 'blur' },
                    { type: 'email', message: 'Please input a valid email address', trigger: ['blur'] }
                ],
                name: [
                    { required: true, message: 'Please input your name', trigger: 'blur' },
                ]
            },
            credits: [],
        }
    },
    mounted() {
        this.getCredits()
    },
    methods: {
        submitRegisterForm(formName) {
            let formEl = this.$refs[formName];
            var self = this;
            formEl.validate((valid) => {
                if (valid) {
                    axios.post(this.base_url + '/register', {
                        formData: this.registerForm,
                    })
                        .then(function (response) {
                            if (response) {
                                alert('You have successfully created the user');
                                self.registerModalVisible = false;
                                location.reload();
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                } else {
                    console.log('Error submitting form!')
                    return false
                }
            });
        },
        getCredits() {
            var self = this;
            axios.get(this.base_url + '/get-credits')
                .then(function (response) {
                    self.credits = response.data;
                })
        }
    }

});
app.use(ElementPlus)
app.config.globalProperties.base_url = window.location.origin;
app.mount('#app');
