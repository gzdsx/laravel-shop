import Picker from "react-native-picker";

const init = (options) => {
    Picker.init({
        pickerTitleText: '请选择薪资范围',
        pickerConfirmBtnText: '确定',
        pickerCancelBtnText: '取消',
        pickerBg: [255, 255, 255, 1],
        pickerToolBarBg: [245, 245, 245, 1],
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
