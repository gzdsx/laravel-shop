import React from 'react';
import {SearchBar as ELSearchBar} from "react-native-elements";
import PropTypes from 'prop-types';

class SearchBar extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            value: props.value
        };
    }

    render() {
        return (
            <ELSearchBar
                {...this.props}
                onChangeText={(text) => {
                    this.setState({value: text});
                    this.props.onChangeText && this.props.onChangeText(text);
                }}
                onSubmitEditing={(nativeEvent)=>{
                    this.props.onSubmitEditing && this.props.onSubmitEditing(nativeEvent);
                    this.props.onSearch && this.props.onSearch(this.state.value);
                }}
                value={this.state.value}
                returnKeyType={"search"}
            />
        );
    }
}

SearchBar.propTypes = {
    value: PropTypes.string,
    clearIcon: PropTypes.any,
    searchIcon: PropTypes.any,
    loadingProps: PropTypes.object,
    showLoading: PropTypes.bool,
    containerStyle: PropTypes.oneOfType([PropTypes.object, PropTypes.array]),
    leftIconContainerStyle: PropTypes.oneOfType([
        PropTypes.object,
        PropTypes.array,
    ]),
    rightIconContainerStyle: PropTypes.oneOfType([
        PropTypes.object,
        PropTypes.array,
    ]),
    inputContainerStyle: PropTypes.oneOfType([PropTypes.object, PropTypes.array]),
    inputStyle: PropTypes.oneOfType([PropTypes.object, PropTypes.array]),
    onClear: PropTypes.func,
    onFocus: PropTypes.func,
    onBlur: PropTypes.func,
    onChangeText: PropTypes.func,
    placeholderTextColor: PropTypes.string,
    lightTheme: PropTypes.bool,
    round: PropTypes.bool,
    theme: PropTypes.object,
    onSearch: PropTypes.func
}

SearchBar.defaultProps = {
    onSearch: () => null
}

export default SearchBar;
