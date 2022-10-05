var API_URL;
switch (process.env.NODE_ENV) {
    case 'development':
        API_URL = '/api';
        break;
    case 'production':
        API_URL = '/api';
        break;
}

export {
    API_URL
}
