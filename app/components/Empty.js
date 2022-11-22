import {Text, View} from "react-native";
import Icon from "react-native-vector-icons/AntDesign";

export default ({description = null,style={}}) => (
    <View style={{
        paddingVertical: 10,
        alignItems: 'center',
        justifyContent: 'center',
        ...style
    }}>
        <Icon
            size={60}
            color={'#939393'}
            name={'dashboard'}
            suppressHighlighting={true}
        />
        <Text style={{fontSize: 16, color: '#838383', marginTop: 15}}>{description}</Text>
    </View>
)
