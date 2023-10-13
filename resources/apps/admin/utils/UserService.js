import ApiService from "./ApiService";

const UserService = {
    listUsers(params) {
        return ApiService.get('/users', {params});
    },
    getUser(uid) {
        return ApiService.get('/user', {params: {uid}});
    },
    storeUser(user) {
        return ApiService.post('/user', user);
    },
    deleteUser(ids) {
        return ApiService.post('/user/delete', {ids});
    },
    batchUpdate(ids, data) {
        return ApiService.post('/user/batch_update', {ids, data});
    },
    listGroups(params) {
        return ApiService.get('/user/groups', {params});
    },
    getGroup(gid) {
        return ApiService.get('/user/group', {params: {gid}});
    },
    storeGroup(group) {
        return ApiService.post('/user/group', {group});
    },
    deleteGroup(ids) {
        return ApiService.post('/user/group/delete', {ids});
    }
}

export default UserService;