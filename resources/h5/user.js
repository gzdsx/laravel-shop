require('./common');
import App from './pages/user/App';

new Vue({
    el: "#app",
    render: function (h) {
        return h(App);
    }
});
