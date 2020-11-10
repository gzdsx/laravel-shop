import * as types from '../actions/types';

const initialState = {
    coords:{
        accuracy:0,
        altitude:0,
        altitudeAccuracy:0,
        heading:0,
        latitude:0,
        longitude:0,
        speed:0
    },
    timestamp:0
};

function location(state = initialState, action) {
    if (action.type === types.LOCATION_DID_CHANGE) {
        const {coords, timestamp} = action;
        return Object.assign({}, state, {
            coords,
            timestamp
        });
    }
    return state;
}

module.exports = location;
