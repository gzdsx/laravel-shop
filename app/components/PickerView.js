import Picker from "react-native-picker";

const init = (options) => {
    Picker.init({
        pickerTitleText: '请选择',
        pickerConfirmBtnText: '确定',
        pickerCancelBtnText: '取消',
        pickerBg: [255, 255, 255, 1],
        pickerToolBarBg: [250, 250, 250, 1],
        pickerFontSize: 18,
        pickerFontFamily: 'Arial',
        pickerRowHeight: 40,
        ...options
    });
}

export default {
    ...Picker,
    init
}
