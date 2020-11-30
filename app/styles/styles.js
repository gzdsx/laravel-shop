import {StyleSheet} from 'react-native';
import {Colors} from "./index";

const Styles = StyleSheet.create({
    container: {
        backgroundColor: '#fff'
    },
    titleView: {
        paddingTop: 15,
        paddingBottom: 15,
        marginLeft: 15,
        marginRight: 15,
        backgroundColor: '#fff'
    },
    titleText: {
        fontSize: 20,
        fontWeight: '400',
        color: '#222'
    },
    headerStyle: {
        backgroundColor: Colors.primary,
        borderColor: Colors.primary,
        borderBottomWidth: 0,
        borderEndColor: Colors.primary,
        shadowColor: Colors.primary
    },
    headerTitleStyle: {
        fontSize: 18,
        color: '#fff',
    },
    headerLeft: {
        marginLeft: 10,
        flexDirection: 'row'
    },
    headerRight: {
        marginRight: 10,
        flexDirection: 'row'
    },
});


export default Styles;
