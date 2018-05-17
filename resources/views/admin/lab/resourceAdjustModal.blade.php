<div class="modal fade" id="resourceAdjustModal" tabindex="-1" role="dialog" aria-labelledby="resourceAdjustModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="resourceAdjustModalLabel">กำหนด Resource ในการทดลอง</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="{{ route('admin.lab.updateQuota', $lab->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="modal-body">
                    <div class="form-group required">
                        <label>Instance (VMs)</label>
                        <input type="number" name="instances" class="form-control" value="{{ $lab->quota->instances }}" autofocus>
                    </div>
                    <div class="form-group required">
                        <label>vCPU (Core)</label>
                        <input type="number" name="vcpus" class="form-control" value="{{ $lab->quota->vcpus }}">
                    </div>
                    <div class="form-group required">
                        <label>Memory (MB)</label>
                        <input type="number" name="memory" class="form-control" value="{{ $lab->quota->memory }}">
                    </div>
                    <div class="form-group required">
                        <label>Disk (GB)</label>
                        <input type="number" name="disk" class="form-control" value="{{ $lab->quota->disk }}">
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