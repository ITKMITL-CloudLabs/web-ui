<div class="modal fade" id="createSubnetModal" tabindex="-1" role="dialog" aria-labelledby="createSubnetModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="createSubnetModal">สร้าง Subnet</h4>
            </div>
            <form action="{{ route('admin.lab.createSubnet', $lab->id) }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    {{--<div class="form-group required">--}}
                        {{--<label>ชื่อ Network</label>--}}
                        {{--<input type="text" name="networkname" class="form-control" autofocus>--}}
                    {{--</div>--}}
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>ยกเลิก</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i>บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>