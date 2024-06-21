<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="bg-slate-100">
        <div id="app" v-cloak>
            <div class="wrapper mx-auto bg-red-500">
                <div class="flex justify-between items-center p-4">
                    <span class="font-bold">{{ strtoupper(__('index.title')) }}</span>
                    <ul class="flex gap-5">
                        <a href="{{ url('/') }}" class="cursor-pointer p-2 hover:bg-red-800 rounded-lg">Home</a>
                        <a href="{{ url('credits') }}" class="cursor-pointer p-2 hover:bg-red-800 rounded-lg">Create Credit</a>
                        <a href="{{ url('/create-payment') }}" class="cursor-pointer p-2 hover:bg-red-800 rounded-lg">Create Payment</a>
                    </ul>
                    <el-button 
                        type="success" 
                        color="rgb(153 27 27)"
                        @click="registerModalVisible = true">
                        Register user
                    </el-button>
                </div>
            </div>
            <!--  REGISTER USER MODAL   -->  
            <el-dialog v-model="registerModalVisible" title="Register User" width="500" center>
                @csrf
                <el-form 
                    :model="registerForm" 
                    label-width="auto" 
                    style="max-width: 600px"
                    :rules="rules" ref="registerForm">
                <el-form-item label="Name" prop="name">
                    <el-input v-model="registerForm.name" />
                </el-form-item>

                <el-form-item label="Email" prop="email">
                    <el-input v-model="registerForm.email"></el-input>
                </el-form-item>
                <span>Password will be set automatically !</span>
                </el-form>
                <template #footer>
                <div class="dialog-footer">
                    <el-button @click="registerModalVisible = false">Cancel</el-button>
                    <el-button type="primary" @click="submitRegisterForm('registerForm')">
                    Confirm
                    </el-button>
                </div>
                </template>
            </el-dialog>
            @yield('content')
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>