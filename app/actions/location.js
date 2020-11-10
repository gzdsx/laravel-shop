import * as types from "./types";

export function userLocationDidChanged(location) {
    return {
        ...location,
        type: types.LOCATION_DID_CHANGE
    }
}
