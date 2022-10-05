import FenXiaoIndex from "./FenXiaoIndex";
import DealerPoster from "./DealerPoster";
import Subordinate from "./Subordinate";

module.exports = [
    {path: '/fenxiao/index', component: FenXiaoIndex, meta: {title: '营销推广', auth: true}},
    {path: '/fenxiao/dealer-poster', component: DealerPoster, meta: {title: '推广海报', auth: true}},
    {path: '/fenxiao/subordinate', component: Subordinate, meta: {title: '我的下线', auth: true}},
]
