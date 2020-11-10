import React from "react";
import {TextInput} from "react-native";

const CustomTextInput = ({...props}) => {
    return (
        <TextInput
            underlineColorAndroid={"transparent"}
            placeholderTextColor={"#999"}
            returnKeyType={"done"}
            returnKeyLabel={"完成"}
            style={{
                color:'#333',
                borderWidth:0,
                textAlignVertical:'center',
                fontSize:16,
                includeFontPadding:false,
                padding:0,
                paddingVertical:0,
                paddingHorizontal:0,
                paddingEnd:0,
                paddingStart:0,
            }}
            {...props}
        />
    );
};

export default CustomTextInput;
