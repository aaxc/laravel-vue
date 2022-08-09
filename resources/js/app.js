const app = new Vue({
    el: '#app',
    data: {
        title: 'Users list',
        users: [
            {
                id: 1,
                username: 'dainisa',
                created_at: '2022'
            }
        ],
        rendered: 1,
    },
    mounted: function () {
        this.rendered = 2
    },
});
