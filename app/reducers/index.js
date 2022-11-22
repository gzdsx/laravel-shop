"use strict";

import {combineReducers} from 'redux';
import oauth from './oauth';
import location from './location';
import userInfo from './userInfo';

module.exports = combineReducers({
    oauth,
    location,
    userInfo,
});
