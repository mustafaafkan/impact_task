<template>
    <el-form ref="form" :model="form" :rules="rules" label-width="auto" style="max-width: 600px">
        <el-form-item label="Credit number:" prop="credit_number">
            <el-select v-model="form.credit_number" placeholder="Select" style="width: 240px"
                @change="handleCurrentChange">
                <el-option v-for="credit in this.$root.credits" :key="credit.credit_id" :label="credit.credit_number"
                    :value="credit.credit_id" />
            </el-select>
        </el-form-item>
        <el-form-item label="Amount in BGN:" prop="monthly_installment">
            <el-input-number v-model="form.monthly_installment" />
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="submitForm('form')">Pay installment</el-button>
        </el-form-item>
    </el-form>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            form: {
                credit_number: null,
                monthly_installment: 0,
            },
            rules: {
                credit_number: [
                    { required: true, message: 'Please select a credit', trigger: 'blur' },
                ],
            },
        }
    },
    methods: {
        handleCurrentChange(id) {
            var credits = this.$root.credits;
            var currentCredit = credits.filter((value) => value.credit_id == id);
            if (currentCredit.length) {
                this.form.monthly_installment = currentCredit[0]['monthly_installment'];
            }
        },
        submitForm(formName) {
            let formEl = this.$refs[formName];
            var self = this;
            this.errors = {};
            formEl.validate((valid) => {
                if (valid) {
                    axios.post(this.base_url + '/monthly-installment', {
                        formData: this.form,
                    })
                        .then(function (response) {
                            if (response) {
                                alert('You have successfully created the credit');
                                location.reload();
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
        },
    }
}
</script>