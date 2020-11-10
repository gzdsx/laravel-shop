import React from 'react';
import {View} from 'react-native';
import PostListComponent from "./components/PostListComponent";
import {defaultNavigationConfigure} from "../../base/navconfig";

export default class PostList extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: navigation.getParam('title', '')
    });

    constructor(props) {
        super(props);
        this.state = {};
    }


    render(): React.ReactNode {
        const catid = this.props.navigation.getParam('catid', 0);
        return <PostListComponent catid={catid}
                                  onPressItem={(item) => this.props.navigation.navigate('PostDetail', {aid: item.aid})}/>;
    }

    componentDidMount(): void {
        //this.props.navigation.setParams({title:'新闻中心'})
    }
}
