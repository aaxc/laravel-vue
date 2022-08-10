const app = new Vue({
    el: '#app',
    data: {
        title: myTitle,
        self: this,
        rendered: false,
        users: [],
        allowAdd: true,
    },
    methods: {
        showEdit: function (element) {
            element.toEdit = true;
        },
        hideEdit: function (element, updated_at) {
            let now = new Date().toJSON();
            updated_at.value = now.slice(0, 10) + ' ' + now.slice(11, 19);
            element.toEdit = false;
        },
        addUser: function () {
            let that = this;
            this.allowAdd = false;
            axios.get(myApi + 'users/blank').then(function (response) {
                that.users.unshift(response.data);
            }).catch(function () {
                console.log('Something went wrong!');
            }).finally(function () {
                that.allowAdd = true;
            });
        },
        saveUser: function (newUser) {
            axios.post(myApi + 'users/add', newUser).then(function (response) {
                newUser.id = response.data.id;
                newUser.name = response.data.name;
                newUser.email = response.data.email;
                newUser.created_at = response.data.created_at;
            }).catch(function () {
                console.log('Something went wrong!');
            });
        },
    },
    mounted: function () {
        let that = this;

        // Fetch data
        axios.get(myApi + 'users').then(function (response) {
            that.users = response.data

            // Show hidden elements
            document.getElementById("app").classList.remove('hide');
            document.getElementById("loader").classList.add('hide');

            // Set rendered to true
            that.rendered = true;
        }).catch(function () {
            console.log('Something went wrong!');
        });
    },
});
