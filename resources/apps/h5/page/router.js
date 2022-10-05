import PageIndex from "./PageIndex";
import PageDetail from "./PageDetail";

module.exports = [
    {path: '/page/index', component: PageIndex, meta: {title: '平台介绍', auth: false}},
    {path: '/page/detail/:id?', component: PageDetail, meta: {title: '', auth: false}},
]
