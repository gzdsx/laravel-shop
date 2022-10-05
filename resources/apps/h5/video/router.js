import VideoIndex from "./VideoIndex";
import VideoList from "./VideoList";

module.exports = [
    {path: '/video/index', component: VideoIndex, meta: {title: "视频", auth: false}},
    {path: '/video/list', component: VideoList, meta: {title: "视频列表", auth: false}},
]
