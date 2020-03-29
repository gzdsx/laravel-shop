require('./common');
import App from './pages/catlog/App';

new Vue({
    el: "#app",
    render: function (h) {
        return h(App);
    }
});
