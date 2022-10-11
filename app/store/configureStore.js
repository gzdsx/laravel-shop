import {createStore, applyMiddleware} from 'redux';
import createSagaMiddleWare, {END} from 'redux-saga';
import {persistStore, persistReducer} from 'redux-persist';
import reducers from '../reducers';
import {sagas} from '../sagas';
import AsyncStorage from "@react-native-async-storage/async-storage";

const middlewares = [];

const sagaMiddleWare = createSagaMiddleWare();
middlewares.push(sagaMiddleWare);

const {logger} = require('redux-logger');

if (__DEV__) {
    middlewares.push(logger);
}

const createStoreWithMiddleware = applyMiddleware(...middlewares)(createStore);
const persistedReducer = persistReducer({
    key: 'rootReducers',
    storage: AsyncStorage,
}, reducers);

async function configureStore(onCompelete: ?()=>void) {
    const store = createStoreWithMiddleware(persistedReducer);
    store.close = () => store.dispatch(END);
    let persistor = persistStore(store, {}, () => {
        // install saga run
        sagaMiddleWare.run(sagas);
        onCompelete && onCompelete({store, persistor});
    });
}

module.exports = configureStore;
