import React from 'react';
import {ApiClient} from "../../utils";

export const AddToCart = (itemid, quantity = 1, sku_id = 0, callback = () => null) => {
    ApiClient.post('/cart/create', {
        itemid,
        quantity,
        sku_id
    }).then(response => {
        if (callback) callback(response.data);
    });
};
