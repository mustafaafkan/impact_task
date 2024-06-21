<template>
    <el-form ref="form" :model="form" label-width="auto" style="max-width: 600px" :rules="rules">
        <el-form-item label="Borrower's name:" prop="user_id">
            <el-select v-model="form.user_id" placeholder="Select" style="width: 240px">
                <el-option v-for="user in this.users.data" :key="user.id" :label="user.name" :value="user.id" />
            </el-select>
        </el-form-item>

        <el-form-item label="Amount in BGN:" prop="amount">
            <el-input-number :min="1" :max="80000" v-model="form.amount" />
        </el-form-item>

        <el-form-item label="Term:" prop="term">
            <el-slider class="ml-2" v-model="form.term" :min=3 :max=120 />
        </el-form-item>
        <div class="mb-2" v-for="(error, index) in errors">
            <span class="text-red-500 text-xs">{{ error[0] }}</span>
        </div>
        <el-form-item>
            <el-button type="primary" @click="submitForm('form')">Create</el-button>
        </el-form-item>
    </el-form>

    <el-table :data="this.$root.credits" style="width: 100%;">
        <el-table-column label-class-name="text-blue-900 text-sm" class-name="text-blue-900 text-sm"
            prop="credit_number" label="Credit number" />
        <el-table-column label-class-name="text-blue-900 text-sm" class-name="text-blue-900 text-sm"
            prop="borrower_name" label="Borrower name" />
        <el-table-column label-class-name="text-blue-900 text-sm" class-name="text-blue-900 text-sm" prop="amount"
            label="Amount" />
        <el-table-column label-class-name="text-blue-900 text-sm" class-name="text-blue-900 text-sm" prop="term"
            label="Term" />
        <el-table-column label-class-name="text-blue-900 text-sm" class-name="text-blue-900 text-sm"
            prop="monthly_installment" label="Monthly installment" />
    </el-table>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            users: [],
            form: {
                user_id: '',
                amount: 1,
                term: 0,
            },
            rules: {
                user_id: [
                    { required: true, message: 'Please input your name', trigger: 'blur' },
                ],
                amount: [
                    { type: 'number', min: 1, max: 80000, message: 'You cant have credits with a total value exceeding 80.000 BGN or below than 1 BGN', trigger: 'blur' },
                ]
            },
            errors: {},
        }
    },
    mounted() {
        this.getUsers()
    },
    methods: {
        getUsers() {
            var self = this;
            axios.get(this.base_url + '/get-users')
                .then(function (response) {
                    self.users = response.data;
                })
        },
        submitForm(formName) {
            let formEl = this.$refs[formName];
            var self = this;
            this.errors = {};
            formEl.validate((valid) => {
                if (valid) {
                    axios.post(this.base_url + '/credit', {
                        formData: this.form,
                    })
                        .then(function (response) {
                            console.log(response);
                            if (response) {
                                alert('You have successfully created the credit');
                                self.registerModalVisible = false;
                                self.$root.getCredits();
                            }
                        })
                        .catch(function (error) {
                            if (error.response.status === 422) {
                                self.errors = error.response.data.errors;
                            }
                        })
                } else {
                    console.log('Error submitting form!')
                    return false
                }
            });
        }
    }
}
</script>