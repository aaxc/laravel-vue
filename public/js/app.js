const app = new Vue({
    el: '#app',
    data: {
        title: myTitle,
        self: this,
        rendered: false,
        users: [],
        empty_user: {},
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
            this.users.unshift(this.saveUser(this.empty_user));
        },
        saveUser: function (newUser) {
            // @TODO Implement DB save
            let dbUser = newUser;
            return dbUser;
        },
    },
    mounted: function () {
        var that = this;

        // Fetch data
        axios.get(myApi + 'users').then(function (userResponse) {
            axios.get(myApi + 'users/blank').then(function (blankResponse) {
                that.users = userResponse.data
                that.empty_user = blankResponse.data

                // Show hidden elements
                document.getElementById("app").classList.remove('hide');
                document.getElementById("loader").classList.add('hide');

                // Set rendered to true
                that.rendered = true;
            });
        });
    },
});
