import ApiService from "./ApiService";


const CategoryService = {
    listCategories(params) {
        return ApiService.get('/categories', {params});
    },
    getCategory(cate_id) {
        return ApiService.get('/category', {params: {cate_id}});
    },
    storeCategory(category) {
        return ApiService.post('/category', {category});
    },
    deleteCategory(ids) {
        return ApiService.post('/category/delete', {ids});
    },
    increase(cate_id) {
        return ApiService.post('/category/increase', {cate_id});
    },
    decrease(cate_id) {
        return ApiService.post('/category/decrease', {cate_id});
    }
};


export default CategoryService;