<div class="modal fade" id="createSubnetModal" tabindex="-1" role="dialog" aria-labelledby="createSubnetModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="createSubnetModal"><i class="fa fa-plus-square"></i>สร้าง Subnet</h4>
            </div>
            <form action="{{ route('lab.createSubnet', $lab->id) }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group required">
                        <label>ชื่อ Network</label>
                        <input type="text" name="networkname" class="form-control" autofocus>
                    </div>
                    <div class="form-group required">
                        <label>ชื่อ Subnet</label>
                        <input type="text" name="subnetname" class="form-control">
                    </div>
                    <div class="form-group required">
                        <label>Network Address (ex. 192.168.1.0/24)</label>
                        <input type="text" name="networkaddress" class="form-control">
                    </div>
                    <div class="form-group required">
                        <label>Gateway</label>
                        <input type="text" name="gateway" class="form-control">
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