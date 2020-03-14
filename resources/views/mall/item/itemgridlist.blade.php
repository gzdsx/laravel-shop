<ul class="item-grid-list">
    @foreach ($items as $item)
        <li>
            <div class="hd" data-link="{{mobile_item_url($item['itemid'])}}">
                <div class="image bg-cover" style="background-image: url({{image_url($item['image'])}})"></div>
                <div class="title">{{$item['title']}}</div>
                <div class="data">
                    <strong>￥{{$item['price']}}</strong>
                    <span>已售{{$item['sold']}}</span>
                </div>
            </div>
        </li>
    @endforeach
</ul>
