<div class="modal fade" id="uploadNewImageModal" tabindex="-1" role="dialog" aria-labelledby="uploadNewImageModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="uploadNewImageModal"><i class="fa fa-plus-square"></i>อัพโหลดอิมเมจระบบใหม่</h4>
            </div>
            <form action="{{ route('admin.image.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group required">
                        <label>ชื่ออิมเมจ</label>
                        <input type="text" name="name" class="form-control" autofocus>
                    </div>
                    <div class="form-group required">
                        <label>Disk Format</label>
                        <select name="disk_format" class="form-control">
                            <option value="iso">ISO</option>
                            <option value="vdi">VDI</option>
                            <option value="vhd">VHD</option>
                            <option value="vmdk">VMDK</option>
                            <option value="qcow2">QCOW2</option>
                            <option value="raw">RAW</option>
                        </select>
                    </div>
                    <div class="form-group required">
                        <label>เลือกไฟล์อิมเมจ</label>
                        <input type="file" name="image_file" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>ยกเลิก</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i>อัพโหลด</button>
                </div>
            </form>
        </div>
    </div>
</div>