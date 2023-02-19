import {StyleSheet} from 'react-native';
import Colors from "./Colors";

const HeaderStyles = StyleSheet.create({
    headerStyle: {
        backgroundColor: '#fff',
    },
    headerTitleStyle: {
        fontSize: 18
    },
    headerLeft: {
        flexDirection: 'row',
        justifyContent: 'flex-start',
        marginLeft: -8
    },
    headerRight: {
        flexDirection: 'row',
        justifyContent: 'flex-start',
        marginRight: 10,
    },
});


export default HeaderStyles;
