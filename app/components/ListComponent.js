import React from 'react';
import {View} from 'react-native';
import {ApiClient} from "../utils";

export default class ListComponent extends React.Component {
    offset = 0;
    pageSize = 15;
    listApi = '';

    constructor(props) {
        super(props);
        this.state = {
            loading: true,
            refreshing: false,
            loadingMore: false,
            finished: false,
            dataList: [],
            params: {}
        };
    }

    render(): React.ReactNode {
        return <View/>;
    }

    fetchList = () => {
        let offset = this.offset;
        let count = this.pageSize;
        let {params, loadingMore} = this.state;

        let response = ApiClient.get(this.listApi, {...params, offset, count}).then(response => {
            let {dataList} = this.state;
            let {items, total} = response.result;
            if (this.state.loadingMore) {
                dataList = dataList.concat(items);
            } else {
                dataList = items;
            }

            let finished = dataList.length === total;
            this.setState({
                dataList,
                finished,
                loading: false,
                refreshing: false,
                loadingMore: false,
            }, () => {
                this.onLoaded(response);
                if (finished) {
                    this.onFinished();
                }
            });
        }).catch(reason => {
            console.log(reason);
        });
    };

    onRefresh = () => {
        if (this.state.loading || this.state.refreshing || this.state.loadingMore) {
            return false;
        }

        this.offset = 0;
        this.setState({refreshing: true}, () => {
            setTimeout(this.fetchList, 1000);
        });
    };

    onEndReached = () => {
        if (this.state.loading || this.state.refreshing || this.state.loadingMore || this.state.finished) {
            return false;
        }

        this.offset += 20;
        this.setState({loadingMore: true}, () => {
            setTimeout(this.fetchList, 500);
        });
    };

    onLoaded = () => {

    };

    onFinished = () => {

    }
}
