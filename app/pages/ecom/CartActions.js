import React from 'react';
import {ApiClient} from "../../utils";

export const addToCart = (itemid, sku_id = 0, quantity = 1) => {
    return new Promise((resolve, reject) => {
        ApiClient.post('/ecom/cart.create', {
            itemid,
            sku_id,
            quantity,
        }).then(response => {
            resolve(response);
        }).catch(reason => {
            reject(reason);
        })
    });
};

export const removeFromCart = (itemid) => {
    return new Promise((resolve, reject) => {
        ApiClient.post('/ecom/cart.delete', {itemid}).then(response => {
            resolve(response);
        }).catch(reason => {
            reject(reason);
        });
    });
}

export const updateQuantity = (itemid, quantity) => {
    return new Promise((resolve, reject) => {
        ApiClient.post('/ecom/cart.updateQuantity', {itemid, quantity}).then(response => {
            resolve(response);
        }).catch(reason => {
            reject(reason)
        });
    });
}


export default {
    addToCart,
    removeFromCart,
    updateQuantity
}
