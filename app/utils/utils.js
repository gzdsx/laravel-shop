import {StatusBar, Platform, NetInfo} from 'react-native';
import ApiClient from "./apiclient";
import {Colors} from "../styles";

const setStatusBarStyle = (style = 'default') => {
    if (style === 'default' || style === 'dark') {
        StatusBar.setBarStyle('dark-content', false);
        if (Platform.OS === 'android') {
            StatusBar.setBackgroundColor('#fff', false);
        }
    }else {
        StatusBar.setBarStyle('light-content', false);
        if (Platform.OS === 'android') {
            StatusBar.setBackgroundColor(Colors.primary, false);
        }
    }
};

const addToCollection = (dataid, datatype, callback=()=>null, error=()=>null) => {
    ApiClient.post('/post/collect/add',{
        dataid,
        datatype
    }).then(response=>{
        if (callback) callback(response);
    }).catch(err=>{
        if (error) error(err);
    });
};

const connectAvailable = async () => {
    const connection = await NetInfo.getConnectionInfo();
    return !(connection.type === 'none' || connection.type === 'unkown');
};

export default {
    setStatusBarStyle,
    addToCollection,
    connectAvailable
};
