const app = new Vue({
    el: '#app',
    data: {
        title: myTitle,
        rendered: false,
        allowAdd: true,
        users: [],
        errors: [],
    },
    methods: {
        /**
         * Show element edit option
         *
         * @param element
         */
        showEdit: function (element) {
            element.toEdit = true;
        },

        /**
         * Hide element edit option and save, if element is created
         *
         * @param element
         * @param obj
         */
        hideEdit: function (element, obj) {
            // Modify update date
            let now = new Date().toJSON();
            obj.updated_at.value = now.slice(0, 10) + ' ' + now.slice(11, 19);
            element.toEdit = false;

            // Update, if ID present
            if (obj.id.value) {
                this.updateUser(obj);
            }
        },

        /**
         * Add user to table, for editing
         */
        addUser: function () {
            let that = this;
            this.allowAdd = false;

            // Fetch new user structure
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

        /**
         * Send user candidate db and receive back new user or error
         *
         * @param newUser
         */
        saveUser: function (newUser) {
            let that = this;

            // Post data to server
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

        /**
         * Update user
         *
         * @param user
         */
        updateUser: function (user) {
            let that = this;

            axios.put(myApi + 'users/update/' + user.id.value, user)
                .then(function (response) {
                    that.hideErrors();
                })
                .catch(function (error) {
                    that.showErrors(error);
                });
        },

        /**
         * Delete user
         *
         * @param user
         */
        deleteUser: function (user) {
            let that = this;
            document.getElementById("delete-" + user.id.value).classList.add('disabled');

            axios.delete(myApi + 'users/delete/' + user.id.value)
                .then(function (response) {
                    that.users = that.users.filter(v => v !== user)
                    that.hideErrors();
                })
                .catch(function (error) {
                    that.showErrors(error);
                })
                .finally(function () {
                    let elements = document.getElementsByClassName("delete-btn disabled");
                    while (elements.length > 0) {
                        elements[0].classList.remove('disabled');
                    }
                });
        },

        /**
         * Show errors, if any
         *
         * @param errors
         */
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

        /**
         * Hide all errors
         */
        hideErrors: function () {
            this.errors = null;
        },
    },
    mounted: function () {
        let that = this;

        // Fetch data
        axios.get(myApi + 'users')
            .then(function (response) {
                that.users = response.data

                // Show hidden elements
                document.getElementById("app").classList.remove('hide');
                document.getElementById("loader").classList.add('hide');

                // Set rendered to true
                that.rendered = true;
                that.hideErrors();
            })
            .catch(function (error) {
                that.showErrors(error);
            });
    },
});
