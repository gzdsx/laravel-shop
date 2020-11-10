"use strict";

import {combineReducers} from 'redux';
import auth from './auth';
import location from './location';

module.exports = combineReducers({
    auth,
    location
});
