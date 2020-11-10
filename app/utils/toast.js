import toast from 'react-native-root-toast';

export default class Toast {
    static show = (message, options) => {
        return toast.show(message, {
            position:toast.positions.CENTER,
            shadow:false,
            ...options
        });
    }
}
