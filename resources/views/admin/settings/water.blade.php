@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <h2>系统设置->水印设置</h2>
    </div>
    <div class="content-div">
        <form method="post" action="{{admin_url('settings')}}">
            {{csrf_field()}}
            <table class="dsxui-formtable" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                <tr>
                    <td width="110" class="cell-label">开启图片水印:</td>
                    <td width="320" class="cell-input">
                        <div class="input-group">
                            <label><input name="settings[water_mark]" value="1" type="radio"{{$settings['water_mark'] ? ' checked' : ''}}> 是</label>
                            <label><input name="settings[water_mark]" value="0" type="radio"{{!$settings['water_mark'] ? ' checked' : ''}}> 否</label>
                        </div>
                    </td>
                    <td class="cell-tips">是否启用图片水印</td>
                </tr>
                <tr>
                    <td class="cell-label">水印类型:</td>
                    <td class="cell-input">
                        <div class="input-group">
                            <label><input name="settings[water_type]" type="radio" value="1"{{$settings['water_type'] ? 'checked="checked"' : ''}}> 图片水印</label>
                            <label><input name="settings[water_type]" type="radio" value="0"{{!$settings['water_type'] ? 'checked="checked"' : ''}}> 文字水印</label>
                        </div>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">水印位置:</td>
                    <td class="cell-input">
                        <select class="form-control custom-select" title="" name="settings[water_pos]">
                            <option value="1"@if($settings['water_pos'] == 1) selected="selected"@endif>左上角</option>
                            <option value="2"@if($settings['water_pos'] == 2) selected="selected"@endif>上居中</option>
                            <option value="3"@if($settings['water_pos'] == 3) selected="selected"@endif>右上角</option>
                            <option value="4"@if($settings['water_pos'] == 4) selected="selected"@endif>左居中</option>
                            <option value="5"@if($settings['water_pos'] == 5) selected="selected"@endif>居中</option>
                            <option value="6"@if($settings['water_pos'] == 6) selected="selected"@endif>右居中</option>
                            <option value="7"@if($settings['water_pos'] == 7) selected="selected"@endif>左下角</option>
                            <option value="8"@if($settings['water_pos'] == 8) selected="selected"@endif>下居中</option>
                            <option value="9"@if($settings['water_pos'] == 9) selected="selected"@endif>右下角</option>
                        </select>
                    </td>
                    <td class="cell-tips"></td>
                </tr>
                <tr>
                    <td class="cell-label">水印透明度:</td>
                    <td class="cell-input">
                        <input class="form-control" type="text" title="" name="settings[water_alpha]" value="{{$settings['water_alpha'] ?? ''}}" >
                    </td>
                    <td class="cell-tips">水印透明度,100为不透明</td>
                </tr>
                <tr>
                    <td class="cell-label">水印文字:</td>
                    <td class="cell-input">
                        <textarea class="form-control h60" title="" name="settings[water_text]">{{$settings['water_text'] ?? ''}}</textarea>
                    </td>
                    <td class="cell-tips">水印文字，仅当设定为文字水印时有效</td>
                </tr>
                <tr>
                    <td class="cell-label">水印颜色:</td>
                    <td class="cell-input">
                        <input class="form-control" type="text" title="" name="settings[water_color]" value="{{$settings['water_color'] ?? ''}}">
                    </td>
                    <td class="cell-tips">水印文字颜色，仅当设定为文字水印时有效</td>
                </tr>
                <tr>
                    <td class="cell-label">字体大小:</td>
                    <td class="cell-input">
                        <input class="form-control" type="text" title="" name="settings[water_size]" value="{{$settings['water_size'] ?? ''}}">
                    </td>
                    <td class="cell-tips">水印文字字体大小，仅当设定为文字水印时有效</td>
                </tr>
                <tr>
                    <td class="cell-label">位置偏移量:</td>
                    <td class="cell-input">
                        <input class="form-control" type="text" title="" name="settings[water_offset]" value="{{$settings['water_offset'] ?? ''}}">
                    </td>
                    <td class="cell-tips">水印位置偏移量，单位像素</td>
                </tr>
                <tr>
                    <td class="cell-label">旋转角度:</td>
                    <td class="cell-input">
                        <input class="form-control" type="text" title="" name="settings[water_angle]" value="{{$settings['water_angle'] ?? ''}}">
                    </td>
                    <td class="cell-tips">水印文字旋转角度</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2"><button type="submit" class="btn btn-primary w100">更新配置</button></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop
