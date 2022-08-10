<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel VUE experiment</title>

    <!-- Styles -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/css/app.css" rel="stylesheet">

    <script>
        const myApi = 'http://127.0.0.1/api/';
        const myTitle = 'Users list';
    </script>
</head>
<body>
<div class="container" v-if="rendered">
    <hr/>

    @verbatim
    <div id="loader">Loading ...</div>
    <div id="app" class="hide">

        <h4 style="width: 100%;"> {{ title }}
            <span style="float: right;">
                <button class="btn btn-success" v-bind:class="{ 'disabled': !allowAdd }" @click="addUser">&nbsp;+&nbsp;</button>
            </span>
        </h4>

        <!-- spacer -->
        <br/>

        <!-- Error Alert -->
        <div v-for="(error, index) in errors">
            <div v-for="(err, i) in error">
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ error[i] }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
            <th style="width: 20px;"></th>
            <th>ID</th>
            <th>Full Name</th>
            <th>E-mail</th>
            <th>Create Date</th>
            <th>Updated Date</th>
            <th style="max-width: 200px;"></th>
            </thead>
            <tbody v-if="users">
            <tr v-for="(user, index) in users">
                <td style="font-size: 12px; color: #ccc;">{{ index + 1 }}</td>
                <td>{{ user.id.value }}</td>
                <td>
                    <span class="editable" @click="showEdit(user.name)" v-if="!user.name.toEdit">{{ user.name.value }}</span>
                    <input v-if="user.name.toEdit" type="text" class="form-control" v-model:value="user.name.value" style="max-width: 200px;" v-on:keyup.enter="hideEdit(user.name, user)" />
                </td>
                <td>
                    <span class="editable" @click="showEdit(user.email)" v-if="!user.email.toEdit">{{ user.email.value }}</span>
                    <input v-if="user.email.toEdit" type="text" class="form-control" v-model:value="user.email.value" style="max-width: 200px;" v-on:keyup.enter="hideEdit(user.email, user)" />
                </td>
                <td>
                    <span class="editable" @click="showEdit(user.created_at)" v-if="!user.created_at.toEdit">{{ user.created_at.value }}</span>
                    <input v-if="user.created_at.toEdit" type="text" class="form-control" v-model:value="user.created_at.value" style="max-width: 200px;" v-on:keyup.enter="hideEdit(user.created_at, user)" />
                </td>
                <td>
                    {{ user.updated_at.value }}
                </td>
                <td>
                    <span v-if="!user.id.value">Password<br/></span>
                    <div class="btn-group" role="group" v-if="!user.id.value">
                        <input type="text" class="form-control" v-model:value="user.password.value" style="max-width: 200px;" />
                        <button class="btn btn-primary" @click="saveUser(user)">Save</button>
                    </div>
                </td>
            </tr>
            </tbody>
            <tbody v-else>
            <tr>
                <td colspan="100%" class="bg-warning text-center"><em>- no users found -</em></td>
            </tr>
            </tbody>
        </table>

    </div>
    @endverbatim

    <hr/>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" defer></script>
<script src="/js/app.js" defer></script>
</body>
</html>
