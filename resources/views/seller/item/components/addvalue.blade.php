<script type="text/html" id="addValue">
    <div v-show="isShow">
        <div class="modal fade show" style="display: block;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">添加属性</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" @click="isShow=false">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>分类名称</p>
                        <input type="text" class="form-control" placeholder="" v-model="catlog.name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-danger" @click="saveCatlog()">保存</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    </div>
</script>
<script type="text/javascript">
    Vue.component('add-value',{
        template:'#addValue',
        props:{
            isShow:true
        }
    });
</script>
