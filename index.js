/**
 * @format
 */

import 'react-native-gesture-handler';
import {AppRegistry,LogBox} from 'react-native';
import Root from './app/Root';
import {name as appName} from './app.json';

LogBox.ignoreLogs([
    'VirtualizedLists should never be nested inside plain ScrollViews with the same orientation - use another VirtualizedList-backed container instead.',
    'Require cycles are allowed, but can result in uninitialized values. Consider refactoring to remove the need for a cycle.',
]);
AppRegistry.registerComponent(appName, () => Root);
