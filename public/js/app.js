const app = new Vue({
    el: '#app',
    data: {
        title: myTitle,
        self: this,
        rendered: false,
        users: [],
        allowAdd: true,
        errors: null,
    },
    methods: {
        showEdit: function (element) {
            element.toEdit = true;
        },
        hideEdit: function (element, obj) {
            let now = new Date().toJSON();
            obj.updated_at.value = now.slice(0, 10) + ' ' + now.slice(11, 19);
            element.toEdit = false;

            // Update, if ID present
            if (obj.id.value) {
                // @TODO send to UPDATE endpoint
            }
        },
        addUser: function () {
            let that = this;
            this.allowAdd = false;
            axios.get(myApi + 'users/blank')
                .then(function (response) {
                    that.users.unshift(response.data);
                    that.hideErrors();
                })
                .catch(function (error) {
                    that.showErrors(error);
                })
                .finally(function () {
                    that.allowAdd = true;
                });
        },
        saveUser: function (newUser) {
            let that = this;

            axios.post(myApi + 'users/add', newUser)
                .then(function (response) {
                    newUser.id = response.data.id;
                    newUser.name = response.data.name;
                    newUser.email = response.data.email;
                    newUser.created_at = response.data.created_at;

                    that.hideErrors();
                })
                .catch(function (error) {
                    that.showErrors(error);
                });
        },
        showErrors: function (errors) {
            let that = this;

            // Update errors
            if (typeof (errors.response) !== 'undefined' &&
                typeof (errors.response.data) !== 'undefined' &&
                typeof (errors.response.data.errors) !== 'undefined') {
                this.errors = errors.response.data.errors;
            } else {
                that.hideErrors;
            }
        },
        hideErrors: function () {
            this.errors = null;
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
            that.hideErrors();
        }).catch(function (error) {
            that.showErrors(error);
        });
    },
});
