require('./common');
import App from './pages/item/App';

new Vue({
    el:"#app",
    render:function (h) {
        return h(App);
    }
});
