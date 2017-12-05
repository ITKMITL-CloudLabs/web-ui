<div class="modal fade" id="createFlavorModal" tabindex="-1" role="dialog" aria-labelledby="createFlavorModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="createFlavorModalLabel"><i class="fa fa-plus-square"></i>สร้างเทมเพลตสำหรับประกอบการสร้าง Instance</h4>
            </div>
            <form action="{{ route('admin.flavor.store') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group required">
                        <label>ชื่อเทมเพลต</label>
                        <input type="text" name="name" class="form-control" autofocus>
                    </div>
                    <div class="form-group required">
                        <label>RAM (MB)</label>
                        <input type="number" name="ram" class="form-control" autofocus>
                    </div>
                    <div class="form-group required">
                        <label>SWAP (MB)</label>
                        <input type="number" name="swap" class="form-control" autofocus>
                    </div>
                    <div class="form-group required">
                        <label>vCPUs</label>
                        <input type="number" name="vcpus" class="form-control" autofocus>
                    </div>
                    <div class="form-group required">
                        <label>Disk (GB)</label>
                        <input type="number" name="disk" class="form-control" autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>ยกเลิก</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i>บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>