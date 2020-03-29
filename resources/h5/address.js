require('./common');
import App from './pages/address/App';

new Vue({
    el: "#app",
    render: function (h) {
        return h(App);
    }
});
