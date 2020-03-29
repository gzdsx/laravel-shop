require('./common');
import App from './pages/cart/App';

new Vue({
    el: "#app",
    render: function (h) {
        return h(App);
    }
});
