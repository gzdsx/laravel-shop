import {StatusBar} from "react-native";
import {isAndroid} from "../base/constants";
import Colors from "./Colors";

let setToDarkStyle = (animated = false) => {
    StatusBar.setBarStyle('dark-content', animated);
    if (isAndroid) StatusBar.setBackgroundColor('#fff', animated);
}

let setToLightStyle = (animated = false) => {
    StatusBar.setBarStyle('light-content', animated);
    if (isAndroid) StatusBar.setBackgroundColor(Colors.primary, animated);
}

export default {
    setToDarkStyle,
    setToLightStyle
}
