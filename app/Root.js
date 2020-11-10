import React from 'react';
import {Provider} from 'react-redux';
import * as WeChat from 'react-native-wechat';
import configureStore from './store/configureStore';
import App from './containers/App';
import {sagas} from "./sagas";
import {WeChatAppId} from "./base/constants";

const store = configureStore();
store.runSaga(sagas);

export default class Root extends React.Component{
    render() {
        return (
            <Provider store={store}>
                <App />
            </Provider>
        );
    }

    componentDidMount(): void {
        WeChat.registerApp(WeChatAppId).then(res=>{
            //console.log('wecahtApp registered');
        }).catch(reason => {
            console.log(reason);
        });
    }
}
