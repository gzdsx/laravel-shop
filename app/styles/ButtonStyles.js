import {StyleSheet} from "react-native";
import Colors from "./Colors";

const buttonHeight = 45;
const ButtonStyles = StyleSheet.create({
    primary: {
        backgroundColor: Colors.primary,
        height: buttonHeight
    },
    success: {
        backgroundColor: Colors.success,
        height: buttonHeight
    },
    info: {
        backgroundColor: Colors.info,
        height: buttonHeight
    },
    warning: {
        backgroundColor: Colors.warning,
        height: buttonHeight
    },
    danger: {
        backgroundColor: Colors.danger,
        height: buttonHeight
    }
});

export default ButtonStyles;
