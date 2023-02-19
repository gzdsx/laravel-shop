;(function ($) {
    $.fn.zoomBox = function(){
        var that = $(this),
            $imgContainer = that.find('.imgbox'),//正常图片容器
            $bigImg       = that.find('.bigimg'),//正常图片，还有放大图片集合
            $dragBox      = that.find('.dragbox'),//拖动滑动容器
            $previewBox   = that.find('.previewbox'),//放大镜显示区域
            $previewImg   = $previewBox.find('.previewimg'),//放大镜图片
            $thumbs = that.find('.thumbs>ul>li'),
            multiple = $previewBox.width()/$dragBox.width();
        multiple =  multiple * ($previewBox.width()/$previewImg.width());

        $imgContainer.mouseover(function () {
            $dragBox.show();
            $previewBox.show();
            $previewImg.css({
                'background-image': 'url('+$bigImg.attr('data-img')+')',
            });
        }).mousemove(function(e){
            //获取坐标的两种方法
            // var iX = e.clientX - this.offsetLeft - $Drag.width()/2,
            // 	iY = e.clientY - this.offsetTop - $Drag.height()/2,
            var iX = e.pageX - $(this).offset().left - $dragBox.width()/2,
                iY = e.pageY - $(this).offset().top - $dragBox.height()/2,
                MaxX = $imgContainer.width()-$dragBox.width(),
                MaxY = $imgContainer.height()-$dragBox.height();

            /*这一部分可代替下面部分，判断最大最小值
          var DX = iX < MaxX ? iX > 0 ? iX : 0 : MaxX,
              DY = iY < MaxY ? iY > 0 ? iY : 0 : MaxY;
          $dragBox.css({left:DX+'px',top:DY+'px'});
          $previewBox.css({marginLeft:-3*DX+'px',marginTop:-3*DY+'px'});*/

            iX = iX > 0 ? iX : 0;
            iX = iX < MaxX ? iX : MaxX;
            iY = iY > 0 ? iY : 0;
            iY = iY < MaxY ? iY : MaxY;
            $dragBox.css({left:iX+'px',top:iY+'px'});
            $previewImg.css({marginLeft:-multiple*iX+'px', marginTop:-multiple*iY+'px'});
            //return false;
        }).mouseout(function(){
            $dragBox.hide();
            $previewBox.hide();
        });

        $thumbs.first().addClass('active');
        $thumbs.on('click', function () {
            var img = $(this).attr('data-bigimg');
            $bigImg.css('background-image', 'url('+img+')').attr('data-img', img);
            $previewImg.css('background-image', 'url('+img+')');
            $(this).addClass('active').siblings().removeClass('active');
        });
    }
})(jQuery);

$(function () {
    $("#zoom").zoomBox();
});
