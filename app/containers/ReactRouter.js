export default class ReactRouter {
    screens = [];

    constructor(routes) {
        this.screens = routes;
    }

    addRoutes(routes) {
        this.screens = this.screens.concat(routes);
    }
}
