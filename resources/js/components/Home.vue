<template>
    
<el-table
    :data="this.$root.credits"
    style="width: 100%;">
    <el-table-column 
        label-class-name="text-blue-900 text-sm"
        class-name="text-blue-900 text-sm"
        prop="credit_number" 
        label="Credit number"/>
    <el-table-column 
        label-class-name="text-blue-900 text-sm"
        class-name="text-blue-900 text-sm"
        prop="borrower_name"
        label="Borrower name"/>
    <el-table-column 
        label-class-name="text-blue-900 text-sm"
        class-name="text-blue-900 text-sm"
        prop="amount"
        label="Amount" />
    <el-table-column 
        label-class-name="text-blue-900 text-sm"
        class-name="text-blue-900 text-sm"
        prop="term"
        label="Term" />
    <el-table-column 
    label-class-name="text-blue-900 text-sm"
    class-name="text-blue-900 text-sm"
    prop="monthly_installment"
    label="Monthly installment" />
</el-table>
</template>