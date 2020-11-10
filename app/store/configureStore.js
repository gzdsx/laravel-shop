import {createStore, applyMiddleware} from 'redux';
import createSagaMiddleWare, {END} from 'redux-saga';
import {persistStore} from 'redux-persist';
import reducers from '../reducers';

const middlewares = [];

const sagaMiddleWare = createSagaMiddleWare();
middlewares.push(sagaMiddleWare);

const {logger} = require('redux-logger');

if (__DEV__) {
    middlewares.push(logger);
}

const createStoreWithMiddleware = applyMiddleware(...middlewares)(createStore);

function configureStore(onComplete: ?() => void) {
    const store = createStoreWithMiddleware(reducers);
    // install saga run
    store.runSaga = sagaMiddleWare.run;
    store.close = () => store.dispatch(END);

    persistStore(store, {}, _ => onComplete(store));

    return store;
}

module.exports = configureStore;
