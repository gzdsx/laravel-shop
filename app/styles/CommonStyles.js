import {StyleSheet} from "react-native";

const CommonStyles = StyleSheet.create({
    flexRow: {
        flexDirection: 'row'
    },
    flexFill: {
        flex: 1
    },
    alignItemsCenter: {
        alignItems: 'center'
    },
    justifyContentCenter: {
        justifyContent: 'center'
    },
    flexCenter: {
        alignItems: 'center',
        justifyContent: 'center'
    },
    bottomBar: {
        backgroundColor: '#fff',
        borderTopColor: '#e2e2e2',
        borderTopWidth: 0.5,
        padding: 10
    }
});

export default CommonStyles;
