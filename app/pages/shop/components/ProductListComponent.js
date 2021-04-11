import React from 'react';
import PropTypes from 'prop-types';
import ProductListView from "./ProductListView";
import {ApiClient} from "../../../utils";

class ProductListComponent extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            items: [],
            loading: true,
            loadMore: false,
            refreshing: false,
        };
        this.offset = 0;
        this.loadMoreAble = false;
    }

    render(): React.ReactNode {
        return <ProductListView
            data={this.state.items}
            loading={this.state.loading}
            loadMore={this.state.loadMore}
            refreshing={this.state.refreshing}
            onRefresh={this.onRefresh}
            onEndReached={this.onEndReached}
            onPressItem={this.props.onPressItem}
        />;
    }

    componentDidMount(): void {
        this.fetchData();
    }

    fetchData = () => {
        let {catid} = this.props;
        ApiClient.get('/product/batchget', {
            offset: this.offset,
            count: 20,
            catid
        }).then(response => {
            let items;
            if (this.state.loadMore) {
                items = this.state.items.concat(response.result.items);
            } else {
                items = response.result.items;
            }
            setTimeout(() => {
                this.setState({
                    items,
                    loading: false,
                    refreshing: false,
                    loadMore: false,
                });
                this.loadMoreAble = response.result.items.length >= 20;
            }, 300);
        });
    };

    onRefresh = () => {
        if (this.state.loading || this.state.refreshing || this.state.loadMore) {
            return false;
        }

        this.setState({
            refreshing: true
        }, () => {
            this.offset = 0;
            this.fetchData();
        });
    };

    onEndReached = () => {
        if (this.state.loading || this.state.refreshing || this.state.loadMore || !this.loadMoreAble) {
            return false;
        }

        this.setState({
            loadMore: true
        }, () => {
            this.offset += 20;
            this.fetchData();
        });
    }
}

ProductListComponent.propTypes = {
    catid: PropTypes.number,
    onPressItem: PropTypes.func
}

export default ProductListComponent;
