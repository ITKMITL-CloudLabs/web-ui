<div class="modal fade" id="createLabModal" tabindex="-1" role="dialog" aria-labelledby="createLabModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="createLabModalLabel">กำหนดชื่อการทดลอง</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="{{ route('admin.lab.store') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group required">
                        <label>ชื่อการทดลอง</label>
                        <input type="text" name="title" class="form-control" autofocus>
                    </div>
                    <div class="form-group required">
                        <label>ประเภทการทดลอง</label>
                        <select class="form-control" name="is_predefined_lab">
                            <option value="" disabled selected>เลือกประเภทการทดลอง</option>
                            <option value="1">เตรียมสภาพแวดล้อมให้</option>
                            <option value="0">ไม่เตรียมสภาพแวดล้อมให้</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i>บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>