import React from 'react';
import {ApiClient} from "../../utils";

export const AddToCart = (itemid, quantity, callback=()=>null) => {
    ApiClient.post('/cart/create', {
        itemid,
        quantity
    }).then(response => {
         if (callback) callback(response.data);
    });
};
